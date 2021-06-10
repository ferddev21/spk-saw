 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">
         <div class="row">
             <div class="col-md-12 grid-margin">
                 <div class="row">
                     <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                         <h3 class="font-weight-bold">Selamat datang {{ auth()->user()->name }} <span
                                 class="waving-hand">👋</span></h3>
                         <h5 class="font-weight-normal mb-0">Sistem Penunjang Keputusan pemilihan {{ getApp()->name }}
                             menggunakan
                             metode SAW.
                         </h5>
                     </div>
                     <div class="col-12 col-xl-4">
                         <div class="justify-content-end d-flex">
                             <div class="flex-md-grow-1 flex-xl-grow-0">
                                 <div class="btn btn-sm btn-light bg-white font-weight-bold">
                                     {{ now()->format(' D, d M Y ') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             {{-- Nilai Normalisasi --}}
             <div class="col-md-12 col-sm-12 grid-margin stretch-card " style="display:none;">
                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">Normalisasi</p>
                         <div class="table-responsive width">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Nama Mobil</th>
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
                                                     $totalVal[$cr->id] = $cr->bobot * $result;
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
                         <p class="card-title float-left">Top Alternative {{ getApp()->name }}</p>
                         <div class="table-responsive width">
                             <table class="table">
                                 <thead>
                                     <tr>
                                         <th>Nama</th>
                                         <th>Skor</th>
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
