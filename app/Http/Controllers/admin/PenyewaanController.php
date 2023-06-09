<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\kontrakan;
use App\Models\lokasi;
use App\Models\pedagang;
use App\Models\penyewaan;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class penyewaanController extends Controller
{

  public function penyewaan(Request $request)
  {
    $kat=$request->id;
    $p=lokasi::where('id','=',$kat)->first();
    $pasar=$p->nama;
    
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Data Penyewaan Kios"]];
    $kar = kontrakan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->get();
    $tagihan=tagihan::orderBy('nama')->get();
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_pasar')->leftJoin('kontrakans', 'kontrakans.id_blok', '=', 'bloks.id')->select('bloks.*','lokasis.nama as nama','kontrakans.status as kst')->orderBy('lokasis.nama')->get();
    $lokasi_pasar = lokasi::orderBy('id')->get();
    return view('layouts/admin/blok', ['tagihans'=>$tagihan,'pedagangs'=>$pedagang,'bloks'=>$blok,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function penyewaan_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_pedagang' => 'required',
      'id_blok' => 'required',
      'id_tagihan' => 'required',
      'tanggal' => 'required',
      'ket' => 'required',
      'id_pasar' => 'required',
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('blok-admin',['id'=>$request->id])->withErrors($validator)
      ->withInput();;
    }
    $user = kontrakan::updateOrCreate([
        'id' => $request->id
    ], [
        'id_pedagang' => $request->id_pedagang,
        'id_blok' => $request->id_blok,
        'id_tagihan' => $request->id_tagihan,
        'tanggal' => $request->tanggal,
        'keterangan' => $request->ket,
        'status' => '1' //0 berakhir 1 aktif
    ]);
    if($request->id){
      if($user){
        session()->flash('success', 'Data Berhasil Diubah.');
        //redirect
      }
    }else{
      if($user){
        session()->flash('success', 'Data Berhasil Ditambah.');
        //redirect
      }
    }
  
    return redirect()->route('blok-admin',['id'=>$request->id_pasar]);
  }
  public function penyewaan_data(Request $request)
  {
    $user=kontrakan::join('pedagangs','pedagangs.id','=','kontrakans.id_pedagang')->join('bloks','bloks.id','=','kontrakans.id_blok')->join('tagihans','tagihans.id','=','kontrakans.id_tagihan')->join('lokasis','lokasis.id','=','bloks.id_pasar')->join('jenis','jenis.id','=','pedagangs.jenis')->join('users','users.id','=','pedagangs.id_users')->select('kontrakans.*','users.name as name', 'jenis.nama as jnama','lokasis.lokasi as lokasi','bloks.blok as blok','tagihans.nama as tnama','tagihans.nominal as nominal')->where('pedagangs.id_pasar','=',$request->id)->orderBy('kontrakans.id')->get();
    return ['data' => $user];
  }
  public function penyewaan_data_single(Request $request)
  {
    $user=kontrakan::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function penyewaan_delete(Request $request){
    $user = kontrakan::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('blok-admin',['id'=>$request->id_pasar]);
  }

}
