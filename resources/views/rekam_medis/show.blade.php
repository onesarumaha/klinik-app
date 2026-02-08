@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rekam_medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
            </ol>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <!-- Data Pasien & Pemeriksaan -->
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Pemeriksaan</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Nama Pasien</div>
                            <div class="col-sm-9">: {{ $rekam_medis->pasien->nama }}
                                ({{ $rekam_medis->pasien->no_rekam_medis }})</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3 font-weight-bold">Tanggal Periksa</div>
                            <div class="col-sm-9">: {{ $rekam_medis->created_at->format('d F Y H:i') }}</div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="font-weight-bold text-xs uppercase">Tekanan Darah</label>
                                <div class="h5">{{ $rekam_medis->tekanan_darah ?? '-' }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold text-xs uppercase">Suhu</label>
                                <div class="h5">{{ $rekam_medis->suhu ?? '-' }} °C</div>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold text-xs uppercase">Berat Badan</label>
                                <div class="h5">{{ $rekam_medis->berat_badan ?? '-' }} Kg</div>
                            </div>
                            <div class="col-md-3">
                                <label class="font-weight-bold text-xs uppercase">Tinggi Badan</label>
                                <div class="h5">{{ $rekam_medis->tinggi_badan ?? '-' }} Cm</div>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label class="font-weight-bold">Keluhan Utama:</label>
                            <p class="bg-light p-3 rounded">{{ $rekam_medis->keluhan }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Diagnosis:</label>
                            <p class="bg-light p-3 border-left-primary rounded">{{ $rekam_medis->diagnosis }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="font-weight-bold">Catatan Dokter:</label>
                            <p>{{ $rekam_medis->catatan ?: '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Resep Obat -->
                <div class="card mb-4">
                    <div class="card-header py-3 bg-primary text-white">
                        <h6 class="m-0 font-weight-bold">Resep Obat</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach($rekam_medis->obats as $item)
                                <li class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-0 font-weight-bold">{{ $item->obat->nama }}</h6>
                                            <small class="text-muted">{{ $item->dosis }}</small>
                                        </div>
                                        <span class="badge badge-primary badge-pill">{{ $item->jumlah }}
                                            {{ $item->obat->satuan }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <hr>
                        <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary btn-block">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection