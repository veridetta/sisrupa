
@extends('layouts/contentLayoutMaster')

@section('title', 'Data Penyewaan Kios '.$pasar)

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
        aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal" data-bs-target="#backdrop"><span>Tambah Sewa Baru</span></button>
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
                    <p class="h4 card-text text-white">Data Penyewaan {{$pasar}}</p>
                </div>
            </div>
          </div>
          <div class="card-body" >
            <div class="card-datatable table-responsive pt-3">
              <table class="dt-anggota table">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nama Pedagang</th>
                    <th>Jenis Dagangan</th>
                    <th>Lokasi</th>
                    <th>Blok</th>
                    <th>Tanggal</th>
                    <th>Tagihan</th>
                    <th>Nominal Tagihan</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    @if(auth()->user()->role=='admin')
                    <th>Status</th>
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
              <h4 class="modal-title" id="myModalLabel4">Tambah Sewa Baru</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="add-new-user pt-0" id="myForm" method="POST" action="{{route('penyewaan-add-admin')}}">
                @csrf
                <input type="hidden" name="id" value="" id="id_kode"/>
                <input type="hidden" name="id_pasar" value="{{$kat}}" id="id_pasar"/>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-id_pedagang">Nama Pedagang</label>
                  <select
                    type="text"
                    id="basic-icon-default-id_pedagang"
                    class="form-control dt-id_pedagang"
                    name="id_pedagang"
                    placeholder="Agus S"
                    value="{{old('id_pedagang')}}">
                    @foreach ($pedagangs as $pedagang)
                      <option value="{{$pedagang->id}}">{{$pedagang->name}}</option>
                    @endforeach
                  </select>
                  @error('id_pedagang')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-id_blok">Nama Blok / Kios</label>
                  <select
                    type="text"
                    id="basic-icon-default-id_blok"
                    class="form-control dt-id_blok"
                    name="id_blok"
                    placeholder="Agus S"
                    value="{{old('id_blok')}}">
                    @foreach ($bloks as $blok)
                      <option value="{{$blok->id}}" @if ($blok->kst>0)
                        disabled
                      @endif>{{$blok->nama .' - '.$blok->blok.' - '.$blok->nomor_kios}} @if ($blok->kst>0)
                       (Sudah disewa)
                    @endif</option>
                    @endforeach
                  </select>
                  @error('id_blok')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-id_tagihan">Jenis Tagihan</label>
                  <select
                    type="text"
                    id="basic-icon-default-id_tagihan"
                    class="form-control dt-id_tagihan"
                    name="id_tagihan"
                    placeholder="Agus S"
                    value="{{old('id_tagihan')}}">
                    @foreach ($tagihans as $tagihan)
                      <option value="{{$tagihan->id}}">{{$tagihan->nama .' - '.$tagihan->nominal}}</option>
                    @endforeach
                  </select>
                  @error('id_tagihan')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-tanggal">Tanggal</label>
                  <input
                    type="date"
                    id="basic-icon-default-tanggal"
                    class="form-control dt-tanggal"
                    name="tanggal"
                    placeholder="xxxx"
                    value="{{old('tanggal')}}"
                  />
                  @error('tanggal')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>
                <div class="mb-1">
                  <label class="form-label" for="basic-icon-default-ket">Keterangan</label>
                  <textarea
                    type="password"
                    id="basic-icon-default-ket"
                    class="form-control dt-ket"
                    name="ket"
                    placeholder="xxxx"
                    value="{{old('ket')}}"></textarea>
                  @error('ket')
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
  $("#id_kode").val('');
});
$(function () {
    'use strict';
    var dt_anggota = $('.dt-anggota');
    // DATA ANGGOTA
    if (dt_anggota.length) {
      var dt_ang = dt_anggota.DataTable({
        ajax: "{{route('penyewaan-data-admin',['id'=>$kat])}}",
        columns: [
          { data: '' },
          { data: 'name' },
          { data: 'jnama' },
          { data: 'lokasi' },
          { data: 'blok' },
          { data: 'tanggal' },
          { data: 'tnama' },
          { data: 'nominal' },
          { data: 'keterangan' },
          { data: 'status' },
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
          },
            {
            //number
            targets: @if(auth()->user()->role=='admin')-2 @else -1 @endif,
            title: 'Status',
            orderable: false,
            render: function (data, type, full, meta) {
              if(full.status>0){
                var p="Aktif";
              }else{
                var p="Nonaktif";
              }
              return p;
            }
          }@if(auth()->user()->role=='admin'),
          {
            //number
            targets: -1,
            title: 'Aksi',
            orderable: false,
            render: function (data, type, full, meta) {
              return '<div class="text-center"><a class="a_edit btn-sm btn btn-primary" pdf="'+full.id+'">Ubah</a> <a class=" btn-sm a_delete btn btn-primary" pdf="'+full.id+'" href="//{{request()->getHttpHost()}}/admin/p/penyewaan_delete/'+full.id+'/{{$kat}}">Hapus</a></div>';
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
        var url = "//{{request()->getHttpHost()}}/admin/p/penyewaan_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
            var id_users=data.data.id+'&&'+data.data.rt+'&&'+data.data.rw;
            $("#basic-icon-default-id_pedagang").val(data.data.id_pedagang).change();
            $("#basic-icon-default-id_blok").val(data.data.id_blok).change();
            $("#basic-icon-default-id_tagihan").val(data.data.id_tagihan).change();
            $("#basic-icon-default-tanggal").val(data.data.tanggal).change();
            $("#basic-icon-default-keterangan").val(data.data.keterangan).change();
            $("#id_kode").val(data.data.id).change();
            $('#backdrop').modal('show'); 
          }
        });
    });

</script>

@endsection
