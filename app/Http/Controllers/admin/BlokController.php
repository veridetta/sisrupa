<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\kontrakan;
use App\Models\lokasi;
use App\Models\pedagang;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlokController extends Controller
{

  public function blok(Request $request)
  {
    $kat=$request->id;
    $p=lokasi::where('id','=',$kat)->first();
    $pasar=$p->nama;
    
    $lokasi_pasar = lokasi::orderBy('id')->get();
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Kios ".$pasar]];
    if(auth()->user()->role=='pedagang'){
      $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->where('id_users','=',auth()->user()->id)->get();
    }else{
      $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->get();
    }
    
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_pasar')->leftJoin('kontrakans', 'kontrakans.id_blok', '=', 'bloks.id')->select('bloks.*','lokasis.nama as nama','kontrakans.status as kst')->where('lokasis.id','=',$request->id)->orderBy('lokasis.nama')->get();
    $kar = blok::orderBy('id')->where('id_pasar','=',$kat)->get();
    $lokasi = lokasi::orderBy('nama')->get();
    $tagihan=tagihan::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/blok', ['val'=>$val,'lokasis'=>$lokasi,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'pedagangs'=>$pedagang,'bloks'=>$blok,'tagihans'=>$tagihan,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function blok_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_pasar' => 'required',
      'nomor' => 'required',
      'blok' => 'required'
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('blok-admin',['id'=>$request->id_pasar])->withErrors($validator)
      ->withInput();;
    }
    $user = blok::updateOrCreate([
        'id' => $request->id
    ], [
        'id_pasar' => $request->id_pasar,
        'nomor_kios' => $request->nomor,
        'blok' => $request->blok,
        'status' => '0',
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
  public function blok_data(Request $request)
  {
    $user = Blok::join('lokasis', 'lokasis.id', '=', 'bloks.id_pasar')
            ->leftJoin('kontrakans', 'kontrakans.id_blok', '=', 'bloks.id')->leftJoin('pedagangs','pedagangs.id','=','kontrakans.id_pedagang')->leftJoin('users','users.id','=','pedagangs.id_users')->leftJoin('tagihans','tagihans.id','=','kontrakans.id_tagihan')
            ->orderBy('lokasis.nama')
            ->where('bloks.id_pasar','=',$request->id)
            ->select('bloks.*','bloks.id as id','users.name as nama_pedagang','lokasis.nama','kontrakans.status as konstat','kontrakans.tanggal as jatuh_tempo','tagihans.kode as tagihan_kode','tagihans.nominal as nominal')
            ->get();
    return ['data' => $user];
  }
  public function blok_data_single(Request $request)
  {
    $user=blok::where('bloks.id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function blok_delete(Request $request){
    $user = blok::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('blok-admin',['id'=>$request->id_pasar]);
  }




  public function blok_pedagang(Request $request)
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Kios Saya"]];
    if(auth()->user()->role=='pedagang'){
      $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->where('id_users','=',auth()->user()->id)->get();
    }else{
      $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->get();
    }
    
    
    $lokasi_pasar = lokasi::orderBy('id')->get();
    $lokasi = lokasi::orderBy('nama')->get();
    $tagihan=tagihan::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/pedagang/blok', ['val'=>$val,'lokasis'=>$lokasi,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'pedagangs'=>$pedagang,'tagihans'=>$tagihan,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function blok_data_pedagang(Request $request)
  {
    $user = Blok::join('lokasis', 'lokasis.id', '=', 'bloks.id_pasar')
            ->leftJoin('kontrakans', 'kontrakans.id_blok', '=', 'bloks.id')->leftJoin('pedagangs','pedagangs.id','=','kontrakans.id_pedagang')->leftJoin('users','users.id','=','pedagangs.id_users')->leftJoin('tagihans','tagihans.id','=','kontrakans.id_tagihan')
            ->orderBy('lokasis.nama')
            ->where('users.id','=',auth()->user()->id)
            ->select('bloks.*','bloks.id as id','bloks.id_pasar as id_pasar','users.name as nama_pedagang','lokasis.nama','kontrakans.status as konstat','kontrakans.tanggal as jatuh_tempo','tagihans.kode as tagihan_kode','tagihans.nominal as nominal')
            ->get();
    return ['data' => $user];
  }
}
