@extends('layouts.wasdal.master')
@section('css')

 <!-- Vendors CSS -->
 <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
 <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />

 <!-- Page CSS -->
 <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-profile.css')}}" />
@endsection
@section('script')
@endsection


@section('content')
<!-- Connection Cards -->
<div class="row g-4">
    <div class="divider">
        <div class="divider-text"><h2>TEAM DEVELOPMENT</h2></div>
      </div>
    {{-- PAK IIE --}}
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="mx-auto mb-4">
              <img src="{{asset('assets/img/avatars/1.png')}}" alt="Avatar Image" class="rounded-circle w-px-100" />
            </div>
            <h5 class="mb-1 card-title">Nuzfari Alkiron</h5>
            <span>Project Leader</span>
          </div>
        </div>
      </div>
    {{-- AUL --}}
    <div class="col-xl-4 col-lg-6 col-md-6">
      <div class="card">
        <div class="card-body text-center">
          <div class="mx-auto mb-4">
            <img src="{{asset('assets/img/avatars/5.png')}}" alt="Avatar Image" class="rounded-circle w-px-100" />
          </div>
          <h5 class="mb-1 card-title">Auliya Putra Azhari</h5>
          <span>Full Stack Developer | Hacker | System Analyst</span>
        </div>
      </div>
    </div>
    {{-- EKO --}}
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="mx-auto mb-4">
              <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar Image" class="rounded-circle w-px-100" />
            </div>
            <h5 class="mb-1 card-title">Eko Prayitno</h5>
            <span>Database Engineer</span>
          </div>
        </div>
      </div>
       {{-- IRFAN --}}
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="mx-auto mb-4">
              <img src="{{asset('assets/img/avatars/3.png')}}" alt="Avatar Image" class="rounded-circle w-px-100" />
            </div>
            <h5 class="mb-1 card-title">Irpan Heryana</h5>
            <span>System Analyst</span>
          </div>
        </div>
    </div>
     {{-- WINNY --}}
     <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="mx-auto mb-4">
              <img src="{{asset('assets/img/avatars/10.png')}}" alt="Avatar Image" class="rounded-circle w-px-100" />
            </div>
            <h5 class="mb-1 card-title">Winny Irmarooke</h5>
            <span>UI/UX</span>
          </div>
        </div>
      </div>
</div>
  <!--/ Connection Cards -->
@endsection
