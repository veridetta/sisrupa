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

class PengunjungController extends Controller
{

  public function pengunjung(Request $request)
  {
    $kat=$request->id;
    
    //$p=lokasi::where('id','=',$kat)->first();
    //$pasar=$p->nama;
    
    
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Data Pengunjung "]];
    $kar = User::orderBy('id')->get();
    $jenis = jenis::orderBy('nama')->get();
    $val = array('primary','secondary','warning','danger','info');
    $lokasi_pasar = lokasi::orderBy('id')->get();
    return view('layouts/admin/pengunjung', ['jeniss'=>$jenis,'kat'=>$kat,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function pengunjung_data(Request $request)
  {
    $user=User::where('users.role','=','pedagang')->join('pedagangs','pedagangs.id_users','=','users.id')->orderBy('name')->get();
    return ['data' => $user];
  }

}
