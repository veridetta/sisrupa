<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\kontrakan;
use App\Models\lokasi;
use App\Models\pedagang;
use App\Models\pembayaran;
use App\Models\tagihan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LaporanController extends Controller
{

  public function bulan(Request $request)
  {
    $kat=$request->id;
    
    $p=lokasi::where('id','=',$kat)->first();
    $pasar=$p->nama;
    
    $lokasi_pasar = lokasi::orderBy('id')->get();
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Laporan Bulanan"]];
    $kar = kontrakan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $bu = $request->bulan;
    $ta = $request->tahun;

    if($bu=='default'){
      $bulan = date('m');
      $tahun = date('Y');
    }else{
      $bulan = $bu;
      $tahun = $ta;
    }
    $nama_bulan = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ][$bulan - 1];
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_pasar')->orderBy('lokasis.nama')->get();
    return view('layouts/admin/lap_bulanan', ['bulan'=>$nama_bulan,'bulan_a'=>$bulan,'tahun'=>$tahun,'bloks'=>$blok,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'id'=>$kat,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function bulan_form(Request $request)
  {
    $kat=$request->id_pasar;
    
    if($kat=='1'){
      $pasar="Pasar Cigasong";
    }else{
      $pasar = "Pasar Kadipaten";
    }
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Laporan Bulanan"]];
    $lokasi_pasar = lokasi::orderBy('id')->get();
    $kar = kontrakan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $bu = $request->bulan;
    $ta = $request->tahun;

    if($bu=='default'){
      $bulan = date('m');
      $tahun = date('Y');
    }else{
      $bulan = $bu;
      $tahun = $ta;
    }
    $nama_bulan = [
        'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ][$bulan - 1];
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_pasar')->orderBy('lokasis.nama')->get();
    return view('layouts/admin/lap_bulanan', ['bulan'=>$nama_bulan,'bulan_a'=>$bulan,'tahun'=>$tahun,'bloks'=>$blok,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'id'=>$kat,'lokasi_pasars'=>$lokasi_pasar]);
  }
  public function bulan_data(Request $request)
  {
    $user=pembayaran::join('pedagangs','pedagangs.id','=','pembayarans.id_pedagang')->join('jenis','jenis.id','=','pedagangs.jenis')->join('tagihans','tagihans.id','=','pembayarans.id_tagihan')->join('users as p','p.id','=','pedagangs.id_users')->join('users as t','t.id','=','pembayarans.id_petugas')->select('p.name as name','jenis.nama as jenis','pembayarans.tanggal_pembayaran as tanggal','tagihans.nama as tagihan','tagihans.nominal as nominal','pembayarans.keterangan as keterangan','t.name as petugas','pembayarans.id as id','pembayarans.id_pedagang as id_pedagang','pembayarans.id_tagihan as id_tagihan')->where('pedagangs.id_pasar','=',$request->id)->whereMonth('pembayarans.tanggal_pembayaran', '=', $request->bulan)
    ->whereYear('pembayarans.tanggal_pembayaran', '=', $request->tahun)->orderBy('pembayarans.tanggal_pembayaran')->get();
    return ['data' => $user];
  }

  public function harian(Request $request)
  {
    $kat=$request->id;
    
    if($kat=='1'){
      $pasar="Pasar Cigasong";
    }else{
      $pasar = "Pasar Kadipaten";
    }
    $pageConfigs = ['showMenu' => true,'mainLayoutType'=>'vertical'];
    $breadcrumbs = [ ['link' => "javascript:void(0)", 'name' => auth()->user()->role], ['name' => "Laporan Bulanan"]];
    $kar = kontrakan::orderBy('id')->get();
    $val = array('primary','secondary','warning','danger','info');
    $bu = $request->tanggal;
    $lokasi_pasar = lokasi::orderBy('id')->get();
    if($bu=='default'){
      $tanggal = Carbon::today()->toDateString();
    }else{
      $tanggal = $bu;
      $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
    }
    $blok=blok::join('lokasis','lokasis.id','=','bloks.id_pasar')->orderBy('lokasis.nama')->get();
    return view('layouts/admin/lap_harian', ['tanggal'=>$tanggal,'bloks'=>$blok,'val'=>$val,'kars'=>$kar,'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs,'kat'=>$kat,'pasar'=>$pasar,'id'=>$kat,'lokasi_pasars'=>$lokasi_pasar]);
  }
  

  public function harian_data(Request $request)
  {
    $user=pembayaran::join('pedagangs','pedagangs.id','=','pembayarans.id_pedagang')->join('jenis','jenis.id','=','pedagangs.jenis')->join('tagihans','tagihans.id','=','pembayarans.id_tagihan')->join('users as p','p.id','=','pedagangs.id_users')->join('users as t','t.id','=','pembayarans.id_petugas')->select('p.name as name','jenis.nama as jenis','pembayarans.tanggal_pembayaran as tanggal','tagihans.nama as tagihan','tagihans.nominal as nominal','pembayarans.keterangan as keterangan','t.name as petugas','pembayarans.id as id','pembayarans.id_pedagang as id_pedagang','pembayarans.id_tagihan as id_tagihan')->where('pembayarans.tanggal_pembayaran', '=', $request->tanggal)->where('pedagangs.id_pasar','=',$request->id)->orderBy('pembayarans.tanggal_pembayaran')->get();
    return ['data' => $user];
  }
  public function kwitansi(Request $request)
{
  $user=pembayaran::join('pedagangs','pedagangs.id','=','pembayarans.id_pedagang')->join('jenis','jenis.id','=','pedagangs.jenis')->join('tagihans','tagihans.id','=','pembayarans.id_tagihan')->join('users as p','p.id','=','pedagangs.id_users')->join('users as t','t.id','=','pembayarans.id_petugas')->select('p.name as name','jenis.nama as jenis','pembayarans.tanggal_pembayaran as tanggal','tagihans.nama as tagihan','tagihans.nominal as nominal','pembayarans.keterangan as keterangan','t.name as petugas','pembayarans.id as id','pembayarans.id_pedagang as id_pedagang','pembayarans.id_tagihan as id_tagihan')->where('pembayarans.id', '=', $request->id)->first();

  $layout='layouts.admin.kwitansi';
	//return view('layouts.admin.kwitansi', ['user'=>$user]);
  $pdf = Pdf::loadView($layout,['user'=>$user])->setPaper('a4', 'potrait');;
    $nama = "Kwitansi pembayaran ".$user->name.' '.$user->tanggal.'.pdf';
      return $pdf->download($nama);
}
}
