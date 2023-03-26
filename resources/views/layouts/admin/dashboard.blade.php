
@extends('layouts/contentLayoutMaster')

@section('title', 'Beranda')

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
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$pasar}}</h2>
              <p class="card-text">Total Pasar</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$kios}}</h2>
              <p class="card-text">Total Kios</p>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$terisi}}</h2>
              <p class="card-text">Total Kios Disewa</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$pedagang}}</h2>
              <p class="card-text">Total Pedagang</p>
            </div>
          </div>
        </div>
        <!-- Subscribers Chart Card ends -->
        <!-- Subscribers Chart Card starts -->
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card pb-2">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="user-check" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{$petugas}}</h2>
              <p class="card-text">Total Petugas</p>
            </div>
          </div>
        </div>
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
