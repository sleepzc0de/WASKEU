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


<script>
    $(document).ready(function() {
    // $('#jenis_barang').change(function() {
    //     var kdJnsBmn = $(this).val();
    //     if (kdJnsBmn) {
    //         $.ajax({
    //             type: 'POST',
    //             url:"{{route('getKodeBarang',':id')}}".replace(':id',kdJnsBmn),
    //             data: {
    //                     _token: '{{ csrf_token() }}',
    //                     kd_jns_bmn: kdJnsBmn,
    //                 },
    //             success: function(response) {
    //                 if (response) {
    //                     $("#kode_barang").empty();
    //                     $("#kode_barang").append('<option value="">Pilih Kode Barang</option>');
    //                     $.each(response, function(key, value) {
    //                         $("#kode_barang").append('<option value="' + value.kd_brg + '">' +value.kd_brg+ ' - ' + value.ur_sskel + '</option>');
    //                     });
    //                 } else {
    //                     $("#kode_barang").empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $("#kode_barang").empty();
    //         $("#nup_barang").empty();
    //     }
    // });

    // $('#kode_barang').change(function() {
    //     var kode_jenis_barang = $('#jenis_barang').val();
    //     var kdBrg = $(this).val();
    //     if (kdBrg) {
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('getNupBarang', [':id1', ':id2']) }}".replace(':id1', kode_jenis_barang).replace(':id2', kdBrg),
    //             data: {
    //                     _token: '{{ csrf_token() }}',
    //                      kd_jns_bmn: kode_jenis_barang,
    //                      kd_brg: kdBrg
    //                 },

    //             success: function(response) {
    //                 if (response) {
    //                     $("#nup_barang").empty();
    //                     $("#nup_barang").append('<option value="">Pilih NUP Barang</option>');
    //                     $.each(response, function(key, value) {
    //                         $("#nup_barang").append('<option value="' + value.no_aset + '">' + value.no_aset + '</option>');
    //                     });
    //                 } else {
    //                     $("#nup_barang").empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $("#nup_barang").empty();
    //     }
    // });

    // $('#nup_barang').change(function() {
    //     var kdJnsBmn = $('#jenis_barang').val();
    //     var kdBrg = $('#kode_barang').val();
    //     var noAset = $(this).val();

    //     if (kdJnsBmn && kdBrg && noAset) {
    //         $.ajax({
    //             type: 'POST',
    //             url: "{{ route('getNilaiBukuBarang', [':id1', ':id2',':id3']) }}".replace(':id1', kdJnsBmn).replace(':id2', kdBrg).replace(':id3', noAset),
    //             data: {
    //                 _token: '{{ csrf_token() }}',
    //                 kd_jns_bmn: kdJnsBmn,
    //                 kd_brg: kdBrg,
    //                 no_aset: noAset
    //             },
    //             success: function(response) {
    //                 if (response && response.length > 0) {
    //                     var nilaiBuku = response[0].rph_buku; // Ubah nilai_buku sesuai dengan kolom yang tepat dari respons JSON

    //                     console.log('Nilai Buku:', response.rph_buku);


    //                     // Set nilai buku ke dalam input nilai_buku
    //                     $("#nilai_buku").val(nilaiBuku);
    //                 } else {
    //                     $("#nilai_buku").val('');
    //                     // Tindakan jika nilai buku tidak ditemukan
    //                 }
    //             },
    //             error: function(xhr, status, error) {
    //                 // Tindakan jika terjadi kesalahan dalam permintaan
    //             }
    //         });
    //     } else {
    //         $("#nilai_buku").val('');
    //         // Tindakan jika data yang diperlukan tidak lengkap
    //     }
    // });

    // $('#kode_barang').change(function() {
    //     if (kdJnsBmn) {
    //         $.ajax({
    //             type: 'POST',
    //             url:"{{route('getKodeBarangAll')}}",
    //             data: {
    //                     _token: '{{ csrf_token() }}',
    //                 },
    //             success: function(response) {
    //                 if (response) {
    //                     $("#kode_barang").empty();
    //                     $("#kode_barang").append('<option value="">Pilih Kode Barang</option>');
    //                     $.each(response, function(key, value) {
    //                         $("#kode_barang").append('<option value="' + value.kd_brg + '">' +value.kd_brg+ ' - ' + value.nm_brg + '</option>');
    //                     });
    //                 } else {
    //                     $("#kode_barang").empty();
    //                 }
    //             }
    //         });
    //     } else {
    //         $("#kode_barang").empty();
    //         $("#nup_barang").empty();
    //     }
    // });
});
</script>

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




<script src="{{asset('assets/vendor/libs/cleavejs/cleave.js')}}"></script>
<script src="{{asset('assets/vendor/libs/cleavejs/cleave-phone.js')}}">
    </>
<script src="{{asset('assets/vendor/libs/moment/moment.js')}}">
</script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/js/form-layouts.js')}}"></script>
@endsection


@section('content')

<!-- Collapsible Section -->
<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{route('form-kesesuaian-psp.store')}}" method="post" autocomplete="off">
                @csrf
                <div class="accordion-body">
                    <div class="mb-3">
                        @include('layouts.wasdal.session_notif')
                        <div class="form-check form-check-inline">
                            <input name="collapsible-payment" class="form-check-input form-check-input-payment"
                                type="radio" value="credit-card" id="collapsible-payment-cc" checked="" />
                            <label class="form-check-label" for="collapsible-payment-cc">
                                Default
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input name="collapsible-payment" class="form-check-input form-check-input-payment"
                                type="radio" value="cash" id="collapsible-payment-cash" />
                            <label class="form-check-label" for="collapsible-payment-cash">
                                Nihil
                                <i class="mdi mdi-help-circle-outline text-muted" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Untuk Isian Form Nihil"></i>
                            </label>
                        </div>
                    </div>
                    <div id="form-credit-card" class="row">
                        <div class="col-12 col-md-12 col-xl-12">
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Jenis Barang</label>
                                <div class="col-sm-10">
                                    <select data-allow-clear="true" id="jenis_barang" value="{{ old('jenis_barang') }}"
                                        name="jenis_barang" class="select2 form-select form-select-lg"
                                        @error('jenis_barang') is-invalid @enderror required>
                                        <option selected disabled>--Pilih Jenis Barang--</option>
                                        @foreach ($refJenisBarang as $item)
                                        <option value="{{$item->kd_jns_bmn}}">{{$loop->iteration." -
                                            ".$item->nm_jns_bmn}}</option>
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
                                        <option value="{{ $item->KD_BRG }}">{{$item->KD_BRG." - ".$item->NM_BRG}}
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
                                    <input value="{{ old('nilai_buku') }}" name="nilai_buku" step="any" type="number"
                                        class="form-control" id="nilai_buku" />
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="kesesuaian_psp">Kesesuaian PSP</label>
                                <div class="col-sm-10">
                                    <select name="kesesuaian_psp" class="form-select" id="kesesuaian_psp"
                                        aria-label="Kesesuaian PSP">
                                        <option selected disabled>Pilih Kesesuaian PSP</option>

                                        @foreach ($kesesuaian_psp as $item)
                                        <option value="{{ $item->kesesuaian_psp }}">{{$loop->iteration." -
                                            ".$item->ur_kesesuaian_psp}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="digunakan_sebagai">Digunakan Sebagai</label>
                                <div class="col-sm-10">
                                    <input value="{{ old('digunakan_sebagai') }}" name="digunakan_sebagai" type="text"
                                        class="form-control" id="digunakan_sebagai" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="rencana_alih_fungsi">Rencana Alih Fungsi
                                    Menjadi</label>
                                <div class="col-sm-10">
                                    <select name="rencana_alih_fungsi" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" id="rencana_alih_fungsi"
                                        aria-label="Rencana Alih Fungsi">
                                        <option selected disabled>Pilih Referensi Barang</option>

                                        @foreach ($refKodeBarang as $item)
                                        <option value="{{ $item->KD_BRG }}">{{$item->KD_BRG." - ".$item->NM_BRG}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="mt-1">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
