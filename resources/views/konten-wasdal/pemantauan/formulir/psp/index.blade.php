@extends('layouts.wasdal.master')
@section('css')
@endsection
@section('script')
@endsection


@section('content')
 <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Formulir PSP</h5>
                      <small class="text-muted float-end">Default label</small>
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="status_psp">Status PSP</label>
                          <div class="col-sm-10">
                        <select name="status_psp" class="form-select" id="status_psp" aria-label="Status PSP">
                          <option selected>Open this select menu</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
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
