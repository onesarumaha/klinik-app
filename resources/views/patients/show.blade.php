@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Detail Pasien</h3>

        <div class="mb-2">
            <label>No Rekam Medis:</label>
            <input type="text" value="{{ $patient->no_rekam_medis }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>NIK:</label>
            <input type="text" value="{{ $patient->nik }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Nama:</label>
            <input type="text" value="{{ $patient->nama }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Jenis Kelamin:</label>
            <input type="text" value="{{ $patient->jk }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Tanggal Lahir:</label>
            <input type="date" value="{{ $patient->tgl_lahir }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>No HP:</label>
            <input type="text" value="{{ $patient->hp }}" class="form-control" readonly>
        </div>

        <div class="mb-2">
            <label>Alamat:</label>
            <textarea class="form-control" readonly>{{ $patient->alamat }}</textarea>
        </div>

        <div class="mb-2">
            <label>Golongan Darah:</label>
            @if ($patient->gol_darah)
                {{ $patient->gol_darah }}
            @else
                -
            @endif
        </div>

        <a href="{{ route('patients.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
