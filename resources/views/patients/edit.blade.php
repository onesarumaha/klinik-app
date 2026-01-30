@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Data Pasien</h3>

        <form action="{{ route('patients.update', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>No Rekam Medis</label>
                <input type="text" name="no_rekam_medis" class="form-control" value="{{ $patient->no_rekam_medis }}"
                    required>
            </div>

            <div class="mb-2">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $patient->nik }}" required>
            </div>

            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $patient->nama }}" required>
            </div>

            <div class="mb-2">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control" required>
                    <option value="L" {{ $patient->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $patient->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ $patient->tgl_lahir }}" required>
            </div>

            <div class="mb-2">
                <label>No HP</label>
                <input type="text" name="hp" class="form-control" value="{{ $patient->hp }}">
            </div>

            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ $patient->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label>Golongan Darah</label>
                <select name="gol_darah" class="form-control">
                    <option value="" {{ $patient->gol_darah == '' ? 'selected' : '' }}>-</option>
                    <option value="A" {{ $patient->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $patient->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ $patient->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ $patient->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                </select>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
