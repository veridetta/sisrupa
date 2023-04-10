
@extends('layouts/contentLayoutMaster')

@section('title', 'Kios Saya')

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
                    <p class="h4 card-text text-white">Data Kios  Saya</p>
                </div>
            </div>
          </div>
          <div class="card-body" >
            <div class="card-datatable table-responsive pt-3">
              <table class="dt-anggota table">
                <thead class="table-light">
                  <tr>
                    <th>No</th>
                    <th>Nomor Kios</th>
                    <th>Blok</th>
                    <th>Nominal</th>
                    <th>Jatuh Tempo</th>
                    <th>Lokasi Pasar</th>
                    <th>Status</th>
                    <th>Nama Pedagang</th>
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
$(function () {
    'use strict';
    var dt_anggota = $('.dt-anggota');
    // DATA ANGGOTA
    if (dt_anggota.length) {
      var dt_ang = dt_anggota.DataTable({
        ajax: "{{route('blok-data-pedagang')}}",
        columns: [
          { data: '' },
          { data: 'nomor_kios' },
          { data: 'blok' },
          { data: 'nominal' },
          { data: 'jatuh_tempo' },
          { data: 'id_pasar' },
          { data: 'kontrakans.status' },
          { data: 'nama_pedagang' },
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
            targets: 4,
            title: 'Lokasi Pasar',
            orderable: false,
            render: function (data, type, full, meta) {
              if(full.id_pasar=='1'){
                var p='Pasar Cigasong';
              }else{
                var p='Pasar Kadipaten';
              }
              return p;
            }
          },{
            //number
            targets: 3,
            title: 'Jatuh Tempo',
            orderable: false,
            render: function (data, type, full, meta) {
              // Tanggal awal
              var tanggalAwal = new Date(full.jatuh_tempo);
              
              // Mendapatkan pilihan dari pengguna (1 bulan, 3 bulan, atau 1 tahun)
              var pilihan = full.tagihan_kode; // Ganti dengan input dari pengguna

              // Mendapatkan tanggal berikutnya berdasarkan pilihan
              var tanggalBerikutnya;

              if (pilihan === "tgh_bl1") {
                tanggalBerikutnya = new Date(tanggalAwal);
                tanggalBerikutnya.setMonth(tanggalAwal.getMonth() + 1);
              } else if (pilihan === "tgh_bl3") {
                tanggalBerikutnya = new Date(tanggalAwal);
                tanggalBerikutnya.setMonth(tanggalAwal.getMonth() + 3);
              } else if (pilihan === "tgh_th") {
                tanggalBerikutnya = new Date(tanggalAwal);
                tanggalBerikutnya.setFullYear(tanggalAwal.getFullYear() + 1);
              } else {
                console.error("Pilihan tidak valid");
              }

              if (tanggalBerikutnya) {
                // Mendapatkan komponen tanggal berikutnya
                var tahunBerikutnya = tanggalBerikutnya.getFullYear();
                var bulanBerikutnya = ("0" + (tanggalBerikutnya.getMonth() + 1)).slice(-2);
                var tanggalBerikutnya = ("0" + tanggalBerikutnya.getDate()).slice(-2);

                // Format tanggal dalam format YYYY-MM-DD
                var tanggalBerikutnyaFormatted = tahunBerikutnya + "-" + bulanBerikutnya + "-" + tanggalBerikutnya;

                console.log("Tanggal berikutnya: " + tanggalBerikutnyaFormatted);
              } else {
                console.error("Gagal menghitung tanggal berikutnya");
              }
             // console.log("Tanggal berikutnya: " + tanggalBerikutnyaFormatted);

              return tanggalBerikutnyaFormatted;
            }
          },
            {
            //number
            targets: @if(auth()->user()->role=='admin')-3 @else -2 @endif,
            title: 'Status',
            orderable: false,
            render: function (data, type, full, meta) {
              if(full.konstat>0){
                var p = "Disewa";
              }else{
                var p ='<div class="text-center"><a class="a_sewa btn-sm btn btn-primary" pdf="'+full.id+'">Sewa</a> </div>';
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
              return '<div class="text-center"><a class="a_edit btn-sm btn btn-primary" pdf="'+full.id+'">Ubah</a> <a class=" btn-sm a_delete btn btn-primary" pdf="'+full.id+'" href="//{{request()->getHttpHost()}}/admin/m/blok_delete/'+full.id+'/{{$kat}}">Hapus</a></div>';
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
        var url = "//{{request()->getHttpHost()}}/admin/m/blok_data_single/"+dat;
        $.ajax({
          type: "GET",
          url: url,
          success: function(data){
              //if request if made successfully then the response represent the data
              console.log(data);
            //var id_users=data.data.id+'&&'+data.data.rt+'&&'+data.data.rw;
            $("#basic-icon-default-lokasi").val(data.data.id_lokasi).change();
            $("#basic-icon-default-nomor").val(data.data.nomor_kios).change();
            $("#basic-icon-default-blok").val(data.data.blok).change();
            $("#id_kode").val(data.data.id).change();
            $('#backdrop').modal('show'); 
          }
        });
    });
    $('.dt-anggota').on('click', '.a_sewa', function () {
      var dat = $(this).attr('pdf');
      $("#basic-icon-default-id_blok").val(dat).change();
      $('#modalSewa').modal('show');
    });
    

</script>

@endsection
