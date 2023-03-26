<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\kontrakan;
use App\Models\lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class BlokController extends Controller
{

  public function blok()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Blok / Kios"]];
    $kar = blok::orderBy('id')->get();
    $lokasi = lokasi::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    return view('layouts/admin/blok', ['val'=>$val,'lokasis'=>$lokasi,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs]);
  }
  public function blok_add(Request $request){
    $validator = Validator::make($request->all(), [
      'lokasi' => 'required',
      'nomor' => 'required',
      'blok' => 'required'
    ]);
    
    if ($validator->fails()) {
      dd($validator);
      session()->flash('error', 'Periksa ulang kembali.');
      return redirect()->route('blok-admin')->withErrors($validator)
      ->withInput();;
    }
    $user = blok::updateOrCreate([
        'id' => $request->id
    ], [
        'id_lokasi' => $request->lokasi,
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
    return redirect()->route('blok-admin');
  }
  public function blok_data()
  {
    $user = Blok::join('lokasis', 'lokasis.id', '=', 'bloks.id_lokasi')
            ->leftJoin('kontrakans', 'kontrakans.id_blok', '=', 'bloks.id')
            ->orderBy('lokasis.nama')
            ->select('bloks.*','bloks.id as id','lokasis.nama','kontrakans.status as konstat')
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
    return redirect()->route('blok-admin');
  }

}
