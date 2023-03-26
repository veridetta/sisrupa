@extends('layouts/umumLayout')

@section('title', 'Dashboard')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
  <style>
    .content-wrapper{
      padding: 0 !important;
    }
    </style>
@endsection

@section('content')
  <div class=" bg-muted bg-darken-3" style="padding:0px !important;">
    <div class=" col-12 justify-content-center text-center row" style="padding:0px !important;min-height:90vh;width:100vw;background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7) ), url({{asset('images/logo/bgg.png')}});background-repeat: no-repeat;  background-position: center;background-size:cover">
      <!-- Login basic -->
      <h1 class="my-auto p-5 display-5 text-white">SELAMAT DATANG DI WEBSITE SISTEM INFORMASI RUKO PASAR KABUPATEN MAJALENGKA</h1>
      </div>
      <!-- /Login basic -->
    </div>
  </div>
@endsection
