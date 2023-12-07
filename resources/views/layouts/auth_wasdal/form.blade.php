<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-4">
        <!-- Login -->
        <div class="card p-2">
          <!-- Logo -->
          <div class="app-brand justify-content-center mt-2">
            <a href="index.html" class="app-brand-link gap-2">
              <span class="app-brand-logo demo">
                <span style="color: #666cff">
                 <img src="{{asset('assets/img/logo_kemenkeu.png')}}" alt="" width="80">
                </span>
              </span>
              {{-- <span class="app-brand-text demo text-heading fw-bold">WASKEU</span> --}}
            </a>
          </div>
          <!-- /Logo -->

          <div class="card-body">
            <div class="text-center">
                <h4 class="mb-2">Welcome to Waskeu!</h4>
                {{-- <p class="mb-4">Silahkan masukkan username dan password</p> --}}
            </div>


            <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-floating form-floating-outline mb-3">
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="username"
                  placeholder="Masukkan Username"
                  autofocus />
                <label for="username">Username</label>
              </div>
              <div class="mb-3">
                <div class="form-password-toggle">
                  <div class="input-group input-group-merge">
                    <div class="form-floating form-floating-outline">
                      <input
                        type="password"
                        id="password"
                        class="form-control"
                        name="password"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                        aria-describedby="password" />
                      <label for="password">Password</label>
                    </div>
                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                  <div class="form-floating form-floating-outline">
                    <select
                      value="{{ old('tahun_wasdal') }}"
                      name="tahun_wasdal"
                      id="TahunWasdal"
                      class="select2 form-select form-select-lg"
                      data-allow-clear="true" @error('tahun_wasdal') is-invalid @enderror required>
                      <option selected disabled>Pilih Tahun</option>
                      <option value="2023">2023</option>
                    </select>
                    <label for="TahunWasdal">Tahun</label>
                  </div>
              </div>
              <div class="mb-3">
                  <div class="form-floating form-floating-outline">
                    <select
                    value="{{ old('periode_wasdal') }}"
                       name="periode_wasdal"
                      id="select2Basic"
                      class="select2 form-select form-select-lg"
                      data-allow-clear="true" @error('periode_wasdal') is-invalid @enderror required>
                      <option selected disabled>Pilih Periode</option>
                      <option value="SEMESTER_1">Semester I</option>
                      <option value="SEMESTER_2">Semester II</option>
                      <option value="TAHUNAN">Tahunan</option>
                    </select>
                    <label for="select2Basic">Periode</label>
                  </div>
              </div>
              <div class="mb-3">
                  <div class="form-floating form-floating-outline">
                    <select
                    value="{{ old('jenis_pemantauan_wasdal') }}"
                    name="jenis_pemantauan_wasdal"
                      id="jenisPemantauan"
                      class="select2 form-select form-select-lg"
                      data-allow-clear="true">
                      <option selected disabled>Pilih Jenis Pemantauan</option>
                      <option value="PERIODIK">Periodik</option>
                      <option value="INSIDENTIL">Insidentil</option>
                    </select>
                    <label for="jenisPemantauan">Jenis Pemantauan</label>
                  </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /Login -->
        <img
          alt="mask"
          src="{{asset('assets/img/illustrations/auth-basic-login-mask-light.png')}}"
          class="authentication-image d-none d-lg-block" />
      </div>
    </div>
  </div>
