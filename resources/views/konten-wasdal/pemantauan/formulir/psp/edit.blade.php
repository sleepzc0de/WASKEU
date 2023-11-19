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
            <h5 class="mb-0">Wasdal Formulir PSP | Kode Satker : {{$data->kode_anak_satker}} | Kode Barang: {{$data->kode_barang}} | Nup : {{$data->nup}}</h5><br>
        </div>
        <div class="card-body">
            <form action="{{route('form-psp.update',$data->id)}}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                    <div class="col-sm-10">
                        <select data-allow-clear="true" name="status_psp" class="select2 form-select form-select-lg" id="status_psp" aria-label="Status PSP">
                            <option selected disabled>Pilih Status PSP</option>
                           	@foreach ($status_psp as $item)
												<option value="{{ $item->id }}" {{ old('status_psp',$data->status_psp) == $item->id ? 'selected' : ''}}>{{$loop->iteration." - ".$item->ur_status_psp}}</option>
							@endforeach

                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="nomor_psp">Nomor PSP</label>
                    <div class="col-sm-10">
                        <input value="{{ old('nomor_psp') ?? $data->nomor_psp }}" name="nomor_psp"
                            type="text" class="form-control" id="nomor_psp" placeholder="Nomor PSP" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="tanggal_psp">Tanggal PSP</label>
                    <div class="col-sm-10">
                        <input value="{{ old('tanggal_psp') ?? $data->tanggal_psp }}" name="tanggal_psp" id="tanggal_psp"
                            class="form-control" type="date" id="html5-date-input" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="ket_psp">Keterangan PSP</label>
                    <div class="col-sm-10">
                        <textarea name="ket_psp" class="form-control h-px-100" id="ket_psp"
                            placeholder="Keterangan PSP">

                            {{ old('ket_psp') ?? $data->ket_psp  }}

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
