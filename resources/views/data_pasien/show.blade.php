@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Detail Pasien</h3>

        <div class="mb-2">
            <label>No Rekam Medis:</label>
            <input type="text" value="{{ $data_pasien->no_rekam_medis }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>NIK:</label>
            <input type="text" value="{{ $data_pasien->nik }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Nama:</label>
            <input type="text" value="{{ $data_pasien->nama }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Jenis Kelamin:</label>
            <input type="text" value="{{ $data_pasien->jenis_kelamin }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Tanggal Lahir:</label>
            <input type="date" value="{{ $data_pasien->tanggal_lahir }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>No HP:</label>
            <input type="text" value="{{ $data_pasien->no_hp }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Alamat:</label>
            <textarea class="form-control" readonly>{{ $data_pasien->alamat }}</textarea>
        </div>

        <div class="mb-2">
            <label>Golongan Darah:</label>
            <input type="text" value="{{ $data_pasien->gol_darah ?? '-' }}" class="form-control" readonly>
        </div>

        <a href="{{ route('data_pasien.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection