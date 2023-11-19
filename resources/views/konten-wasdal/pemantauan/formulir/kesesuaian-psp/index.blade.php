@extends('layouts.wasdal.master')
@section('css')
<!-- Vendors CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css')}}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css')}}" />
<!-- Form Validation -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css')}}" />
{{-- <meta name="psp-form-index" content="{{ route('form-psp.index') }}"> --}}

@endsection
@section('script')

<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<!-- Flat Picker -->
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<!-- Form Validation -->
<script src="{{asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js')}}"></script>
<script src="{{asset('assets/vendor/js/dropdown-hover.js')}}"></script>

<!-- Page JS -->
{{-- <script src="{{asset('assets/js/wasdal/datatables-form-psp.js')}}"></script> --}}
<script>
    /**
 * DataTables Basic
 */

"use strict";

// datatable (jquery)
$(function () {
    var dt_basic_table = $(".datatables-basic"),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            processing: true,
            language: {
                // Mengatur pesan loading
                processing: '<i class="fa fa-spinner fa-spin"></i> Loading...'
            },
            serverSide: true,
            ajax: "{{ route('form-kesesuaian-psp.index') }}",
            autoWidth: true,
            scrollY: 200,
            scrollX: true,
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    width: "10px",
                    orderable: false,
                    searchable: false,
                },
                { data: "nm_jns_bmn", name: "nm_jns_bmn" },
                { data: "kd_brg", name: "kd_brg" },
                { data: "no_aset", name: "no_aset" },
                { data: "rph_buku", name: "rph_buku" },
                { data: "tgl_psp", name: "tgl_psp" },
                { data: "status_psp", name: "status_psp" },
                { data: "no_psp", name: "no_psp" },
                { data: "status_sesuai_Form1", name: "status_sesuai_Form1" },
                {
                    data: "opsi",
                    name: "opsi",
                    orderable: false,
                    searchable: false,
                },
            ],
            // columnDefs: [
            //     {
            //         // For Responsive
            //         className: "control",
            //         orderable: false,
            //         searchable: false,
            //         responsivePriority: 2,
            //         targets: 0,
            //         render: function (data, type, full, meta) {
            //             return "";
            //         },
            //     },
            // ],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 5,
            lengthMenu: [5,25,50,100],
            buttons: [
                {
                    extend: "collection",
                    className: "btn btn-label-primary dropdown-toggle me-2",
                    text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.bodyBg
                                    );
                                $(win.document.body)
                                    .find("table")
                                    .addClass("compact")
                                    .css("color", "inherit")
                                    .css("border-color", "inherit")
                                    .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [0, 1, 2, ],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name"
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                    ],
                },
            ],

        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">Penggunaan - Data Awal Wasdal PSP</h5>'

        );
    }

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});

</script>
@endsection


@section('content')

<!-- DataTable with Buttons -->
<div class="card">

    <div class="card-datatable table-responsive pt-0">
        <div class="pt-3 px-5">
            <a href="{{ route('form-psp.create') }}" class="btn btn-label-primary btn-fab demo">
                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1"></span>Tambah Data
            </a>

        </div>

        <table class="datatables-basic table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>JENIS BMN</th>
                    <th>KODE BARANG</th>
                    <th>NUP</th>
                    <th>NILAI BUKU</th>
                    <th>TANGGAL PSP</th>
                    <th>STATUS PSP</th>
                    <th>NOMOR PSP</th>
                    <th>STATUS SESUAI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection
