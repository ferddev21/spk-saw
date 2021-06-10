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
                         @if ($from == 'profile')
                             <h4 class="card-title mt-3">Update Profile {{ $user['name'] }}</h4>
                         @else
                             <a href="{{ route('users') }}" class="text-primary font-weight-bold">
                                 « Back
                             </a>
                             <hr>
                             <h4 class="card-title mt-3">Edit Akun {{ $user['name'] }}</h4>
                         @endif
                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('user.update') }}">
                             @csrf
                             <input type="hidden" value="{{ $user['id'] }}" name="id">
                             <div class="form-group">
                                 <label for="username">Username</label>
                                 <input type="text" class="form-control" id="username"
                                     placeholder="{{ $user['username'] }}" value="{{ $user['username'] }}"
                                     name="username">
                             </div>
                             <div class="form-group">
                                 <label for="email">Alamat Email</label>
                                 <input type="email" class="form-control" id="email" placeholder="{{ $user['email'] }}"
                                     value="{{ $user['email'] }}" name="email">
                             </div>
                             <div class="form-group">
                                 <label for="name">Nama Lengkap</label>
                                 <input type="text" class="form-control" id="name" placeholder="{{ $user['name'] }}"
                                     value="{{ $user['name'] }}" name="name">
                             </div>
                             @if ($from !== 'profile' and auth()->user()->id !== $user['id'])
                                 <div class="form-group">
                                     <label for="level">Tipe Pengguna</label>

                                     <select class="form-control" id="level" name="level">
                                         <option {{ $user['level'] == 'admin' ? 'selected' : '' }} value="admin">
                                             Admin
                                         </option>
                                         <option {{ $user['level'] == 'member' ? 'selected' : '' }} value="member">
                                             Member
                                         </option>
                                     </select>

                                 </div>

                                 <div class=" form-check form-check-flat form-check-primary mb-3">
                                     <label class="form-check-label">
                                         <input type="checkbox" class="form-check-input"
                                             {{ $user['status'] == 'active' ? 'checked' : '' }} value="active"
                                             name="status">
                                         Aktif
                                     </label>
                                 </div>
                             @else
                                 <input type="hidden" name="status" value="{{ $user['status'] }}">
                                 <input type="hidden" name="level" value="{{ $user['level'] }}">
                             @endif
                             <button type="submit" class="btn btn-primary mr-2">Update</button>
                             @if ($from !== 'profile')
                                 <a href="{{ route('users') }}" class="btn btn-light">Batal</a>
                             @endif
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
