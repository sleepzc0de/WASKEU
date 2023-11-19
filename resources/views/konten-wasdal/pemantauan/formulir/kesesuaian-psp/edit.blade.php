@extends('layouts.wasdal.master')
@section('css')
<!-- Vendors CSS -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
{{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
{{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" /> --}}
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
{{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
@endsection
@section('script')


<!-- Vendors JS -->
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script> --}}
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
{{-- <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script> --}}
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
{{-- <script src="{{asset('assets/js/forms-tagify.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/forms-typeahead.js')}}"></script> --}}

<script src="{{asset('')}}assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="{{asset('')}}assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<script src="{{asset('')}}assets/vendor/libs/moment/moment.js"></script>
<script src="{{asset('')}}assets/vendor/libs/flatpickr/flatpickr.js"></script>
{{-- <script src="{{asset('')}}assets/vendor/libs/select2/select2.js"></script> --}}
<script src="{{asset('assets/js/form-layouts.js')}}"></script>


 <script>
        document.addEventListener('DOMContentLoaded', function() {
            var kesesuaianPSPDropdown = document.getElementById('kesesuaian_psp');
            var inputDigunakanSebagai = document.getElementById('digunakan_sebagai').parentElement.parentElement;
            var rencanaAlihFungsi = document.getElementById("rencana_alih_fungsi").parentElement.parentElement;


            function toggleInputDigunakanSebagai() {
                if (kesesuaianPSPDropdown.value === 'TIDAK_SESUAI_PSP') {
                    inputDigunakanSebagai.style = 'block';
                    rencanaAlihFungsi.style = 'block';
                } else {
                    inputDigunakanSebagai.style.display = 'none';
                    rencanaAlihFungsi.style.display = 'none';
                }
            }

            // Panggil fungsi toggle saat halaman dimuat dan saat dropdown berubah
            toggleInputDigunakanSebagai();
            kesesuaianPSPDropdown.addEventListener('change', toggleInputDigunakanSebagai);
        });
 </script>



@endsection


@section('content')
<div class="col-xxl">
    <div class="card mb-4">
        @include('layouts.wasdal.session_notif')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Formulir PSP</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-kesesuaian-psp.update',$data['dataEdit']->id_aset)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="jenis_barang">Jenis Barang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nm_jns_bmn') ?? $data['dataEdit']->nm_jns_bmn }}" name="jenis_barang"
                            type="text" class="form-control" id="jenis_barang" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kode_barang">Kode Barang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('kd_brg') ?? $data['dataEdit']->kd_brg }}" name="kode_barang" type="text"
                            class="form-control" id="kode_barang" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nup">Nup Barang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('no_aset') ?? $data['dataEdit']->no_aset }}" name="nup" type="text"
                            class="form-control" id="nup" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nilai_buku">Nilai Buku</label>
                    <div class="col-sm-10">
                        @php
                        $formattedRphBuku = number_format($data['dataEdit']->rph_buku, 0, ',', '.');
                        @endphp
                        <input value="{{ old('rph_buku') ?? $formattedRphBuku }}" name="rph_buku" step="any" type="text"
                            class="form-control" id="nilai_buku" readonly />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kesesuaian_psp">Kesuaian PSP</label>
                    <div class="col-sm-10">
                        <select name="kesesuaian_psp" class="form-select" id="kesesuaian_psp" aria-label="Status PSP">
                            <option selected disabled>Pilih Kesesuaian PSP</option>
                             @foreach($data['statusPSPOptions'] as $value => $label)
                                <option value="{{ $value }}" {{ $value === $data['oldStatusPSP'] ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                 <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="digunakan_sebagai">Digunakan Sebagai</label>
                    <div class="col-sm-10">
                        <input value="{{ old('digunakan_sebagai') ?? $data['dataEdit']->digunakan_sebagai }}" name="digunakan_sebagai"
                            type="text" class="form-control" id="digunakan_sebagai" placeholder="Digunakan Sebagai" />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="rencana_alih_fungsi">Rencana Alih Fungsi Menjadi</label>
                    <div class="col-sm-10">
                          <select data-allow-clear="true" name="rencana_alih_fungsi" class="select2 form-select form-select-lg" id="rencana_alih_fungsi" aria-label="Rencana Alih Fungsi">
                            <option selected disabled>Pilih Referensi Barang</option>
                             @foreach($data['refBarang'] as $item)
                                <option value="{{ $item->kd_brg }}">{{ $item->kd_brg." - ".$item->ur_sskel }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
