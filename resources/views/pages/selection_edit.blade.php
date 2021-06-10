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
                         <h4 class="card-title mt-3">Edit penilaian
                             <a href="{{ route('alternative.edit', ['id_alternative' => Crypt::encrypt($alternative_selection['id'])]) }}"
                                 class="text-decoration-none text-primary">
                                 {{ $alternative_selection['alternative'] }}
                             </a>
                         </h4>

                         @include('includes.flash-message')

                         <form class="forms-sample" method="POST" action="{{ route('selection.update') }}">
                             @csrf
                             <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">
                             <input type="hidden" name="id_alternative" value="{{ $alternative_selection['id'] }}">
                             @foreach ($criterias as $cr)
                                 @php
                                     $criteriaVariabels = $criteriaVariabelsModel->where(['criteria_id' => $cr['id']])->get();
                                     $cr_id = $cr['id'];
                                 @endphp
                                 <div class="form-group">
                                     <label for="id_criteriaVar[{{ $cr_id }}]"> {{ $cr['criteria'] }} </label>
                                     <select
                                         class='form-control @error("id_criteriaVar[$cr_id]") is-invalid border-danger @enderror'
                                         id="id_criteriaVar[{{ $cr_id }}]" name="id_criteriaVar[{{ $cr_id }}]"
                                         {{ count($criteriaVariabels) <= 0 ? 'disabled' : '' }}>
                                         @foreach ($criteriaVariabels as $cv)
                                             <option
                                                 {{ $alternativeCriteria->checkCriteriaVarBySelection($alternative_selection['id'], $cv['id']) ? 'selected' : '' }}
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

                             <button type="submit" class="btn btn-primary mr-2">Edit</button>
                             <a href="{{ route('selections') }}" class="btn btn-light">Batal</a>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endsection
