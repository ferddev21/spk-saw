 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Settings</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('app.settings.update') }}">
                             @csrf
                             <input type="hidden" value="{{ $app['id'] }}" name="id">

                             <div class="form-group">
                                 <label for="appname" class="font-weight-bold">Nama Aplikasi</label>
                                 <input type="text" class="form-control @error('appname') is-invalid @enderror"
                                     name="appname" id="appname" value="{{ $app['name'] }}"
                                     placeholder="{{ $app['name'] }}">
                                 @error('appname')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>

                             <button type="submit" class="btn btn-primary mr-2">Update</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
