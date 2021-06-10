 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Seleksi</h3>
             </div>
             @include('includes.flash-message')
             {{-- Nilai Alternatif --}}
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">
                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">Nilai Alternatif</p>
                         <a href="{{ route('selection.add') }}" class="btn btn-primary btn-sm float-right mb-2">Tambah
                             Seleksi</a>
                         <div class="table-responsive width">
                             <table class="table text-capitalize">
                                 <thead>
                                     <tr>
                                         <th>{{ getApp()->name }}</th>
                                         @foreach ($criterias->all() as $cr)
                                             <th>{{ $cr['criteria'] }}</th>
                                         @endforeach
                                         <th width="10%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($selections as $sel)

                                         <tr>
                                             <td>{{ $sel->alternative }}</td>
                                             @foreach ($criterias->all() as $cr)
                                                 @php
                                                     $criteriaVar = $alternativeCriteria->getCriteriaVarBySelection($sel->alternative_id, $cr->id);
                                                     $result = $criteriaVariabel->getVariabel(['id' => $criteriaVar]);
                                                 @endphp
                                                 <td>{{ $result !== null ? $result : '-' }}</td>
                                             @endforeach
                                             <td>
                                                 <a href="{{ route('selection.edit', ['id_alternative' => encrypt($sel->alternative_id)]) }}"
                                                     class="btn btn-sm btn-primary">Edit</a>
                                             </td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

             {{-- Nilai Konversi --}}
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">
                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">Nilai Konversi / Matrik Keputusan</p>
                         <div class="table-responsive width">
                             <table class="table text-capitalize">
                                 <thead>
                                     <tr>
                                         <th>{{ getApp()->name }}</th>
                                         @foreach ($criterias->all() as $cr)
                                             <th>{{ $cr['criteria'] }}</th>
                                         @endforeach
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($selections as $sel)

                                         <tr>
                                             <td>{{ $sel->alternative }}</td>
                                             @foreach ($criterias->all() as $cr)
                                                 @php
                                                     $criteriaVar = $alternativeCriteria->getCriteriaVarBySelection($sel->alternative_id, $cr->id);
                                                     $result = $criteriaVariabel->getValueVariabel(['id' => $criteriaVar]);
                                                 @endphp
                                                 <td>{{ $result !== null ? $result : 0 }}</td>
                                             @endforeach
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

             {{-- Nilai Normalisasi --}}
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">
                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">Normalisasi</p>
                         <div class="table-responsive width">
                             <table class="table text-capitalize">
                                 <thead>
                                     <tr>
                                         <th>{{ getApp()->name }}</th>
                                         @foreach ($criterias->all() as $cr)
                                             <th>{{ $cr['criteria'] }}</th>
                                         @endforeach
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($selections as $sel)

                                         <tr>
                                             <td>{{ $sel->alternative }}</td>
                                             @foreach ($criterias->all() as $cr)
                                                 @php
                                                     $criteriaVar = $alternativeCriteria->getCriteriaVarBySelection($sel->alternative_id, $cr->id);
                                                     $valueVar = $criteriaVariabel->getValueVariabel(['id' => $criteriaVar]);
                                                     $result = $alternativeCriteria->getNormaliasasiVariabel($valueVar, $cr->id, $cr->type);
                                                     $totalVal[$cr->id] = $result * $cr->bobot;
                                                 @endphp
                                                 <td>{{ $result !== null ? $result : '-' }}</td>
                                             @endforeach

                                             @php
                                                 
                                                 $scor[$sel->id] = array_sum($totalVal);
                                                 
                                             @endphp
                                         </tr>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

             {{-- Rangking --}}
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">
                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">Ranking</p>
                         <div class="table-responsive width">
                             <table class="table text-capitalize">
                                 <thead>
                                     <tr>
                                         <th>{{ getApp()->name }} </th>
                                         <th>Score</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @php
                                         foreach ($selections as $sel) {
                                             $rangking[] = [
                                                 'alternative' => $sel->alternative,
                                                 'skor' => $scor[$sel->id],
                                             ];
                                         }
                                         if (!empty($rangking)) {
                                             $alternative = array_column($rangking, 'alternative');
                                             $skor = array_column($rangking, 'skor');
                                             array_multisort($skor, SORT_DESC, $rangking);
                                         } else {
                                             $rangking = [];
                                         }
                                     @endphp

                                     @foreach ($rangking as $rang)
                                         <tr>
                                             <td>{{ $rang['alternative'] }}</td>
                                             <td>{{ $rang['skor'] }}</td>
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
