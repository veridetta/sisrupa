<?php

namespace App\Http\Controllers;

use App\Models\blok;
use App\Models\lokasi;
use App\Models\pedagang;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
  public function dashboard()
  {
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'','navbarColor'=>'bg-light-danger'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => "Admin"], ['name' => "Beranda"]];
    
    $pasar=lokasi::count();
    $kios=blok::count();
    $terisi=blok::join('kontrakans','kontrakans.id_blok','=','bloks.id')->count();
    $pedagang=pedagang::count();
    $petugas=User::where('role','=','petugas')->count();

    $val = array('primary','secondary','warning','danger','info');
    $user = User::where('id','=',Auth::user()->id)->first();

      $layout='layouts/admin/dashboard';  

    
    return view($layout, ['val'=>$val,'pasar'=>$pasar,'kios'=>$kios,'terisi'=>$terisi,'pedagang'=>$pedagang,'petugas'=>$petugas,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'user'=>$user]);
  }
}
