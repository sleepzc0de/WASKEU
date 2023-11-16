@extends('layouts.wasdal.master')
@section('css')
@endsection
@section('script')
@endsection


@section('content')
<!-- User List Style -->
<div class="card">
    <h5 class="card-header">Wasdal Pemantauan Periodik Pemanfaatan</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-lg-12 mb-4 mb-xl-0 center">
                {{-- <small class="text-light fw-medium">Wasdal Pemantauan Periodik Pemanfaatan</small> --}}
                <div class="demo-inline-spacing mt-3">
                    <div class="list-group">
                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">PSP</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="text-muted ms-1">13 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <a href="{{route('form-psp.index')}}"><button class="btn btn-primary btn-sm">Wasdal</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">Kesesuaian PSP</h6>
                                        <div class="d-flex align-items-center">
                                           <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">11 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">BMN Tidak Digunakan</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">9 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">Tingkat Kesesuaian SBSK</h6>
                                        <div class="d-flex align-items-center">
                                           <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">15 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">Penggunaan Sementara</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">15 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">Penggunaan Dioperasikan Oleh Pihak Lain</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">15 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">TL Hasil Temuan Penggunaan BMN oleh APIP</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-success mdi mdi mdi-check-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">15 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                            <img src="{{asset('assets/img/avatars/form_input.jpg')}}" alt="User Image"
                                class="rounded-circle me-3 w-px-50" />
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="user-info">
                                        <h6 class="mb-1">TL Hasil Temuan Penggunaan BMN oleh BPK</h6>
                                        <div class="d-flex align-items-center">
                                            <div class="user-status me-2 d-flex align-items-center">
                                                <small>Status Form</small>
                                                <span class="ms-2 text-danger mdi mdi mdi-alert-decagram"></span>
                                            </div>
                                            {{-- <small class="ms-1 text-muted">15 minutes</small> --}}
                                        </div>
                                    </div>
                                    <div class="add-btn">
                                        <button class="btn btn-primary btn-sm">Wasdal</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ User List Style -->
@endsection
