    @extends('layouts.auth')
    @section('content')
        <div class="auth-form-light text-left py-5 px-4 px-sm-5 center">
            <div class="brand-logo">
                {{-- <img src="{{ asset('assets/images/logo.svg') }}" alt="logo"> --}}
            </div>
            <h4 class="text-uppercase">APLIKASI PENUNJANG KEPUTUSAN PEMILIHAN {{ getApp()->name }} DENGAN METODE SAW</h4>
            <h6 class="font-weight-light">Masukan username dan password akun anda. </h6>

            <form class="pt-3" method="POST" action="{{ url('login') }}">
                @csrf
                @include('includes.flash-message')
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username"
                        name="username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1"
                        placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                        href="{{ asset('assets/index.html') }}">Masuk</button>
                </div>
                {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    <a href="#" class="auth-link text-black">Lupa password?</a>
                                </div> --}}
            </form>
        </div>
    @endsection
