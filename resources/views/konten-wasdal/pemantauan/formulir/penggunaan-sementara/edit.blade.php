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

<!-- Tambahkan script di bagian bawah sebelum </body> -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var kesesuaianPSP = document.getElementById("kesesuaian_psp");
        var digunakanSebagai = document.getElementById("digunakan_sebagai").parentElement.parentElement;
        var rencanaAlihFungsi = document.getElementById("rencana_alih_fungsi").parentElement.parentElement;

        // Fungsi untuk menampilkan atau menyembunyikan formulir berdasarkan nilai yang dipilih
        function toggleFormVisibility() {
            if (kesesuaianPSP.value === "TIDAK_SESUAI_PSP") {
                digunakanSebagai.style = "block";
                rencanaAlihFungsi.style = "block";
            } else {
                digunakanSebagai.style.display = "none";
                rencanaAlihFungsi.style.display = "none";
            }
        }

        // Fungsi untuk mengatur kembali keadaan default formulir saat tombol reset ditekan
        function resetForm() {
            digunakanSebagai.style.display = "none";
            rencanaAlihFungsi.style.display = "none";
        }

        // Panggil fungsi saat halaman dimuat dan saat nilai dipilih di opsi "Kesesuaian PSP"
        toggleFormVisibility();
        kesesuaianPSP.addEventListener("change", toggleFormVisibility);

        // Panggil fungsi saat tombol reset ditekan
        var resetButton = document.querySelector("button[type='reset']");
        resetButton.addEventListener("click", resetForm);
    });
</script>

@endsection


@section('content')
<div class="col-xxl">
    <div class="card mb-4">
        @include('layouts.wasdal.session_notif')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Kesesuaian PSP | Kode Satker : {{$data->kode_anak_satker}} | Kode Barang:
                {{$data->kode_barang}} | Nup : {{$data->nup}}</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-penggunaan-sementara.update',$data->id)}}" method="post" enctype="multipart/form-data"
                autocomplete="off">
                @csrf
                @method('PUT')
                 <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nilai_buku">Nilai Buku</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nilai_buku') ?? $data->nilai_buku }}" name="nilai_buku" type="text"
                            class="form-control" id="nilai_buku" placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="dok_rp4">Dokumen RP4</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="dok_rp4" class="select2 form-select form-select-lg"
                            id="dok_rp4" aria-label="Dokumen RP4">
                            <option selected disabled>Pilih Dokumen RP4</option>
                            @foreach ($dok_rp4 as $item)
                            <option value="{{ $item->dok_rp4 }}" {{ old('dok_rp4',$data->dok_rp4) == $item->dok_rp4
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_dok_rp4}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_persetujuan">Status Persetujuan</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="status_persetujuan" class="select2 form-select form-select-lg"
                            id="status_persetujuan" aria-label="Status Persetujuan">
                            <option selected disabled>Pilih Status Persetujuan</option>
                            @foreach ($status_persetujuan as $item)
                            <option value="{{ $item->status_persetujuan }}" {{ old('status_persetujuan',$data->status_persetujuan) == $item->status_persetujuan
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_status_persetujuan}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="bentuk_persetujuan">Bentuk Persetujuan</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="bentuk_persetujuan" class="select2 form-select form-select-lg"
                            id="bentuk_persetujuan" aria-label="Bentuk Persetujuan">
                            <option selected disabled>Pilih Bentuk Persetujuan</option>
                            @foreach ($bentuk_persetujuan as $item)
                            <option value="{{ $item->bentuk_persetujuan }}" {{ old('bentuk_persetujuan',$data->bentuk_persetujuan) == $item->bentuk_persetujuan
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_bentuk_persetujuan}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_persetujuan">Keterangan Persetujuan</label>
                    <div class="col-sm-10">
                        <textarea name="ket_persetujuan" class="form-control h-px-100" id="ket_persetujuan"
                            placeholder="Keterangan Persetujuan">

                            {{ old('ket_persetujuan') ?? $data->ket_persetujuan  }}

                        </textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_pelaksanaan">Status Pelaksanaan</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="status_pelaksanaan" class="select2 form-select form-select-lg"
                            id="status_pelaksanaan" aria-label="Status Pelaksanaan">
                            <option selected disabled>Pilih Status Pelaksanaan</option>
                            @foreach ($status_pelaksanaan as $item)
                            <option value="{{ $item->status_pelaksanaan }}" {{ old('status_pelaksanaan',$data->status_pelaksanaan) == $item->status_pelaksanaan
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_status_pelaksanaan}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_pelaksanaan">Keterangan Pelaksanaan</label>
                    <div class="col-sm-10">
                        <textarea name="ket_pelaksanaan" class="form-control h-px-100" id="ket_pelaksanaan"
                            placeholder="Keterangan Pelaksanaan">

                            {{ old('ket_pelaksanaan') ?? $data->ket_pelaksanaan  }}

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
