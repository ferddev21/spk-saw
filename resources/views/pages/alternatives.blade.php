@extends('layouts.app')
@section('content')
    <div class="content-wrapper">

        <div class="row">
            <div class=" col-md-12 mb-2">
                <h3 class="font-weight-bold text-capitalize">Data {{ getApp()->name }}</h3>
            </div>

            <div class="col-md-6 col-sm-12 grid-margin stretch-card">

                <div class="card position-relative">
                    <div class="card-body">
                        @include('includes.flash-message')
                        <p class="card-title float-left text-capitalize">List {{ getApp()->name }}</p>
                        <a href="{{ route('alternative.add') }}" class="btn btn-primary btn-sm float-right mb-2">
                            Tambah
                        </a>

                        <div class="table-responsive width">
                            <table class="table text-capitalize">
                                <thead>
                                    <tr>
                                        <th>{{ getApp()->name }}</th>
                                        <th width="30%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alternatives as $prov)
                                        <tr>
                                            <td>{{ $prov['alternative'] }}</td>
                                            <td><a href="{{ route('alternative.edit', ['id_alternative' => Crypt::encrypt($prov['id'])]) }}"
                                                    class="btn btn-sm btn-outline-primary mr-1">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#delete{{ $prov['id'] }}">
                                                    Hapus
                                                </button>

                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="delete{{ $prov['id'] }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content border-0">
                                                            <form action="{{ route('alternative.delete') }}"
                                                                method="POST">
                                                                <div class="modal-header bg-danger ">
                                                                    <h5 class="modal-title text-white font-weight-bold"
                                                                        id="deleteLabel">
                                                                        <i class="ti-na menu-icon"></i>
                                                                        Konfirmasi Hapus Alternative
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class=" text-center">
                                                                        <span class=" col font-weight-bold m-2">
                                                                            Anda yakin ingin hapus alternative
                                                                            {{ $prov['alternative'] }}
                                                                            ?</span>
                                                                        <div class="col-auto my-1">
                                                                            <input type="hidden" name="check" value="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <button type="button" class="btn btn-sm btn-white"
                                                                        data-dismiss="modal">Batalkan</button>

                                                                    @csrf
                                                                    <input type="hidden" value="{{ $prov['id'] }}"
                                                                        name="id">
                                                                    <input type="hidden"
                                                                        value="{{ $prov['alternative'] }}"
                                                                        name="alternative">
                                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                                        Yakin, hapus
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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
