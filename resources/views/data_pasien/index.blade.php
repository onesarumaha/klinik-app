@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">


        {{-- Header --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Pasien</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPasien">
                Tambah Pasien
            </button>
        </div>

        {{-- Card --}}
        <div class="card shadow mb-4">
            <div class="d-flex p-2 py-3 align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table align-items-center table-flush" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th>No RM</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Gol. Darah</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pasien as $p)
                                <tr>
                                    <td>{{ $p->no_rekam_medis }}</td>
                                    <td>{{ $p->nik }}</td>
                                    <td class="text-nowrap">{{ $p->nama }}</td>
                                    <td>{{ $p->jenis_kelamin }}</td>
                                    <td class="text-nowrap">{{ $p->tanggal_lahir }}</td>
                                    <td>{{ $p->no_hp }}</td>
                                    <td class="text-nowrap">{{ $p->alamat }}</td>
                                    <td>{{ $p->gol_darah }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <button type="button" class="btn btn-info btn-sm mx-1" data-toggle="modal"
                                                data-target="#modalShow{{ $p->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-warning btn-sm mx-1" data-toggle="modal"
                                                data-target="#modalEdit{{ $p->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <form action="{{ route('data_pasien.destroy', $p->id) }}" method="POST"
                                                class="d-inline mx-1 form-delete">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                                <!-- Modal Show -->
                                                <div class="modal fade" id="modalShow{{ $p->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalShowLabel{{ $p->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content text-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold text-primary" id="modalShowLabel{{ $p->id }}">Detail Pasien</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-2">
                                                                    <label>No Rekam Medis:</label>
                                                                    <input type="text" value="{{ $p->no_rekam_medis }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>NIK:</label>
                                                                    <input type="text" value="{{ $p->nik }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>Nama:</label>
                                                                    <input type="text" value="{{ $p->nama }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>Jenis Kelamin:</label>
                                                                    <input type="text" value="{{ $p->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>Tanggal Lahir:</label>
                                                                    <input type="date" value="{{ $p->tanggal_lahir }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>No HP:</label>
                                                                    <input type="text" value="{{ $p->no_hp }}" class="form-control" readonly>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>Alamat:</label>
                                                                    <textarea class="form-control" readonly>{{ $p->alamat }}</textarea>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <label>Golongan Darah:</label>
                                                                    <input type="text" value="{{ $p->gol_darah }}" class="form-control" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="modalEdit{{ $p->id }}" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalEditLabel{{ $p->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content text-left">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title font-weight-bold text-primary" id="modalEditLabel{{ $p->id }}">Edit Data Pasien</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('data_pasien.update', $p->id) }}" method="POST" class="editForm" novalidate>
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-2">
                                                                        <label>No Rekam Medis</label>
                                                                        <input type="text" name="no_rekam_medis" class="form-control" value="{{ $p->no_rekam_medis }}" required>
                                                                        <div class="invalid-feedback">No Rekam Medis wajib diisi.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>NIK</label>
                                                                        <input type="text" name="nik" class="form-control" value="{{ $p->nik }}" required>
                                                                        <div class="invalid-feedback">NIK wajib diisi.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>Nama</label>
                                                                        <input type="text" name="nama" class="form-control" value="{{ $p->nama }}" required>
                                                                        <div class="invalid-feedback">Nama wajib diisi.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>Jenis Kelamin</label>
                                                                        <select name="jenis_kelamin" class="form-control" required>
                                                                            <option value="L" {{ $p->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                                            <option value="P" {{ $p->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Pilih jenis kelamin.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>Tanggal Lahir</label>
                                                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ $p->tanggal_lahir }}" required>
                                                                        <div class="invalid-feedback">Tanggal lahir wajib diisi.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>No HP</label>
                                                                        <input type="text" name="no_hp" class="form-control" value="{{ $p->no_hp }}" required>
                                                                        <div class="invalid-feedback">No HP wajib diisi.</div>
                                                                    </div>
                                                                    <div class="mb-2">
                                                                        <label>Alamat</label>
                                                                        <textarea name="alamat" class="form-control">{{ $p->alamat }}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label>Golongan Darah</label>
                                                                        <select name="gol_darah" class="form-control">
                                                                            <option value="A" {{ $p->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                                                                            <option value="B" {{ $p->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                                                                            <option value="AB" {{ $p->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                                                                            <option value="O" {{ $p->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
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
        <!-- Modal Tambah Pasien -->
        <div class="modal fade" id="modalTambahPasien" tabindex="-1" role="dialog" aria-labelledby="modalTambahPasienLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title m-0 font-weight-bold text-primary" id="modalTambahPasienLabel">Tambah Data Pasien
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('data_pasien.store') }}" method="POST" id="createForm" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>No Rekam Medis</label>
                                    <input type="text" name="no_rekam_medis" class="form-control" required>
                                    <div class="invalid-feedback">No Rekam Medis wajib diisi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" required>
                                    <div class="invalid-feedback">NIK wajib diisi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" required>
                                    <div class="invalid-feedback">Nama wajib diisi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">Pilih jenis kelamin.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control" required>
                                    <div class="invalid-feedback">Tanggal lahir wajib diisi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>No HP</label>
                                    <input type="text" name="no_hp" class="form-control" required>
                                    <div class="invalid-feedback">No HP wajib diisi.</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Golongan Darah</label>
                                    <select name="gol_darah" class="form-control">
                                        <option value="" disabled selected>-- Pilih Golongan Darah --</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('createForm').addEventListener('submit', function (e) {
            e.preventDefault();
            let form = this;
            let isValid = true;
            let requiredInputs = form.querySelectorAll('[required]');

            requiredInputs.forEach(input => {
                if (!input.value) {
                    input.classList.add('is-invalid');
                    isValid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Harap lengkapi semua kolom yang wajib diisi!',
                });
                return;
            }

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

        // Clear validation on input
        document.querySelectorAll('#createForm [required]').forEach(input => {
            input.addEventListener('input', function () {
                if (this.value) {
                    this.classList.remove('is-invalid');
                }
            });
        });
    </script>
    <script>
        // Handle Edit Form Validation generically
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editForm').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    let currentForm = this;
                    let isValid = true;
                    let requiredInputs = currentForm.querySelectorAll('[required]');

                    requiredInputs.forEach(input => {
                        if (!input.value) {
                            input.classList.add('is-invalid');
                            isValid = false;
                        } else {
                            input.classList.remove('is-invalid');
                        }
                    });

                    if (!isValid) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Harap lengkapi semua kolom yang wajib diisi!',
                        });
                        return;
                    }

                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data akan diperbarui!",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Update!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            currentForm.submit();
                        }
                    });
                });

                // Clear validation on input for edit forms
                form.querySelectorAll('[required]').forEach(input => {
                    input.addEventListener('input', function() {
                        if (this.value) {
                            this.classList.remove('is-invalid');
                        }
                    });
                });
            });
        });

        // SweetAlert for Delete
        document.querySelectorAll('.form-delete').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let currentForm = this;
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        currentForm.submit();
                    }
                });
            });
        });
    </script>
@endpush