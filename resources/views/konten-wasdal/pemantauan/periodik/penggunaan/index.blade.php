@extends('layouts.wasdal.master')
@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <!-- Row Group CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
    <!-- Form Validation -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}" />
@endsection
@section('script')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <!-- Flat Picker -->
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <!-- Form Validation -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>

    <script>
        /**
         * DataTables Basic
         */

        "use strict";

        // datatable (jquery)
        document.addEventListener('DOMContentLoaded', function() {
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
                    ajax: "{{ route('pemantauan-penggunaan.index') }}",
                    autoWidth: true,
                    scrollY: 200,
                    scrollX: true,
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex",
                            width: "10px",
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: "tahun",
                            name: "tahun"
                        },
                        {
                            data: "periode",
                            name: "periode"
                        },
                        {
                            data: "jenis_pemantauan",
                            name: "jenis_pemantauan"
                        },
                        {
                            data: "ue1",
                            name: "ue1"
                        },
                        {
                            data: "nama_satker",
                            name: "nama_satker"
                        },
                        {
                            data: "kode_satker",
                            name: "kode_satker"
                        },
                        {
                            data: "kode_anak_satker",
                            name: "kode_anak_satker"
                        },
                        {
                            data: "nama_anak_satker",
                            name: "nama_anak_satker"
                        },
                        {
                            data: "jenis_barang",
                            name: "jenis_barang"
                        },
                        {
                            data: "kode_barang",
                            name: "kode_barang"
                        },
                        {
                            data: "nama_barang",
                            name: "nama_barang"
                        },
                        {
                            data: "nup",
                            name: "nup"
                        },
                        {
                            data: "nilai_buku",
                            name: "nilai_buku"
                        },
                    ],
                    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 5,
                    lengthMenu: [5, 25, 50, 100],
                    buttons: [{
                        extend: "collection",
                        className: "btn btn-label-primary dropdown-toggle me-2",
                        text: '<i class="mdi mdi-export-variant me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: "print",
                                text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7],
                                    // prevent avatar to be display
                                    format: {
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function(index, item) {
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
                                customize: function(win) {
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
                                        body: function(inner, coldex, rowdex) {
                                            if (inner.length <= 0) return inner;
                                            var el = $.parseHTML(inner);
                                            var result = "";
                                            $.each(el, function(index, item) {
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
                    }, ],

                });
                $("div.head-label").html(
                    '<h5 class="card-title mb-0">Data Pemantauan Penggunaan</h5>'

                );
            }


            // Memuat data di tab "Data Form" saat tab tersebut aktif
            document.querySelectorAll('.nav-link').forEach(function(tab) {
                tab.addEventListener('click', function(event) {
                    event.preventDefault(); // Menghentikan aksi default link

                    // Memperbarui tab yang aktif
                    var target = event.target.getAttribute('data-bs-target');
                    var tab = new bootstrap.Tab(document.querySelector(target));
                    tab.show();

                    // Memanggil fungsi untuk memuat atau memperbarui data pada tab "Data Form"
                    refreshDataFormIfNeeded();
                });
            });

            // Cek apakah tab "Data Form" sedang aktif, jika iya, perbarui datanya
            function refreshDataFormIfNeeded() {
                if (document.querySelector('.nav-link.active').getAttribute('data-bs-target') ===
                    '#navs-justified-profile') {
                    refreshDataForm();
                }
            }

            // Fungsi untuk memuat atau memperbarui data pada tab "Data Form"
            function refreshDataForm() {
                // Implementasi kode untuk memuat atau memperbarui tabel
                // Misalnya, menggunakan AJAX untuk memuat data baru
                dt_basic.ajax.reload(); // Contoh: Menggunakan fungsi reload pada DataTable
            }

            // Filter form control to default size
            // ? setTimeout used for multilingual table initialization
            setTimeout(() => {
                $(".dataTables_filter .form-control").removeClass("form-control-sm");
                $(".dataTables_length .form-select").removeClass("form-select-sm");
            }, 300);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#generateForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                $('#generateBtn').prop('disabled', true); // Disable the button
                $('#loadingIndicator').css('visibility', 'visible'); // Show loading indicator
                // Perform form submission via AJAX
                $.ajax({
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        // Hide loading indicator, enable button, show success notification, and refresh the table
                        $('#loadingIndicator').css('visibility', 'hidden');
                        $('#generateBtn').prop('disabled', false);
                        location.reload(); // Refresh the page to update the table data
                    },
                    error: function(error) {
                        // Handle errors here
                        console.error('Error:', error);
                        $('#loadingIndicator').css('visibility', 'hidden');
                        $('#generateBtn').prop('disabled', false);
                        // Show error notification if needed
                    }
                });
            });
        });
    </script>
@endsection


@section('content')
    <div class="col-xl-12">
        <div class="card mb-4">
            <div class="card-header p-0">
                <div class="nav-align-top">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                <i class="tf-icons mdi mdi-home-outline me-1"></i> Form

                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="false">
                                <i class="tf-icons mdi mdi-account-outline me-1"></i> Data Form
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content p-0">
                    <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                        <!-- FormStyle -->
                        {{-- <div class="card"> --}}
                        <h5 class="card-header">Wasdal Pemantauan Periodik Penggunaan</h5>
                        {{-- <div class="card-body"> --}}
                        <div class="row">
                            <div class="col-12 col-lg-12 mb-4 mb-xl-0 center">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">PSP</h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-psp.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">Kesesuaian PSP</h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-kesesuaian-psp.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">BMN Tidak Digunakan</h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-bmn-tidak-digunakan.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">Tingkat Kesesuaian SBSK</h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-tingkat-kesesuaian-sbsk.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">Penggunaan Sementara</h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-penggunaan-sementara.index') }}"><button
                                                            class="btn btn-primary btn-sm">Wasdal</button></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">Penggunaan Dioperasikan Oleh Pihak Lain
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-operasi-pihak-lain.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">TL Hasil Temuan Penggunaan BMN oleh APIP
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <a href="{{ route('form-tindak-lanjut-apip.index') }}"><button
                                                                class="btn btn-primary btn-sm">Wasdal</button></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                            <img src="{{ asset('assets/img/avatars/form_input.jpg') }}" alt="User Image"
                                                class="rounded-circle me-3 w-px-50" />
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="user-info">
                                                        <h6 class="mb-1">TL Hasil Temuan Penggunaan BMN oleh BPK
                                                        </h6>
                                                        <div class="d-flex align-items-center">
                                                            <div class="user-status me-2 d-flex align-items-center">
                                                                <small>Status Form</small>
                                                                <span
                                                                    class="ms-2 text-danger mdi mdi mdi-alert-decagram"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="add-btn">
                                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--
                        </div> --}}
                        {{--
                    </div> --}}
                        <!--/ FormStyle -->
                    </div>
                    <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                        <div class="card-datatable table-responsive pt-0">
                            <div class="pt-3 px-5">
                                {{-- <a href="{{ route('periodik-penggunaan.create') }}"
                                class="btn btn-label-primary btn-fab demo">
                                <span class="tf-icons mdi mdi-checkbox-marked-circle-outline me-1"></span>Tambah Data
                            </a> --}}
                                @if (count($data) <= 0)
                                    <div class="py-2">
                                        <form id="generateForm" method="POST"
                                            action="{{ route('getDataPemantauanPenggunaan') }}">
                                            @csrf
                                            <div style="display: flex; align-items: center;">
                                                <button id="generateBtn" class="btn btn-label-warning btn-fab demo"
                                                    type="submit"><span
                                                        class="tf-icons mdi mdi-24px mdi-database-sync me-1"></span>Generate
                                                    Data</button>
                                                <div id="loadingIndicator"
                                                    style="display: none; visibility: hidden; display: flex; align-items: center; margin-left: 10px;">
                                                    <span>Sedang Proses Generate, jangan tutup halaman...</span>
                                                    <div class="sk-wave sk-primary" style="margin-left: 5px;">
                                                        <div class="sk-wave-rect"></div>
                                                        <div class="sk-wave-rect"></div>
                                                        <div class="sk-wave-rect"></div>
                                                        <div class="sk-wave-rect"></div>
                                                        <div class="sk-wave-rect"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                @endif

                            </div>

                            <table class="datatables-basic table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TAHUN WASDAL</th>
                                        <th>PERIODE WASDAL</th>
                                        <th>JENIS PEMANTAUAN WASDAL</th>
                                        <th>UE 1</th>
                                        <th>NAMA SATKER</th>
                                        <th>KODE SATKER</th>
                                        <th>KODE ANAK SATKER</th>
                                        <th>NAMA ANAK SATKER</th>
                                        <th>JENIS BMN</th>
                                        <th>KODE BARANG</th>
                                        <th>NAMA BARANG</th>
                                        <th>NUP</th>
                                        <th>NILAI BUKU</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
