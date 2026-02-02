@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="text-primary">Tambah Data Pasien</h3>

        <form action="{{ route('data_pasien.store') }}" method="POST" id="createForm" novalidate>
            @csrf

            <!-- Checks inputs for validity manually -->

            <div class="mb-2">
                <label>No Rekam Medis</label>
                <input type="text" name="no_rekam_medis" class="form-control" required>
                <div class="invalid-feedback">No Rekam Medis wajib diisi.</div>
            </div>

            <div class="mb-2">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" required>
                <div class="invalid-feedback">NIK wajib diisi.</div>
            </div>

            <div class="mb-2">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" required>
                <div class="invalid-feedback">Nama wajib diisi.</div>
            </div>

            <div class="mb-2">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <div class="invalid-feedback">Pilih jenis kelamin.</div>
            </div>

            <div class="mb-2">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
                <div class="invalid-feedback">Tanggal lahir wajib diisi.</div>
            </div>

            <div class="mb-2">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
                <div class="invalid-feedback">No HP wajib diisi.</div>
            </div>

            <div class="mb-2">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Golongan Darah</label>
                <select name="gol_darah" class="form-control">
                    <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('data_pasien.index') }}" class="btn btn-secondary">Batal</a>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @push('scripts')
        <script>
            document.getElementById('createForm').addEventListener('submit', function (e) {
                e.preventDefault(); // Always prevent default first
                let form = this;
                let isValid = true;

                // Manual check of required fields
                let requiredInputs = form.querySelectorAll('[required]');
                requiredInputs.forEach(input => {
                    if (!input.value) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });

                // Add listener to remove invalid class on input
                requiredInputs.forEach(input => {
                    input.addEventListener('input', function () {
                        if (this.value) {
                            this.classList.remove('is-invalid');
                        }
                    });
                });

                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Harap lengkapi semua kolom yang wajib diisi!',
                    });
                    return;
                }

                // If valid, show confirmation
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data akan disimpan!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Simpan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        </script>
    @endpush
@endsection