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
@endsection


@section('content')
<div class="col-xxl">
    <div class="card mb-4">
        @include('layouts.wasdal.session_notif')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Formulir PSP</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-psp.update',$data['dataEdit']->id_aset)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                 <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ue1">UE 1</label>
                    <div class="col-sm-10">
                        <input value="{{ old('ur_eselon1') ?? $data['dataEdit']->ur_eselon1 }}" name="ue1"
                            type="text" class="form-control" id="ue1" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kode_satker">Kode Satker</label>
                    <div class="col-sm-10">
                        <input value="{{ old('kd_satker_6digit') ?? $data['dataEdit']->kd_satker_6digit }}" name="kode_satker"
                            type="text" class="form-control" id="kode_satker" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nama_satker">Nama Satker</label>
                    <div class="col-sm-10">
                        <input value="{{ old('ur_satker') ?? $data['dataEdit']->ur_satker }}" name="nama_satker"
                            type="text" class="form-control" id="nama_satker" readonly />
                    </div>
                </div>
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
                        <input value="{{ old('rph_buku') ?? $data['dataEdit']->rph_buku }}" name="nilai_buku" step="any" type="number"
                            class="form-control" id="nilai_buku" readonly />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select name="status_psp" class="form-select" id="status_psp" aria-label="Status PSP">
                            <option>Pilih Status PSP</option>
                            @foreach($data['statusPSPOptions'] as $value => $label)
                                <option value="{{ $value }}" {{ $value === $data['oldStatusPSP'] ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nomor_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input value="{{ old('no_psp') ?? $data['dataEdit']->no_psp }}" name="nomor_psp"
                            type="text" class="form-control" id="nomor_psp" placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input value="{{ old('tgl_psp') ?? $data['dataEdit']->tgl_psp }}" name="tanggal_psp" id="tanggal_psp"
                            class="form-control" type="date" id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP">

                            {{ old('ket_psp') ?? ''  }}

                        </textarea>
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
