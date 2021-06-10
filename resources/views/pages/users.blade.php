 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data akun user</h3>
             </div>
             @include('includes.flash-message')
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">

                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">List akun admin</p>
                         <a href="{{ route('user.add', ['type' => 'admin']) }}"
                             class="btn btn-primary btn-sm float-right mb-2">Tambah
                             Akun Admin</a>
                         <div class="table-responsive width">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Username</th>
                                         <th>Nama Lengkap</th>
                                         <th>Email</th>
                                         <th>Status</th>
                                         <th width="20%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($admin_users as $au)
                                         <tr>
                                             <td>
                                                 <img src="{{ Avatar::create(strtoupper($au['name']))->setFontFamily('Nunito') }}"
                                                     alt="{{ $au['username'] }}" class="img-xs p-1">
                                                 {{ $au['username'] }}
                                             </td>
                                             <td>{{ $au['name'] }}</td>
                                             <td>{{ $au['email'] }}</td>
                                             <td>
                                                 @if ($au['status'] == 'active')
                                                     <span class="badge badge-success">active</span>
                                                 @else
                                                     <span class="badge badge-danger">inactive</span>
                                                 @endif

                                             </td>
                                             <td><a href="{{ route('user.edit', ['id' => Crypt::encrypt($au['id'])]) }}"
                                                     class="btn btn-sm btn-outline-primary mr-1">Edit</a>
                                                 @if ($au['id'] !== auth()->user()->id)
                                                     <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                         data-target="#delete{{ $au['id'] }}">
                                                         Hapus
                                                     </button>
                                                 @endif

                                                 <!-- Modal Delete -->
                                                 <div class="modal fade" id="delete{{ $au['id'] }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                     <div class="modal-dialog " role="document">
                                                         <div class="modal-content border-0">
                                                             <form action="{{ route('user.delete') }}" method="POST">
                                                                 <div class="modal-header bg-danger ">
                                                                     <h5 class="modal-title text-white font-weight-bold"
                                                                         id="deleteLabel">
                                                                         <i class="ti-na menu-icon"></i>
                                                                         Konfirmasi Hapus Akun
                                                                     </h5>
                                                                     <button type="button" class="close"
                                                                         data-dismiss="modal" aria-label="Close">
                                                                         <span aria-hidden="true">&times;</span>
                                                                     </button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <div class=" text-center">
                                                                         <span class=" col font-weight-bold m-2">Anda
                                                                             yakin ingin menghapus akun
                                                                             {{ $au['username'] }}
                                                                             ?</span>
                                                                         <div class="col-auto my-1">
                                                                             <div
                                                                                 class="custom-control custom-checkbox mr-sm-2">
                                                                                 <input type="checkbox"
                                                                                     class="custom-control-input"
                                                                                     id="check{{ $au['id'] }}"
                                                                                     value="1" name="check">
                                                                                 <label class="custom-control-label"
                                                                                     for="check{{ $au['id'] }}"><span
                                                                                         class="font-weight-bold">Hapus
                                                                                         Permanen</span></label>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="modal-footer justify-content-center">
                                                                     <button type="button" class="btn btn-sm btn-white"
                                                                         data-dismiss="modal">Batalkan</button>

                                                                     @csrf
                                                                     <input type="hidden" value="{{ $au['id'] }}"
                                                                         name="id">
                                                                     <input type="hidden" value="{{ $au['username'] }}"
                                                                         name="username">
                                                                     <button type="submit" class="btn btn-sm btn-danger">
                                                                         Yakin, hapus akun
                                                                     </button>

                                                                 </div>
                                                             </form>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-md-12 col-sm-12 grid-margin stretch-card">

                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">List akun member</p>
                         <a href="{{ route('user.add', ['type' => 'member']) }}"
                             class="btn btn-primary btn-sm float-right mb-2">Tambah
                             Akun Member</a>
                         <div class="table-responsive width">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Username</th>
                                         <th>Nama Lengkap</th>
                                         <th>Email</th>
                                         <th>Status</th>
                                         <th width="20%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($member_users as $mu)
                                         <tr>
                                             <td>
                                                 <img src="{{ Avatar::create(strtoupper($mu['name']))->setFontFamily('Nunito') }}"
                                                     alt="{{ $mu['username'] }}" class="img-xs p-1">
                                                 {{ $mu['username'] }}
                                             </td>
                                             <td>{{ $mu['name'] }}</td>
                                             <td>{{ $mu['email'] }}</td>
                                             <td>
                                                 @if ($mu['status'] == 'active')
                                                     <span class="badge badge-success">active</span>
                                                 @else
                                                     <span class="badge badge-warning">inactive</span>
                                                 @endif

                                             </td>
                                             <td><a href="{{ route('user.edit', ['id' => Crypt::encrypt($mu['id'])]) }}"
                                                     class="btn btn-sm btn-outline-primary mr-1">Edit</a>
                                                 @if ($mu['id'] !== auth()->user()->id)
                                                     <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                         data-target="#delete{{ $mu['id'] }}">
                                                         Hapus
                                                     </button>
                                                 @endif

                                                 <!-- Modal Delete -->
                                                 <div class="modal fade" id="delete{{ $mu['id'] }}" tabindex="-1"
                                                     role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                     <div class="modal-dialog " role="document">
                                                         <div class="modal-content border-0">
                                                             <form action="{{ route('user.delete') }}" method="POST">
                                                                 <div class="modal-header bg-danger ">
                                                                     <h5 class="modal-title text-white font-weight-bold"
                                                                         id="deleteLabel">
                                                                         <i class="ti-na menu-icon"></i>
                                                                         Konfirmasi Hapus Akun
                                                                     </h5>
                                                                     <button type="button" class="close"
                                                                         data-dismiss="modal" aria-label="Close">
                                                                         <span aria-hidden="true">&times;</span>
                                                                     </button>
                                                                 </div>
                                                                 <div class="modal-body">
                                                                     <div class=" text-center">
                                                                         <span class=" col font-weight-bold m-2">Anda
                                                                             yakin ingin menghapus akun
                                                                             {{ $mu['username'] }}
                                                                             ?</span>
                                                                         <div class="col-auto my-1">
                                                                             <div
                                                                                 class="custom-control custom-checkbox mr-sm-2">
                                                                                 <input type="checkbox"
                                                                                     class="custom-control-input"
                                                                                     id="check{{ $mu['id'] }}"
                                                                                     value="1" name="check">
                                                                                 <label class="custom-control-label"
                                                                                     for="check{{ $mu['id'] }}"><span
                                                                                         class="font-weight-bold">Hapus
                                                                                         Permanen</span></label>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="modal-footer justify-content-center">
                                                                     <button type="button" class="btn btn-sm btn-white"
                                                                         data-dismiss="modal">Batalkan</button>

                                                                     @csrf
                                                                     <input type="hidden" value="{{ $mu['id'] }}"
                                                                         name="id">
                                                                     <input type="hidden" value="{{ $mu['username'] }}"
                                                                         name="username">
                                                                     <button type="submit" class="btn btn-sm btn-danger">
                                                                         Yakin, hapus akun
                                                                     </button>

                                                                 </div>
                                                             </form>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 @endsection
