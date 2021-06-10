 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Kriteria</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('criterias') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Tambah Kriteria baru</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('criteria.create') }}">
                             @csrf
                             <div class="form-group">
                                 <label for="username">Nama kriteria</label>
                                 <input type="text" class="form-control @error('criteria') is-invalid @enderror"
                                     id="criteria" placeholder="Nama kriteria" value="{{ old('criteria') }}"
                                     name="criteria">
                                 @error('criteria')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="type">Tipe kriteria</label>
                                 <select class="form-control @error('type') is-invalid border-danger @enderror" id="type"
                                     name="type">
                                     <option {{ old('type') == 'cost' ? 'selected' : '' }} value="cost">
                                         Cost
                                     </option>
                                     <option {{ old('type') == 'benefit' ? 'selected' : '' }} value="benefit">
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
                                 <input type="text" class="form-control @error('bobot') is-invalid @enderror" id="bobot"
                                     placeholder="Bobot kriteria" value="{{ old('bobot') }}" name="bobot">
                                 @error('bobot')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                             <a href="{{ route('criterias') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
