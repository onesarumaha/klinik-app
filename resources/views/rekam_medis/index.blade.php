@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rekam Medis</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rekam Medis</li>
            </ol>
        </div>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{ session('success') }}
        </div>
        @endif

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Rekam Medis</h6>
                        <a href="{{ route('rekam_medis.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Rekam Medis
                        </a>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tgl</th>
                                    <th>Pasien</th>
                                    <th>Keluhan</th>
                                    <th>Diagnosis</th>
                                    <th>Obat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $rm)
                                    <tr>
                                        <td>{{ $rm->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $rm->pasien->nama ?? 'Pasien Tidak Ditemukan' }}</td>
                                        <td>{{ Str::limit($rm->keluhan, 30) }}</td>
                                        <td>{{ Str::limit($rm->diagnosis, 30) }}</td>
                                        <td>
                                            @foreach($rm->obats as $item)
                                                <span class="badge badge-info">{{ $item->obat->nama ?? 'Obat Terhapus' }}
                                                    ({{ $item->jumlah }})</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('rekam_medis.show', $rm->id) }}"
                                                class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
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
@endsection