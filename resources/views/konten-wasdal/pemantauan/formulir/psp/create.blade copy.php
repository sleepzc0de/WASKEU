@extends('layouts.wasdal.master')
@section('css')
 <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" /> --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    {{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" /> --}}
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
    $(document).ready(function(){
        $('#jenis_barang').change(function(){
            var jenisBarangId = $(this).val();
            if(jenisBarangId){
                $.ajax({
                    type:"POST",
                    url:"{{route('getKodeBarang',':id')}}".replace(':id',jenisBarangId),
                     data: {
                        _token: '{{ csrf_token() }}',
                        kd_jns_bmn: jenisBarangId,
                    },
                    success:function(res){
                        if(res){
                            $("#kode_barang").empty();
                            $("#kode_barang").append('<option value="">Pilih Kode Barang</option>');
                            $.each(res,function(key,value){
                                $("#kode_barang").append('<option value="'+value.kd_brg+'">'+value.kd_brg+'-'+value.ur_sskel+'</option>');
                            });
                        }else{
                            $("#kode_barang").empty();
                        }
                    }
                });
            }else{
                $("#kode_barang").empty();
            }
        });
    });

    //  $(document).ready(function(){
    //     $('#kode_barang').change(function(){
    //         var kodeBarangId = $(this).val();
    //         if(kodeBarangId){
    //             $.ajax({
    //                 type:"POST",
    //                 url:"{{route('getNupBarang',':id')}}".replace(':id',kodeBarangId),
    //                  data: {
    //                     _token: '{{ csrf_token() }}',
    //                     kd_brg: kodeBarangId,
    //                 },
    //                 success:function(res){
    //                     if(res){
    //                         $("#nup_barang").empty();
    //                         $("#nup_barang").append('<option value="">Pilih Nup Barang</option>');
    //                         $.each(res,function(key,value){
    //                             $("#nup_barang").append('<option value="'+value.no_aset+'">'+value.no_aset+'</option>');
    //                         });
    //                     }else{
    //                         $("#nup_barang").empty();
    //                     }
    //                 }
    //             });
    //         }else{
    //             $("#nup_barang").empty();
    //         }
    //     });
    // });
</script>

{{-- <script>
  $(document).ready(function() {
    $('#kd_jns_bmn').change(function() {
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
                        $("#kd_brg").empty();
                        $("#kd_brg").append('<option value="">Pilih Kode Barang</option>');
                        $.each(response, function(key, value) {
                            $("#kd_brg").append('<option value="' + value.kd_brg + '">' + value.ur_sskel + '</option>');
                        });
                    } else {
                        $("#kd_brg").empty();
                    }
                }
            });
        } else {
            $("#kd_brg").empty();
            $("#no_aset").empty();
        }
    });

    $('#kd_brg').change(function() {
        var kdJnsBmn = $('#kd_jns_bmn').val();
        var kdBrg = $(this).val();
        if (kdBrg) {
            $.ajax({
                type: 'POST',
                url: "{{ route('getNupBarang', ['id1' => ':id1', 'id2' => ':id2']) }}".replace(':id1', kdJnsBmn).replace(':id2', kdBrg),
                data: {
                        _token: '{{ csrf_token() }}',
                         kd_jns_bmn: kdJnsBmn,
                         kd_brg: kdBrg
                    },

                success: function(response) {
                    if (response) {
                        $("#no_aset").empty();
                        $("#no_aset").append('<option value="">Pilih NUP Barang</option>');
                        $.each(response, function(key, value) {
                            $("#no_aset").append('<option value="' + value.kd_brg + '">' + value.no_aset + '</option>');
                        });
                    } else {
                        $("#no_aset").empty();
                    }
                }
            });
        } else {
            $("#no_aset").empty();
        }
    });
});

</script> --}}

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

@endsection


@section('content')
 <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Formulir PSP</h5><br>
                      @include('layouts.wasdal.session_notif')
                      {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                      <form  action="{{route('form-psp.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="row mb-3">
										<label class="col-sm-2 col-form-label">Jenis Barang</label>
										<div class="col-sm-10">
											<select
                              data-allow-clear="true" id="jenis_barang" value="{{ old('jenis_barang') }}" name="jenis_barang" class="select2 form-select form-select-lg" @error('jenis_barang') is-invalid @enderror required>
												<option>--Pilih Jenis Barang--</option>

												@foreach ($data['siman'] as $item)
												<option value="{{ $item->kd_jns_bmn }}" {{ old('siman') == $item->kd_jns_bmn ? 'selected' : null}}>{{$item->kd_jns_bmn." - ".$item->nm_jns_bmn}}</option>
												@endforeach


											</select>



										</div>
									</div>
                                    <div class="row mb-3">
										<label class="col-sm-2 col-form-label">Kode Barang</label>
										<div class="col-sm-10">
											<select
                                               data-allow-clear="true" id="kode_barang" value="{{ old('kode_barang') }}" name="kode_barang" class="select2 form-select form-select-lg" @error('kode_barang') is-invalid @enderror required>
												<option>--Pilih Kode Barang--</option>
											</select>
										</div>
									</div>
                                     <div class="row mb-3">
										<label class="col-sm-2 col-form-label">Nup Barang</label>
										<div class="col-sm-10">
											<select
                                               data-allow-clear="true" id="nup_barang" value="{{ old('nup_barang') }}" name="nup_barang" class="select2 form-select form-select-lg" @error('nup_barang') is-invalid @enderror required>
												<option>--Pilih Nup Barang--</option>
											</select>
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
                            {{-- <input name="status_psp" type="text" class="form-control" id="status_psp" placeholder="Status PSP" /> --}}
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
                             <textarea
                             name="ket_psp"
                          class="form-control h-px-100"
                          id="ket_psp"
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
                </div>
@endsection
