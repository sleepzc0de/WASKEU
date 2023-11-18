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
    $('#jenis_barang').change(function() {
        var kdJnsBmn = $(this).val();
        if (kdJnsBmn) {
            $.ajax({
                type: 'POST',
                url:"{{route('getKodeBarang',':id')}}".replace(':id',kdJnsBmn),
                data: {
                        _token: '{{ csrf_token() }}',
                        kd_jns_bmn: kdJnsBmn,
                    },
                success: function(response) {
                    if (response) {
                        $("#kode_barang").empty();
                        $("#kode_barang").append('<option value="">Pilih Kode Barang</option>');
                        $.each(response, function(key, value) {
                            $("#kode_barang").append('<option value="' + value.kd_brg + '">' +value.kd_brg+ ' - ' + value.ur_sskel + '</option>');
                        });
                    } else {
                        $("#kode_barang").empty();
                    }
                }
            });
        } else {
            $("#kode_barang").empty();
            $("#nup_barang").empty();
        }
    });

    $('#kode_barang').change(function() {
        var kode_jenis_barang = $('#jenis_barang').val();
        var kdBrg = $(this).val();
        if (kdBrg) {
            $.ajax({
                type: 'POST',
                url: "{{ route('getNupBarang', [':id1', ':id2']) }}".replace(':id1', kode_jenis_barang).replace(':id2', kdBrg),
                data: {
                        _token: '{{ csrf_token() }}',
                         kd_jns_bmn: kode_jenis_barang,
                         kd_brg: kdBrg
                    },

                success: function(response) {
                    if (response) {
                        $("#nup_barang").empty();
                        $("#nup_barang").append('<option value="">Pilih NUP Barang</option>');
                        $.each(response, function(key, value) {
                            $("#nup_barang").append('<option value="' + value.no_aset + '">' + value.no_aset + '</option>');
                        });
                    } else {
                        $("#nup_barang").empty();
                    }
                }
            });
        } else {
            $("#nup_barang").empty();
        }
    });

    $('#nup_barang').change(function() {
        var kdJnsBmn = $('#jenis_barang').val();
        var kdBrg = $('#kode_barang').val();
        var noAset = $(this).val();

        if (kdJnsBmn && kdBrg && noAset) {
            $.ajax({
                type: 'POST',
                url: "{{ route('getNilaiBukuBarang', [':id1', ':id2',':id3']) }}".replace(':id1', kdJnsBmn).replace(':id2', kdBrg).replace(':id3', noAset),
                data: {
                    _token: '{{ csrf_token() }}',
                    kd_jns_bmn: kdJnsBmn,
                    kd_brg: kdBrg,
                    no_aset: noAset
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        var nilaiBuku = response[0].rph_buku; // Ubah nilai_buku sesuai dengan kolom yang tepat dari respons JSON

                        console.log('Nilai Buku:', response.rph_buku);


                        // Set nilai buku ke dalam input nilai_buku
                        $("#nilai_buku").val(nilaiBuku);
                    } else {
                        $("#nilai_buku").val('');
                        // Tindakan jika nilai buku tidak ditemukan
                    }
                },
                error: function(xhr, status, error) {
                    // Tindakan jika terjadi kesalahan dalam permintaan
                }
            });
        } else {
            $("#nilai_buku").val('');
            // Tindakan jika data yang diperlukan tidak lengkap
        }
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    // Menyimpan referensi ke elemen dropdown dan field lainnya
    var statusDropdown = document.getElementById("status_psp");
    var noPSPField = document.getElementById("no_psp");
    var tglPSPField = document.getElementById("tgl_psp");
    var ketPSPField = document.getElementById("ket_psp");

    // Mendengarkan perubahan pada dropdown
    statusDropdown.addEventListener("change", function() {
      // Jika opsi "Belum PSP" dipilih, nonaktifkan field lainnya
      if (statusDropdown.value === "BELUM_PSP") {
        noPSPField.disabled = true;
        tglPSPField.disabled = true;
        ketPSPField.disabled = true;
      } else {
        // Jika opsi lain dipilih, aktifkan kembali field lainnya
        noPSPField.disabled = false;
        tglPSPField.disabled = false;
        ketPSPField.disabled = false;
      }
    });
  });
</script>

<script src="{{asset('')}}assets/vendor/libs/cleavejs/cleave.js"></script>
<script src="{{asset('')}}assets/vendor/libs/cleavejs/cleave-phone.js"></script>
<script src="{{asset('')}}assets/vendor/libs/moment/moment.js"></script>
<script src="{{asset('')}}assets/vendor/libs/flatpickr/flatpickr.js"></script>
{{-- <script src="{{asset('')}}assets/vendor/libs/select2/select2.js"></script> --}}
<script src="{{asset('assets/js/form-layouts.js')}}"></script>
@endsection


@section('content')

<!-- Collapsible Section -->
{{-- <div class="row my-4">
    <div class="col">
        <h6>Collapsible Section</h6>
        <div class="accordion" id="collapsibleSection">
            <!-- Payment Method -->
            <div class="card accordion-item">
                <h2 class="accordion-header" id="headingPaymentMethod">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsePaymentMethod" aria-expanded="true"
                        aria-controls="collapsePaymentMethod">
                        Payment Method
                    </button>
                </h2>
                <div id="collapsePaymentMethod" class="accordion-collapse collapse"
                    aria-labelledby="headingPaymentMethod" data-bs-parent="#collapsibleSection">

                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="col-xxl">
    <div class="card mb-4">
        <div class="card-body">
           <form action="{{route('form-psp.store')}}" method="post" autocomplete="off">
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
                            name="jenis_barang" class="select2 form-select form-select-lg" @error('jenis_barang')
                            is-invalid @enderror required>
                            <option value="KOSONG">--Pilih Jenis Barang--</option>

                            @foreach ($data['siman'] as $item)
                            <option value="{{ $item->kd_jns_bmn }}" {{ old('siman')==$item->kd_jns_bmn ? 'selected' :
                                null}}>{{$item->kd_jns_bmn." - ".$item->nm_jns_bmn}}</option>
                            @endforeach


                        </select>



                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" id="kode_barang" value="{{ old('kode_barang') }}"
                            name="kode_barang" class="select2 form-select form-select-lg" @error('kode_barang')
                            is-invalid @enderror required>
                            <option value="KOSONG">--Pilih Kode Barang--</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nup Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" id="nup_barang" value="{{ old('nup') }}" name="nup"
                            class="select2 form-select form-select-lg" @error('nup') is-invalid @enderror required>
                            <option value="KOSONG">--Pilih Nup Barang--</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nilai_buku">Nilai Buku</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nilai_buku') }}" name="nilai_buku" step="any" type="number"
                            class="form-control" id="nilai_buku" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select name="status_psp" class="form-select" id="status_psp" aria-label="Status PSP">
                            <option selected value="KOSONG">Pilih Status PSP</option>
                            <option value="SUDAH_PSP">Sudah PSP</option>
                            <option value="BELUM_PSP">Belum PSP</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="no_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input name="no_psp" type="text" class="form-control" id="no_psp" placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tgl_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input name="tgl_psp" id="tgl_psp" class="form-control" type="date" id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP"></textarea>
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
{{-- <div class="col-xxl">
    <div class="card mb-4">
        @include('layouts.wasdal.session_notif')
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Formulir PSP</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-psp.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" id="jenis_barang" value="{{ old('jenis_barang') }}"
                            name="jenis_barang" class="select2 form-select form-select-lg" @error('jenis_barang')
                            is-invalid @enderror required>
                            <option>--Pilih Jenis Barang--</option>

                            @foreach ($data['siman'] as $item)
                            <option value="{{ $item->kd_jns_bmn }}" {{ old('siman')==$item->kd_jns_bmn ? 'selected' :
                                null}}>{{$item->kd_jns_bmn." - ".$item->nm_jns_bmn}}</option>
                            @endforeach


                        </select>



                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" id="kode_barang" value="{{ old('kode_barang') }}"
                            name="kode_barang" class="select2 form-select form-select-lg" @error('kode_barang')
                            is-invalid @enderror required>
                            <option>--Pilih Kode Barang--</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nup Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" id="nup_barang" value="{{ old('nup') }}" name="nup"
                            class="select2 form-select form-select-lg" @error('nup') is-invalid @enderror required>
                            <option>--Pilih Nup Barang--</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nilai_buku">Nilai Buku</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nilai_buku') }}" name="nilai_buku" step="any" type="number"
                            class="form-control" id="nilai_buku" readonly />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select name="status_psp" class="form-select" id="status_psp" aria-label="Status PSP">
                            <option selected>Pilih Status PSP</option>
                            <option value="SUDAH_PSP">Sudah PSP</option>
                            <option value="BELUM_PSP">Belum PSP</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="no_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input name="no_psp" type="text" class="form-control" id="no_psp" placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tgl_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input name="tgl_psp" id="tgl_psp" class="form-control" type="date" id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP"></textarea>
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
</div> --}}
@endsection
