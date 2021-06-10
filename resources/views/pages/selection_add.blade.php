 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Seleksi</h3>
             </div>
             <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                 <div class="card">
                     <div class="card-body">

                         <a href="{{ route('selections') }}" class="text-primary font-weight-bold">
                             « Back
                         </a>
                         <hr>
                         <h4 class="card-title mt-3">Tambah penilaian</h4>

                         @include('includes.flash-message')

                         <form class="forms-sample text-capitalize" method="POST"
                             action="{{ route('selection.create') }}">
                             @csrf
                             <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                             <div class="form-group">
                                 <label for="alternative_id">{{ getApp()->name }}</label>
                                 <select class="form-control @error('alternative_id') is-invalid border-danger @enderror"
                                     id="alternative_id" name="alternative_id">
                                     @foreach ($alternatives as $prov)
                                         <option {{ old('alternative_id') == $prov['id'] ? 'selected' : '' }}
                                             value="{{ $prov['id'] }}">{{ $prov['alternative'] }}
                                         </option>
                                     @endforeach
                                 </select>
                                 @error('alternative_id')
                                     <div class="invalid-feedback">
                                         {{ $message }}
                                     </div>
                                 @enderror
                             </div>
                             @foreach ($criterias as $cr)
                                 @php
                                     
                                     $criteriaVariabels = $criteriaVariabelsModel->where(['criteria_id' => $cr['id']])->get();
                                     $cr_id = $cr['id'];
                                 @endphp
                                 <div class="form-group">
                                     <label for="id_criteriaVar[{{ $cr_id }}]"> {{ $cr['criteria'] }} </label>
                                     <select
                                         class='form-control @error("id_criteriaVar[$cr_id]") is-invalid border-danger @enderror'
                                         id="id_criteriaVar[{{ $cr_id }}]"
                                         name="id_criteriaVar[{{ $cr_id }}]">
                                         @foreach ($criteriaVariabels as $cv)
                                             <option {{ old("id_criteriaVar[$cr_id]") == $cv['id'] ? 'selected' : '' }}
                                                 value="{{ $cv['id'] }}">
                                                 {{ $cv['variabel'] }}
                                             </option>
                                         @endforeach
                                     </select>
                                     @error("id_criteriaVar[$cr_id]")
                                         <div class="invalid-feedback"> {{ $message }}</div>
                                     @enderror
                                 </div>
                             @endforeach

                             <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                             <a href="{{ route('selections') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endsection
