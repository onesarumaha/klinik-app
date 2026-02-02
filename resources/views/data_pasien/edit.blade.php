@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Data Pasien</h3>

        <form action="{{ route('data_pasien.update', $data_pasien->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>No Rekam Medis</label>
                <input type="text" name="no_rekam_medis" class="form-control" value="{{ $data_pasien->no_rekam_medis }}"
                    required>
            </div>

            <div class="mb-2">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $data_pasien->nik }}" required>
            </div>

            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ $data_pasien->nama }}" required>
            </div>

            <div class="mb-2">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $data_pasien->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $data_pasien->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="{{ $data_pasien->tanggal_lahir }}"
                    required>
            </div>

            <div class="mb-2">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $data_pasien->no_hp }}" required>
            </div>

            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control">{{ $data_pasien->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label>Golongan Darah</label>
                <select name="gol_darah" class="form-control">
                    <option value="A" {{ $data_pasien->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $data_pasien->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                    <option value="AB" {{ $data_pasien->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                    <option value="O" {{ $data_pasien->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('data_pasien.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection