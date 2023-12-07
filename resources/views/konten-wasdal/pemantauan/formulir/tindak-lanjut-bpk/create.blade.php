@extends('layouts.wasdal.master')
@section('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    {{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    {{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    {{--
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
@endsection
@section('script')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    {{-- <script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    {{-- <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    {{-- <script src="{{asset('assets/js/forms-tagify.js')}}"></script> --}}
    {{-- <script src="{{asset('assets/js/forms-typeahead.js')}}"></script> --}}

    <script src="{{ asset('') }}assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="{{ asset('') }}assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="{{ asset('') }}assets/vendor/libs/moment/moment.js"></script>
    <script src="{{ asset('') }}assets/vendor/libs/flatpickr/flatpickr.js"></script>
    {{-- <script src="{{asset('')}}assets/vendor/libs/select2/select2.js"></script> --}}
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>

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
            {{-- <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Kesesuaian PSP | Kode Satker : {{$data->kode_anak_satker}} | Kode Barang:
                {{$data->kode_barang}} | Nup : {{$data->nup}}</h5><br>
        </div> --}}
            <div class="card-body">
                <form action="{{ route('form-tindak-lanjut-bpk.store') }}" method="post" enctype="multipart/form-data"
                    autocomplete="off">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Jenis Barang</label>
                        <div class="col-sm-10">
                            <select data-allow-clear="true" id="jenis_barang" value="{{ old('jenis_barang') }}"
                                name="jenis_barang" class="select2 form-select form-select-lg"
                                @error('jenis_barang') is-invalid @enderror required>
                                <option selected disabled>--Pilih Jenis Barang--</option>
                                @foreach ($refJenisBarang as $item)
                                    <option value="{{ $item->kd_jns_bmn }}">
                                        {{ $loop->iteration .
                                            " -
                                                                        " .
                                            $item->nm_jns_bmn }}
                                    </option>
                                @endforeach



                            </select>



                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <select data-allow-clear="true" id="kode_barang" value="{{ old('kode_barang') }}"
                                name="kode_barang" class="select2 form-select form-select-lg"
                                @error('kode_barang') is-invalid @enderror required>
                                <option selected disabled>--Pilih Kode Barang--</option>
                                @foreach ($refKodeBarang as $item)
                                    <option value="{{ $item->KD_BRG }}">{{ $item->KD_BRG . ' - ' . $item->NM_BRG }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nup">Nup Barang</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nup') }}" name="nup" type="number" class="form-control"
                                id="nup" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="nilai_buku">Nilai Buku</label>
                        <div class="col-sm-10">
                            <input value="{{ old('nilai_buku') }}" name="nilai_buku" type="text" class="form-control"
                                id="nilai_buku" placeholder="Nilai Buku" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="ket_hasil_temuan_bpk">Hasil Temuan</label>
                        <div class="col-sm-10">
                            <textarea name="ket_hasil_temuan_bpk" class="form-control h-px-100" id="ket_hasil_temuan_bpk"
                                placeholder="Hasil Temuan">

                            {{ old('ket_hasil_temuan_bpk') }}

                        </textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="tindak_lanjut_bpk">Status Tindak Lanjut</label>
                        <div class="col-sm-10">
                            <select data-allow-clear="true" name="tindak_lanjut_bpk"
                                class="select2 form-select form-select-lg" id="tindak_lanjut_bpk"
                                aria-label="Status Tindak Lanjut">
                                <option selected disabled>Pilih Status Tindak Lanjut</option>
                                @foreach ($refTindakLanjut as $item)
                                    <option value="{{ $item->tindak_lanjut }}">
                                        {{ $loop->iteration . ' - ' . $item->ur_tindak_lanjut }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="ket_tinjut_bpk">Keterangan Tindak Lanjut Temuan bpk</label>
                        <div class="col-sm-10">
                            <textarea name="ket_tinjut_bpk" class="form-control h-px-100" id="ket_tinjut_bpk"
                                placeholder="Keterangan Tindak Lanjut Temuan bpk">

                            {{ old('ket_tinjut_bpk') }}

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
