 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold text-capitalize">Data {{ getApp()->name }}</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('alternatives') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Tambah {{ getApp()->name }} baru</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('alternative.create') }}">
                             @csrf
                             <div class="form-group">
                                 {{-- <label for="username">Nama Alternative</label> --}}
                                 <input type="text" class="form-control @error('alternative') is-invalid @enderror"
                                     id="alternative" placeholder="" value="{{ old('alternative') }}" name="alternative">
                                 @error('alternative')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                             <a href="{{ route('alternatives') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
