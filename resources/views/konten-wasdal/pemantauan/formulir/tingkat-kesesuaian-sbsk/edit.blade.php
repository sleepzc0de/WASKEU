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
            <h5 class="mb-0">Tingkat Kesesuaian SBSK | Kode Satker : {{$data->kode_anak_satker}} | Kode Barang:
                {{$data->kode_barang}} | Nup : {{$data->nup}}</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-tingkat-kesesuaian-sbsk.update',$data->id)}}" method="post" enctype="multipart/form-data"
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
                    <label class="col-sm-2 col-form-label" for="penilai_persentase_kesesuaian_sbsk">Penilai Persentase Tingkat Kesesuaian dengan SBSK</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="penilai_persentase_kesesuaian_sbsk" class="select2 form-select form-select-lg"
                            id="penilai_persentase_kesesuaian_sbsk" aria-label="Penilai Persentase Tingkat Kesesuaian dengan SBSK">
                            <option selected disabled>Pilih Penilai Persentase Tingkat Kesesuaian dengan SBSK</option>
                            @foreach ($penilai_kesesuaian_sbsk as $item)
                            <option value="{{ $item->penilai_persentase_kesesuaian_sbsk }}" {{ old('penilai_persentase_kesesuaian_sbsk',$data->penilai_persentase_kesesuaian_sbsk) == $item->id
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_penilai_persentase_kesesuaian_sbsk}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="luas_digunakan">Luas Digunakan</label>
                    <div class="col-sm-10">
                        <input value="{{ old('luas_digunakan') ?? $data->luas_digunakan }}" name="luas_digunakan" type="text"
                            class="form-control" id="luas_digunakan" placeholder="Luas Digunakan" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="luas_sbsk">Luas SBSK</label>
                    <div class="col-sm-10">
                        <input value="{{ old('luas_sbsk') ?? $data->luas_sbsk }}" name="luas_sbsk" type="text"
                            class="form-control" id="luas_sbsk" placeholder="Luas SBSK" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="luas_pengurang">Luas Pengurang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('luas_pengurang') ?? $data->luas_pengurang }}" name="luas_pengurang" type="text"
                            class="form-control" id="luas_pengurang" placeholder="Luas Pengurang" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="luas_ts_db">Luas Tanah Seluruhnya/Luas Dasar Bangunan</label>
                    <div class="col-sm-10">
                        <input value="{{ old('luas_ts_db') ?? $data->luas_ts_db }}" name="luas_ts_db" type="text"
                            class="form-control" id="luas_ts_db" placeholder="Luas Tanah Seluruhnya/Luas Dasar Bangunan" />
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
