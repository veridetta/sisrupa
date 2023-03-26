<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{

  public function petugas()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "petugas Pasar"]];
    $kar = User::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/petugas', ['val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function petugas_add(Request $request){
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'password' => 'required',
      'nama' => 'required',
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('petugas-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id
    ], [
        'username' => $request->username,
        'name' => $request->nama,
        'password' => Hash::make($request->password),
        'role'=>'petugas'
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
    return redirect()->route('petugas-admin');
  }
  public function petugas_data()
  {
    $user=User::where('role','=','petugas')->orderBy('name')->get();
    return ['data' => $user];
  }
  public function petugas_data_single(Request $request)
  {
    $user=User::where('id','=',$request->id)->first();
    return ['data' => $user];
  }
  public function petugas_delete(Request $request){
    $user = User::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('petugas-admin');
  }

}
