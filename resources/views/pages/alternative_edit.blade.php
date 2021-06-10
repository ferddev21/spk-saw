 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data alternative</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('alternatives') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Edit alternative {{ $alternative['alternative'] }} </h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('alternative.update') }}">
                             @csrf
                             <input type="hidden" value="{{ $alternative['id'] }}" name="id">
                             <div class="form-group">
                                 <label for="username">Nama alternative</label>
                                 <input type="text" class="form-control @error('alternative') is-invalid @enderror"
                                     id="alternative" placeholder="Nama alternative"
                                     value="{{ $alternative['alternative'] }}" name="alternative">
                                 @error('alternative')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-primary mr-2">Update</button>
                             <a href="{{ route('alternatives') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
