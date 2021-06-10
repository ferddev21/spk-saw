    @extends('layouts.auth')
    @section('content')
        <div class="auth-form-light text-left py-5 px-4 px-sm-5 center">
            <div class="brand-logo">
                {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="logo"> --}}
            </div>
            <h3>INSTALASI APLIKASI</h3>


            <form class="pt-3" method="POST" action="{{ route('installing') }}">
                @csrf
                @include('includes.flash-message')
                <div class="form-group">
                    <label for="app_name" class="font-weight-bold">Nama Aplikasi</label>
                    <input type="text" class="form-control @error('app_name') is-invalid @enderror" name="app_name"
                        id="app_name" value="{{ old('app_name') }}">
                    @error('app_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="name" class="font-weight-bold">Nama Lengkap Admin</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name') }}" name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username" class="font-weight-bold">Username Admin</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        value="{{ old('username') }}" name="username">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="font-weight-bold">Password Admin</label>
                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="password"
                        value="{{ old('password') }}" name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="font-weight-bold">Email Admin</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{ old('email') }}" name="email">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                        href="{{ asset('assets/index.html') }}">Install</button>
                </div>
            </form>
        </div>
    @endsection
