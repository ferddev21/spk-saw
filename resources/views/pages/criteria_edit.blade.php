 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Kriteria {{ $criteria['criteria'] }}</h3>
             </div>
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('criterias') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         @include('includes.flash-message')

                         <div class="row">
                             <div class="col-sm-12 col-md-6 col-lg-6 border-right-md">
                                 {{-- edit kriteria --}}
                                 <h4 class="card-title mt-3">Edit Kriteria {{ $criteria['criteria'] }}</h4>
                                 <form class="forms-sample" method="POST" action="{{ route('criteria.update') }}">
                                     @csrf
                                     <input type="hidden" name="id" value="{{ $criteria['id'] }}">
                                     <div class="form-group">
                                         <label for="username">Nama kriteria</label>
                                         <input type="text" class="form-control @error('criteria') is-invalid @enderror"
                                             id="criteria" placeholder="Nama kriteria" value="{{ $criteria['criteria'] }}"
                                             name="criteria">
                                         @error('criteria')
                                             <div class="invalid-feedback">
                                                 {{ $message }}
                                             </div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="type">Tipe kriteria</label>
                                         <select class="form-control @error('type') is-invalid border-danger @enderror"
                                             id="type" name="type">
                                             <option {{ $criteria['type'] == 'cost' ? 'selected' : '' }} value="cost">
                                                 Cost
                                             </option>
                                             <option {{ $criteria['type'] == 'benefit' ? 'selected' : '' }}
                                                 value="benefit">
                                                 Benefit
                                             </option>
                                         </select>
                                         @error('type')
                                             <div class="invalid-feedback">
                                                 {{ $message }}
                                             </div>
                                         @enderror
                                     </div>
                                     <div class="form-group">
                                         <label for="username">Bobot kriteria</label>
                                         <input type="text" class="form-control @error('bobot') is-invalid @enderror"
                                             id="bobot" placeholder="Bobot kriteria" value="{{ $criteria['bobot'] }}"
                                             name="bobot">
                                         @error('bobot')
                                             <div class="invalid-feedback">
                                                 {{ $message }}
                                             </div>
                                         @enderror
                                     </div>
                                     <button type="submit" class="btn btn-sm btn-primary mr-2">Update</button>
                                     <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                         data-target="#delete{{ $criteria['id'] }}">
                                         Hapus
                                     </button>
                                 </form>

                                 <!-- Modal Delete -->
                                 <div class="modal fade" id="delete{{ $criteria['id'] }}" tabindex="-1" role="dialog"
                                     aria-labelledby="deleteLabel" aria-hidden="true">
                                     <div class="modal-dialog stretch-card  grid-margin" role="document">
                                         <div class="modal-content border-0  ">
                                             <form action="{{ route('criteria.delete') }}" method="POST">
                                                 <div class="modal-header bg-danger ">
                                                     <h5 class="modal-title text-white font-weight-bold" id="deleteLabel">
                                                         <i class="ti-na menu-icon"></i>
                                                         Konfirmasi Hapus Kriteria
                                                     </h5>
                                                     <button type="button" class="close" data-dismiss="modal"
                                                         aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body ">
                                                     <div class=" text-center ">
                                                         <span class="font-weight-bold">Anda
                                                             yakin ingin menghapus Kriteria
                                                             {{ $criteria['criteria'] }}
                                                             ?</span>
                                                         <div class="col-auto my-1">
                                                             <div class="custom-control custom-checkbox mr-sm-2">
                                                                 <input type="hidden" name="check" value="1">
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="modal-footer justify-content-center">
                                                     <button type="button" class="btn btn-sm btn-white"
                                                         data-dismiss="modal">Batalkan</button>

                                                     @csrf
                                                     <input type="hidden" value="{{ $criteria['id'] }}" name="id">
                                                     <input type="hidden" value="{{ $criteria['criteria'] }}"
                                                         name="criteria">
                                                     <button type="submit" class="btn btn-sm btn-danger">
                                                         Yakin, hapus kriteria
                                                     </button>

                                                 </div>
                                             </form>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <div class="col-sm-12 col-md-6 col-lg-6">
                                 {{-- edit variabel kriteria --}}

                                 <h4 class="card-title mt-3">Edit Variabel Kriteria {{ $criteria['criteria'] }}</h4>


                                 <div class="table-responsive width">
                                     <table class="table">
                                         <thead>
                                             <tr>
                                                 <th>Variabel</th>
                                                 <th>Nilai</th>
                                                 <th width="30%">Aksi</th>
                                             </tr>
                                         </thead>
                                         <tbody>
                                             @foreach ($variabel as $v)
                                                 <tr>
                                                     <td>{{ $v['variabel'] }} </td>
                                                     <td>{{ $v['value'] }}</td>

                                                     <td><a href="{{ route('criteria.variable.edit', ['id_variabel' => Crypt::encrypt($v['id'])]) }}"
                                                             class="btn btn-sm btn-outline-primary mr-1">Edit</a>
                                                         <button type="button" class="btn btn-sm btn-danger"
                                                             data-toggle="modal" data-target="#delete{{ $v['id'] }}">
                                                             Hapus
                                                         </button>
                                                         <!-- Modal Delete -->
                                                         <div class="modal fade" id="delete{{ $v['id'] }}"
                                                             tabindex="-1" role="dialog" aria-labelledby="deleteLabel"
                                                             aria-hidden="true">
                                                             <div class="modal-dialog stretch-card  grid-margin"
                                                                 role="document">
                                                                 <div class="modal-content border-0  ">
                                                                     <form
                                                                         action="{{ route('criteria.variable.delete') }}"
                                                                         method="POST">
                                                                         <div class="modal-header bg-danger ">
                                                                             <h5 class="modal-title text-white font-weight-bold"
                                                                                 id="deleteLabel">
                                                                                 <i class="ti-na menu-icon"></i>
                                                                                 Konfirmasi Hapus Variabel
                                                                             </h5>
                                                                             <button type="button" class="close"
                                                                                 data-dismiss="modal" aria-label="Close">
                                                                                 <span aria-hidden="true">&times;</span>
                                                                             </button>
                                                                         </div>
                                                                         <div class="modal-body ">
                                                                             <div class=" text-center ">
                                                                                 <span class="font-weight-bold">Anda
                                                                                     yakin ingin menghapus variabel
                                                                                     {{ $v['variabel'] }}
                                                                                     ?</span>
                                                                                 <div class="col-auto my-1">
                                                                                     <input type="hidden" name="check"
                                                                                         value="1">
                                                                                 </div>
                                                                             </div>
                                                                         </div>
                                                                         <div class="modal-footer justify-content-center">
                                                                             <button type="button"
                                                                                 class="btn btn-sm btn-white"
                                                                                 data-dismiss="modal">Batalkan</button>

                                                                             @csrf
                                                                             <input type="hidden"
                                                                                 value="{{ $v['id'] }}" name="id">
                                                                             <input type="hidden"
                                                                                 value="{{ $criteria['id'] }}"
                                                                                 name="criteria_id">
                                                                             <input type="hidden"
                                                                                 value="{{ $v['criteria'] }}"
                                                                                 name="criteria">
                                                                             <button type="submit"
                                                                                 class="btn btn-sm btn-danger">
                                                                                 Yakin, hapus variabel
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
                                 <div class="mx-auto">
                                     <a href="{{ route('criteria.variable.add', ['id_criteria' => encrypt($criteria['id'])]) }}"
                                         class="btn btn-primary btn-sm d-flex justify-content-center mb-2">Tambah
                                         Variabel kriteria</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </div>
 @endsection
