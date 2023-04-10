<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\jenis;
use App\Models\lokasi;
use App\Models\pedagang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PedagangController extends Controller
{

  public function pedagang(Request $request)
  {
    $kat=$request->id;
    
    $p=lokasi::where('id','=',$kat)->first();
    $pasar=$p->nama;
    
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Data Pedagang ".$pasar]];
    $kar = User::orderBy('id')->get();
    $jenis = jenis::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    $lokasi_pasar = lokasi::orderBy('id')->get();
    return view('layouts/admin/pedagang', ['jeniss'=>$jenis,'kat'=>$kat,'pasar'=>$pasar,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function pedagang_add(Request $request){
    $validator = Validator::make($request->all(), [
      'username' => 'required',
      'email' => 'required',
      'password' => 'required',
      'nama' => 'required',
      'ttl' => 'required',
      'telp' => 'required',
      'jk' => 'required',
      'alamat' => 'required',
      'jenis' => 'required',
      'id_pasar'=> 'required'
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('pedagang-admin',['id'=>$request->id_pasar])->withErrors($validator)
      ->withInput();;
    }
    $user = User::updateOrCreate([
        'id' => $request->id_users
    ], [
        'username' => $request->username,
        'email' => $request->email,
        'name' => $request->nama,
        'password' => Hash::make($request->password),
        'role'=>'pedagang'
    ]);
    if($user){
      $pedagang=pedagang::updateOrCreate([
        'id'=>$request->id],
        [
        'ttl' => $request->ttl,
        'telp' => $request->telp,
        'alamat' => $request->alamat,
        'jk' => $request->jk,
        'id_users'=>$user->id,
        'jenis' => $request->jenis,
        'id_pasar' => $request->id_pasar,
        'status' => '1'
        ]);
    }
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
    return redirect()->route('pedagang-admin',['id'=>$request->id_pasar]);
  }
  public function pedagang_data(Request $request)
  {
    $user=User::join('pedagangs','pedagangs.id_users','=','users.id')->join('jenis','jenis.id','=','pedagangs.jenis')->select('pedagangs.*','users.name as name','users.username as username','jenis.nama as jnama')->where('users.role','=','pedagang')->where('pedagangs.id_pasar','=',$request->id)->where('pedagangs.status','=','1')->orderBy('name')->get();
    return ['data' => $user];
  }
  public function pedagang_data_single(Request $request)
  {
    $user=Pedagang::join('users','users.id','=','pedagangs.id_users')->join('jenis','jenis.id','=','pedagangs.id')->where('pedagangs.id','=',$request->id)->leftjoin('kontrakans','kontrakans.id_pedagang','=','pedagangs.id')->leftjoin('bloks','bloks.id','=','kontrakans.id_blok')->select('pedagangs.*','users.name as name','users.username as username','jenis.nama as jnama','bloks.nomor_kios as no_kios','kontrakans.tanggal as tanggal')->first();
    return ['data' => $user];
  }
  public function pedagang_delete(Request $request){
    $pedagang = pedagang::where('id','=',$request->id)->first();
    $user = User::where('id','=',$pedagang->id)->delete();
    $pedagang2=pedagang::where('id','=',$request->id)->delete();
    if($user){
        session()->flash('success', 'Data Berhasil dihapus.');
        //redirect
    }
    return redirect()->route('pedagang-admin',['id'=>$request->id_pasar]);
  }

}
