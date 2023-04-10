
@extends('layouts/contentLayoutMaster')

@section('title', 'Denah '.$pazar)

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">
  @include('panels.flash')
      <div class="row match-height">
        <!-- Subscribers Chart Card starts -->
        <img src="{{asset('/storage/images/'.$denah->denah)}}" class="img-fluid card-img-top" alt="Profile Cover Photo">
      </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->

@endsection
