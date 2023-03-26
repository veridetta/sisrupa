<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\kontrakan;
use App\Models\pedagang;
use App\Models\pembayaran;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class pembayaranController extends Controller
{

  public function pembayaran()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Data Pembayaran Kios"]];
    $kar = kontrakan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $pedagang=pedagang::join('users','users.id','=','pedagangs.id_users')->select('pedagangs.*','users.name as name')->orderBy('users.name')->get();
    $petugas=User::where('role','=','petugas')->orderBy('name')->get();
    $tagihan=tagihan::orderBy('nama')->get();
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_lokasi')->orderBy('lokasis.nama')->get();
    return view('layouts/admin/pembayaran', ['petugass'=>$petugas,'tagihans'=>$tagihan,'pedagangs'=>$pedagang,'bloks'=>$blok,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function pembayaran_add(Request $request){
    $validator = Validator::make($request->all(), [
      'id_pedagang' => 'required',
      'id_petugas' => 'required',
      'id_tagihan' => 'required',
      'tanggal' => 'required',
      'ket' => 'required',
      'nominal' => 'required',
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('pembayaran-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = pembayaran::updateOrCreate([
        'id' => $request->id
    ], [
        'id_pedagang' => $request->id_pedagang,
        'id_petugas' => $request->id_petugas,
        'id_tagihan' => $request->id_tagihan,
        'tanggal_pembayaran' => $request->tanggal,
        'nominal' => $request->nominal,
        'keterangan' => $request->ket
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
    return redirect()->route('pembayaran-admin');
  }
  public function pembayaran_data()
  {
    $user=pembayaran::join('pedagangs','pedagangs.id','=','pembayarans.id_pedagang')->join('jenis','jenis.id','=','pedagangs.jenis')->join('tagihans','tagihans.id','=','pembayarans.id_tagihan')->join('users as p','p.id','=','pedagangs.id_users')->join('users as t','t.id','=','pembayarans.id_petugas')->select('p.name as name','jenis.nama as jenis','pembayarans.tanggal_pembayaran as tanggal','tagihans.nama as tagihan','tagihans.nominal as nominal','pembayarans.keterangan as keterangan','t.name as petugas','pembayarans.id as id','pembayarans.id_pedagang as id_pedagang','pembayarans.id_tagihan as id_tagihan')->orderBy('pembayarans.id')->get();
    return ['data' => $user];
  }
  public function pembayaran_data_single(Request $request)
  {
    $user=pembayaran::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function pembayaran_delete(Request $request){
    $user = pembayaran::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('pembayaran-admin');
  }

}
