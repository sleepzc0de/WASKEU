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
            <form action="{{route('form-kesesuaian-psp.update',$data->id)}}" method="post" enctype="multipart/form-data"
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
                    <label class="col-sm-2 col-form-label" for="kesesuaian_psp">Kesesuaian PSP</label>
                    <div class="col-sm-10">
                        <select name="kesesuaian_psp" class="form-select"
                            id="kesesuaian_psp" aria-label="Kesesuaian PSP">
                            <option selected disabled>Pilih Kesesuaian PSP</option>
                            @foreach ($kesesuaian_psp as $item)
                            <option value="{{ $item->kesesuaian_psp }}" {{ old('kesesuaian_psp',$data->kesesuaian_psp) == $item->id
                                ?
                                'selected' : ''}}>{{$loop->iteration." - ".$item->ur_kesesuaian_psp}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="digunakan_sebagai">Digunakan Sebagai</label>
                    <div class="col-sm-10">
                        <input value="{{ old('digunakan_sebagai') ?? $data->digunakan_sebagai }}"
                            name="digunakan_sebagai" type="text" class="form-control" id="digunakan_sebagai"
                            placeholder="Digunakan Sebagai" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="rencana_alih_fungsi">Rencana Alih Fungsi</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="rencana_alih_fungsi"
                            class="select2 form-select form-select-lg" id="rencana_alih_fungsi"
                            aria-label="Rencana Alih Fungsi">
                            <option selected disabled>Pilih Referensi Barang</option>
                            @foreach ($refKodeBarang as $item)
                            <option value="{{ $item->NM_BRG }}" {{ old('rencana_alih_fungsi',$data->rencana_alih_fungsi)
                                == $item->KD_BRG ?
                                'selected' : ''}}>{{$item->KD_BRG." - ".$item->NM_BRG}}</option>
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
