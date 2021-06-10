  @extends('layouts.auth')
  @section('content')

      <h4>Registasi akun</h4>
      <h6 class="font-weight-light">Dengan mendaftar anda setuju dengan
          <a href="{{ route('terms') }}" class="text-primary text-decoration-none">syarat & ketentuan. </a>
      </h6>
      <form class="pt-3" method="POST" action="{{ route('register.process') }}">
          @csrf
          <div class="form-group">
              <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="name"
                  placeholder="Nama Lengkap" value="{{ old('name') }}" name="name">
              @error('name')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-group">
              <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                  placeholder="Alamat Email" value="{{ old('email') }}" name="email">
              @error('email')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-group">
              <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" id="username"
                  placeholder="Username" value="{{ old('username') }}" name="username">
              @error('username')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          <div class="form-group">
              <input type="text" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password"
                  placeholder="Password" value="{{ old('password') }}" name="password">
              @error('password')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="mt-3">
              <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                  Daftar
              </button>
          </div>
          <div class=" text-center mt-4 font-weight-light">
              Sudah punya akun? <a href="{{ route('login') }}" class="text-primary">Masuk</a>
          </div>
      </form>

  @endsection
