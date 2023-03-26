<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\jenis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{

  public function jenis()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Jenis Dagangan"]];
    $kar = jenis::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/jenis_pedagang', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function jenis_add(Request $request){
    $validator = Validator::make($request->all(), [
      'kode' => 'required',
      'nama' => 'required',
      'ket' => 'required',
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('jenis-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = jenis::updateOrCreate([
        'id' => $request->id
    ], [
        'kode' => $request->kode,
        'nama' => $request->nama,
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
    return redirect()->route('jenis-admin');
  }
  public function jenis_data()
  {
    $user=jenis::orderBy('id')->get();
    return ['data' => $user];
  }
  public function jenis_data_single(Request $request)
  {
    $user=jenis::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function jenis_delete(Request $request){
    $user = jenis::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('jenis-admin');
  }

}
