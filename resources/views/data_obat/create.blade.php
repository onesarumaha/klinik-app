@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Tambah Data Pasien</h3>

        <form action="{{ route('patients.store') }}" method="POST">
            @csrf

            <div class="mb-2">
                <label>No Rekam Medis</label>
                <input type="text" name="no_rekam_medis" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" @error('nik') is-invalid @enderror required>
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>No HP</label>
                <input type="text" name="hp" class="form-control">
            </div>

            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Golongan Darah</label>
                <select name="gol_darah" class="form-control">
                    <option value="">-</option>
                    <option>A</option>
                    <option>B</option>
                    <option>AB</option>
                    <option>O</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
