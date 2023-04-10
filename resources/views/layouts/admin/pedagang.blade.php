
@extends('layouts/contentLayoutMaster')

@section('title', 'Data Pedagang '.$pasar)

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
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
      <div class="col-lg-12 col-sm-12 col-12">
        @if(auth()->user()->role=='admin')
        <button id="btn-add" class="dt-button add-new btn btn-primary mb-2"  
        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#backdrop"><span>Tambah Pedagang</span></button>
        @endif
        <div class="card">

          <div class="card-header bg-primary flex-column align-items-start">
            <div class="row col-12">
                <div class="col-lg-1 col-2">
                    <div class="avatar bg-light p-50 m-0">
                        <div class="avatar-content text-primary">
                          <i data-feather="users" class="font-medium-5"></i>
                        </div>
                      </div>
                </div>
                <div class="col-lg-11 col-10 my-auto">
                    <p class="h4 card-text text-white">Daftar Pedagang {{$pasar}}</p>
                </div>
            </div>
          </div>
          <div class="card-body" >
            <div class="card-datatable table-responsive pt-3">
              <table class="dt-anggota table">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Dagangan</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tempat/Tanggal Lahir</th>
                    <th>Telp</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    @if (auth()->user()->role=='admin')
                    <th>Telp</th>
                    @endif
                  </tr>
                </thead>
              </table>
            </div>
            
          </div>
        </div>
      </div>
      <!-- Modal to add new user starts-->
      <div
      class="modal modal-primary fade text-start"
      id="backdrop"
      tabindex="-1"
      aria-labelledby="myModalLabel4"
      data-bs-backdrop="false"
      aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel4">Tambah Pedagang</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="add-new-user pt-0" method="POST" action="{{route('pedagang-add-admin')}}" id="myForm">
                @csrf
                <input type="hidden" name="id" value="" id="id_kode"/>
                <input type="hidden" name="id_users" value="" id="id_users"/>
                <input type="hidden" name="id_pasar" value="{{$kat}}" id="id_pasar"/>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-username">Username</label>
                  <input
                    type="text"
                    id="basic-icon-default-username"
                    class="form-control dt-username"
                    name="username"
                    placeholder="xxxx"
                    value="{{old('username')}}"
                  />
                  @error('username')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-email">Email</label>
                  <input
                    type="text"
                    id="basic-icon-default-email"
                    class="form-control dt-email"
                    name="email"
                    placeholder="xxxx"
                    value="{{old('email')}}"
                  />
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-password">Password</label>
                  <input
                    type="password"
                    id="basic-icon-default-password"
                    class="form-control dt-password"
                    name="password"
                    placeholder="xxxx"
                    value="{{old('password')}}"
                  />
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-nama">Nama</label>
                  <input
                    type="text"
                    id="basic-icon-default-nama"
                    class="form-control dt-nama"
                    name="nama"
                    placeholder="Agus S"
                    value="{{old('nama')}}"
                  />
                  @error('nama')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-ttl">Tempat/Tanggal Lahir</label>
                  <input
                    type="text"
                    id="basic-icon-default-ttl"
                    class="form-control dt-ttl"
                    name="ttl"
                    placeholder="Majalengka/xx-xx-xxxx"
                    value="{{old('ttl')}}"
                  />
                  @error('ttl')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-jk">Jenis Kelamin</label>
                  <select
                    type="text"
                    id="basic-icon-default-jk"
                    class="form-control dt-jk"
                    name="jk"
                    placeholder="Agus S"
                    value="{{old('jk')}}">
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                  </select>
                  @error('jk')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-telp">Telp</label>
                  <input
                    type="text"
                    id="basic-icon-default-telp"
                    class="form-control dt-telp"
                    name="telp"
                    placeholder="09xxxxx"
                    value="{{old('telp')}}"
                  />
                  @error('telp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-alamat">Alamat</label>
                  <textarea
                    type="text"
                    id="basic-icon-default-alamat"
                    class="form-control dt-alamat"
                    name="alamat"
                    placeholder="Agus S"
                    value="{{old('alamat')}}">{{old('alamat')}}</textarea>
                  @error('alamat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-jenis">Jenis Dagangan</label>
                  <select
                    type="text"
                    id="basic-icon-default-jenis"
                    class="form-control dt-jenis"
                    name="jenis"
                    placeholder="Agus S"
                    value="{{old('jenis')}}">
                    @foreach ($jeniss as $jenis)
                      <option value="{{$jenis->id}}">{{$jenis->nama}}</option>
                    @endforeach
                  </select>
                  @error('jenis')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary me-1 data-submit">Kirim</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div
      class="modal modal-primary fade text-start"
      id="backdrop2"
      tabindex="-1"
      aria-labelledby="myModalLabel2"
      data-bs-backdrop="false"
      aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel2">Detail Pedagang</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <table>
                <tr>
                  <td>No Registrasi</td>
                  <td>: PDG<span id="tb-no"></span></td>
                </tr>
                <tr>
                  <td>Tanggal Registrasi</td>
                  <td>: <span id="tb-tanggal"></span></td>
                </tr>
                <tr>
                  <td>Nama Pedagang</td>
                  <td>: <span id="tb-nama"></span></td>
                </tr>
                <tr>
                  <td>Alamat</td>
                  <td>: <span id="tb-alamat"></span></td>
                </tr>
                <tr>
                  <td>No Telp</td>
                  <td>: <span id="tb-telp"></span></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>: <span id="tb-jk"></span></td>
                </tr>
                <tr>
                  <td>Tempat/Tanggal Lahir</td>
                  <td>: <span id="tb-ttl"></span></td>
                </tr>
                
                <tr>
                  <td>Blok</td>
                  <td>: <span id="tb-blok"></span></td>
                </tr>
                <tr>
                  <td>Jenis Dagangan</td>
                  <td>: <span id="tb-jenis"></span></td>
                </tr>
              </table>
            </div>

          </div>
        </div>
      </div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
@endsection
@section('page-script')
<script>
  /**
* DataTables Basic
*/
$('.add-new').click(function(){
  var kat = '{{$kat}}';
  document.getElementById("myForm").reset();
  $("#id_pasar").val(kat);
  $("#id_users").val('');
});
$(function () {
    'use strict';
    var dt_anggota = $('.dt-anggota');
    // DATA ANGGOTA
    if (dt_anggota.length) {
      var dt_ang = dt_anggota.DataTable({
        ajax: "{{route('pedagang-data-admin',['id'=>$kat])}}",
        columns: [
          { data: '' },
          { data: 'name' },
          { data: 'jnama' },
          { data: 'username' },
          { data: 'email' },
          { data: 'ttl' },
          { data: 'telp' },
          { data: 'jk' },
          { data: 'alamat' },
          @if(auth()->user()->role=='admin'){ data: '' }@endif
        ],
        columnDefs: [
          {
            "defaultContent": "-",
            "targets": "_all"
          },
            {
            //number
            targets: 0,
            title: 'No',
            orderable: false,
            render: function (data, type, full, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          }@if(auth()->user()->role=='admin'),
          {
            //number
            targets: -1,
            title: 'Aksi',
            orderable: false,
            render: function (data, type, full, meta) {
              return '<div class="text-center"><a class=" a_show" pdf="'+full.id+'" href="#">'+feather.icons['eye'].toSvg({ class: 'font-small-4' }) +'</a> <a class="a_edit" pdf="'+full.id+'">'+feather.icons['edit'].toSvg({ class: 'font-small-4' }) +'</a> <a class=" a_delete" pdf="'+full.id+'" href="//{{request()->getHttpHost()}}/admin/d/pedagang_delete/'+full.id+'/{{$kat}}">'+feather.icons['trash'].toSvg({ class: 'font-small-4' }) +'</a></div>';
            }
          }@endif
        ],
        dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-outline-secondary dropdown-toggle me-2',
          text: feather.icons['share'].toSvg({ class: 'font-small-4 me-50' }) + 'Export',
          buttons: [
            {
              extend: 'print',
              text: feather.icons['printer'].toSvg({ class: 'font-small-4 me-50' }) + 'Print',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1,2, 3, 4, 5] }
            },
            {
              extend: 'csv',
              text: feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) + 'Csv',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1,2, 3, 4, 5] }
            },
            {
              extend: 'excel',
              text: feather.icons['file'].toSvg({ class: 'font-small-4 me-50' }) + 'Excel',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1,2, 3, 4, 5] }
            },
            {
              extend: 'pdf',
              text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 me-50' }) + 'Pdf',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1,2, 3, 4, 5] }
            },
            {
              extend: 'copy',
              text: feather.icons['copy'].toSvg({ class: 'font-small-4 me-50' }) + 'Copy',
              className: 'dropdown-item',
              exportOptions: { columns: [0, 1,2, 3, 4, 5] }
            }
          ],
          init: function (api, node, config) {
            $(node).removeClass('btn-secondary');
            $(node).parent().removeClass('btn-group');
            setTimeout(function () {
              $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
            }, 50);
          }
        }
      ],
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        language: {
          paginate: {
            // remove previous & next text from pagination
            previous: '&nbsp;',
            next: '&nbsp;'
          }
        }
      });
    }
  });
    $('.dt-anggota').on('click', '.a_edit', function () {
        //dt_anggota.row($(this).parents('tr')).remove().draw();
        var dat = $(this).attr('pdf');
        var url = "//{{request()->getHttpHost()}}/admin/d/pedagang_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
            var id_users=data.data.id+'&&'+data.data.rt+'&&'+data.data.rw;
            $("#basic-icon-default-username").val(data.data.username).change();
            $("#basic-icon-default-email").val(data.data.email).change();
            $("#basic-icon-default-nama").val(data.data.name).change();
            $("#basic-icon-default-ttl").val(data.data.ttl).change();
            $("#basic-icon-default-jk").val(data.data.jk).change();
            $("#basic-icon-default-alamat").val(data.data.alamat).change();
            $("#basic-icon-default-telp").val(data.data.telp).change();
            $("#basic-icon-default-jenis").val(data.data.jenis).change();
            $("#id_kode").val(data.data.id).change();
            $("#id_users").val(data.data.id_users).change();
            $('#backdrop').modal('show'); 
          }
        });
    });
    $('.dt-anggota').on('click', '.a_show', function () {
        //dt_anggota.row($(this).parents('tr')).remove().draw();
        var dat = $(this).attr('pdf');
        var url = "//{{request()->getHttpHost()}}/admin/d/pedagang_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
              var no=('0' + data.data.id).slice(-3)
            var id_users=data.data.id+'&&'+data.data.rt+'&&'+data.data.rw;
            $("#tb-no").html(no);
            $("#tb-tanggal").html(data.data.tanggal);
            $("#tb-nama").html(data.data.name);
            $("#tb-alamat").html(data.data.alamat);
            $("#tb-telp").html(data.data.telp);
            $("#tb-jk").html(data.data.jk);
            $("#tb-ttl").html(data.data.ttl);
            $("#tb-blok").html(data.data.no_kios);
            $("#tb-jenis").html(data.data.jnama);
            $('#backdrop2').modal('show'); 
          }
        });
    });

</script>

@endsection
