 @extends('layouts.app')
 @section('content')
     <div class="content-wrapper">

         <div class="row">
             <div class=" col-md-12 mb-2">
                 <h3 class="font-weight-bold">Data Kriteria</h3>
             </div>
             @include('includes.flash-message')
             <div class="col-md-12 col-sm-12 grid-margin stretch-card">

                 <div class="card position-relative">
                     <div class="card-body">
                         <p class="card-title float-left">List Kriteria</p>
                         <a href="{{ route('criteria.add') }}" class="btn btn-primary btn-sm float-right mb-2">
                             Tambah Kriteria
                         </a>
                         <div class="table-responsive width">
                             <table class="table text-left">
                                 <thead>
                                     <tr>
                                         <th>Kriteria</th>
                                         <th>Tipe Kriteria</th>
                                         <th>Bobot</th>
                                         <th>Variabel</th>
                                         <th width="20%">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($criterias as $cr)
                                         <tr>
                                             <td>{{ $cr['criteria'] }}</td>
                                             <td>{{ $cr['type'] }}</td>
                                             <td>{{ $cr['bobot'] }}</td>
                                             <td>
                                                 @php
                                                     $variabel = $criteriaVariabelModel->where(['criteria_id' => $cr['id']])->get();
                                                     echo count($variabel) !== 0 ? count($variabel) : '-';
                                                 @endphp
                                             </td>
                                             <td>
                                                 <a href="{{ route('criteria.edit', ['id_criteria' => encrypt($cr['id'])]) }}"
                                                     class="btn btn-sm btn-outline-primary mr-1">Detail</a>
                                             </td>
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
