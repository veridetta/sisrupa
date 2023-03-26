<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{

  public function lokasi()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Lokasi Pasar"]];
    $kar = lokasi::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/lokasi', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function lokasi_add(Request $request){
    $validator = Validator::make($request->all(), [
      'kode' => 'required',
      'nama' => 'required',
      'lok' => 'required',
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('lokasi-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = lokasi::updateOrCreate([
        'id' => $request->id
    ], [
        'kode' => $request->kode,
        'nama' => $request->nama,
        'lokasi' => $request->lok
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
    return redirect()->route('lokasi-admin');
  }
  public function lokasi_data()
  {
    $user=lokasi::orderBy('id')->get();
    return ['data' => $user];
  }
  public function lokasi_data_single(Request $request)
  {
    $user=lokasi::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function lokasi_delete(Request $request){
    $user = lokasi::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('lokasi-admin');
  }

}
