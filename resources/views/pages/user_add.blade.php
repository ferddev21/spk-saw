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

                         <a href="{{ route('users') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Tambah Akun baru</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('user.create') }}">
                             @csrf
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" class="form-control @error('username') is-invalid @enderror"
                                     id="username" placeholder="Username" value="{{ old('username') }}" name="username">
                                 @error('username')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="password">Password</label>
                                 <input type="text" class="form-control @error('password') is-invalid @enderror"
                                     id="password" placeholder="Password" value="{{ old('password') }}" name="password">
                                 @error('password')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="email">Alamat Email</label>
                                 <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                     placeholder="Alamat Email" value="{{ old('email') }}" name="email">
                                 @error('email')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="name">Nama Lengkap</label>
                                 <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                     placeholder="Nama Lengkap" value="{{ old('name') }}" name="name">
                                 @error('name')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="type">Tipe Pengguna</label>
                                 <select class="form-control @error('type') is-invalid border-danger @enderror" id="type"
                                     name="type">
                                     <option
                                         {{ old('type') == 'member' || isset($_GET['type']) == 'member' ? 'selected' : '' }}
                                         value="member">Members
                                     </option>
                                     <option
                                         {{ old('type') == 'admin' || isset($_GET['type']) == 'admin' ? 'selected' : '' }}
                                         value="admin">
                                         Admin
                                     </option>
                                 </select>
                                 @error('type')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class=" form-check form-check-flat form-check-primary mb-3">
                                 <label class="form-check-label">
                                     <input type="checkbox" class="form-check-input"
                                         {{ old('status') == 'active' ? 'checked' : '' }} value="active" name="status">
                                     Aktif
                                 </label>
                             </div>
                             <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                             <a href="{{ route('users') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
