 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Kriteria {{ $criteria['criteria'] }}</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('criteria.edit', ['id_criteria' => encrypt($criteria['id'])]) }}"
                             class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Edit Variabel {{ $variabel['variabel'] }}</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('criteria.variable.update') }}">
                             @csrf
                             <input type="hidden" value="{{ $variabel['id'] }}" name="id">
                             <div class="form-group">
                                 <label for="variabel">Nama variabel kriteria</label>
                                 <input type="text" class="form-control @error('variabel') is-invalid @enderror"
                                     id="variabel" placeholder="Nama variabel" value="{{ $variabel['variabel'] }}"
                                     name="variabel">
                                 @error('variabel')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <div class="form-group">
                                 <label for="username">Nilai variabel kriteria</label>
                                 <input type="text" class="form-control @error('value') is-invalid @enderror" id="value"
                                     placeholder="Nilai variabel" value="{{ $variabel['value'] }}" name="value">
                                 @error('value')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-primary mr-2">Update</button>
                             <a href="{{ route('criteria.edit', ['id_criteria' => encrypt($criteria['id'])]) }}"
                                 class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
