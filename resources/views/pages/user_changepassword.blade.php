 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data akun user</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <h4 class="card-title mt-3">Ubah Password</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('profile.update.password') }}">
                             @csrf
                             <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                             <div class="form-group">
                                 <label for="current_password">Password lama</label>
                                 <input type="text" class="form-control @error('current_password') is-invalid @enderror"
                                     id="current_password" placeholder="Password lama"
                                     value="{{ old('current_password') }}" name="current_password">
                                 @error('current_password')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="new_password">Password baru</label>
                                 <input type="text" class="form-control @error('new_password') is-invalid @enderror"
                                     id="new_password" placeholder="Password baru" value="{{ old('new_password') }}"
                                     name="new_password">
                                 @error('new_password')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="confirm_password">Ulangi password baru</label>
                                 <input type="confirm_password"
                                     class="form-control @error('confirm_password') is-invalid @enderror"
                                     id="confirm_password" placeholder="Konfirmasi password"
                                     value="{{ old('confirm_password') }}" name="confirm_password">
                                 @error('confirm_password')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <button type="submit" class="btn btn-primary mr-2">Ganti Password</button>

                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
