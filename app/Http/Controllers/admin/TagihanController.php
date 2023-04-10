<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\lokasi;
use App\Models\tagihan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TagihanController extends Controller
{

  public function tagihan(Request $request)
  {
    $kat=$request->id;
    $p=lokasi::where('id','=',$kat)->first();
    $pasar=$p->nama;
    

    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Jenis Tagihan"]];
    $kar = tagihan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $lokasi_pasar = lokasi::orderBy('id')->get();
    return view('layouts/admin/tagihan', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function tagihan_add(Request $request){
    $validator = Validator::make($request->all(), [
      'kode' => 'required',
      'nama' => 'required',
      'nominal' => 'required',
      'jenis' => 'required',
    ]);
    
    if ($validator->fails()) {
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('tagihan-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = tagihan::updateOrCreate([
        'id' => $request->id
    ], [
        'kode' => $request->kode,
        'nama' => $request->nama,
        'nominal' => $request->nominal,
        'jenis' => $request->jenis,
        'id_pasar' => $request->id_pasar
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
    return redirect()->route('tagihan-admin',['id'=>$request->id_pasar]);
  }
  public function tagihan_data(Request $request)
  {
    $user=tagihan::where('id_pasar','=',$request->id)->orderBy('id')->get();
    return ['data' => $user];
  }
  public function tagihan_data_single(Request $request)
  {
    $user=tagihan::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function tagihan_delete(Request $request){
    $user = tagihan::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('tagihan-admin',['id'=>$request->id_pasar]);
  }

}
