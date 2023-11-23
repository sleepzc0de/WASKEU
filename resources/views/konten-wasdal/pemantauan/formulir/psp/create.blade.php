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
{{-- <div class="col-xxl">
    <div class="card mb-4">
        @include('layouts.wasdal.session_notif')
        <div class="card-header d-flex align-items-center justify-content-between">
        </div>
        <div class="card-body">
            <form action="{{route('form-psp.store')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="jenis_barang">Jenis Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="jenis_barang" class="select2 form-select form-select-lg"
                            id="jenis_barang" aria-label="Jenis Barang">
                            <option selected disabled>Pilih Jenis Barang</option>
                            @foreach ($refJenisBarang as $item)
                            <option value="{{$item->kd_jns_bmn}}">{{$loop->iteration." - ".$item->nm_jns_bmn}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kode_barang">Kode Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="kode_barang" class="select2 form-select form-select-lg"
                            id="kode_barang" aria-label="Kode Barang">
                            <option selected disabled>Pilih Kode Barang</option>
                            @foreach ($refKodeBarang as $item)
                            <option value="{{ $item->KD_BRG }}">{{$item->KD_BRG." - ".$item->NM_BRG}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nup">Nup Barang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nup') }}" name="nup" type="number" class="form-control" id="nup" />
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
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="status_psp" class="form-select    " id="status_psp"
                            aria-label="Status PSP">
                            <option selected disabled>Pilih Status PSP</option>
                            @foreach ($status_psp as $item)
                            <option value="{{ $item->id }}">{{$loop->iteration." - ".$item->ur_status_psp}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nomor_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input name="nomor_psp" type="text" class="form-control" id="nomor_psp"
                            placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input name="tanggal_psp" id="tanggal_psp" class="form-control" type="date"
                            id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP">
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
                    <label class="col-sm-2 col-form-label" for="jenis_barang">Jenis Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="jenis_barang" class="select2 form-select form-select-lg"
                            id="jenis_barang" aria-label="Jenis Barang">
                            <option selected disabled>Pilih Jenis Barang</option>
                            @foreach ($refJenisBarang as $item)
                            <option value="{{$item->nm_jns_bmn}}">{{$loop->iteration." - ".$item->nm_jns_bmn}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="kode_barang">Kode Barang</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="kode_barang" class="select2 form-select form-select-lg"
                            id="kode_barang" aria-label="Kode Barang">
                            <option selected disabled>Pilih Kode Barang</option>
                            @foreach ($refKodeBarang as $item)
                            <option value="{{ $item->KD_BRG }}">{{$item->KD_BRG." - ".$item->NM_BRG}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nup">Nup Barang</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nup') }}" name="nup" type="number" class="form-control" id="nup" />
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
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="status_psp" class="form-select    " id="status_psp"
                            aria-label="Status PSP">
                            <option selected disabled>Pilih Status PSP</option>
                            @foreach ($status_psp as $item)
                            <option value="{{ $item->status_psp }}">{{$loop->iteration." - ".$item->ur_status_psp}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nomor_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input name="nomor_psp" type="text" class="form-control" id="nomor_psp"
                            placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input name="tanggal_psp" id="tanggal_psp" class="form-control" type="date"
                            id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP">
                        </textarea>
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
