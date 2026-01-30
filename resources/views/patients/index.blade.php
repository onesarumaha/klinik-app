@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mb-3">Data Pasien</h3>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        timer: 2000,
                        showConfirmButton: false
                    });
                });
            </script>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('patients.create') }}" class="btn btn-primary">
                Tambah Pasien
            </a>

            <form method="GET" action="{{ route('patients.index') }}" class="d-flex">
                <input type="text" name="q" class="form-control me-2" placeholder="Cari pasien..."
                    value="{{ request('q') }}">
                <button class="btn btn-outline-secondary" type="submit">
                    Cari
                </button>
            </form>
        </div>

        <table class="table table-bordered" id="patientTable">
            <thead>
                <tr>
                    <th>No RM</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>JK</th>
                    <th>Tgl Lahir</th>
                    <th>HP</th>
                    <th>Gol Darah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $p)
                    <tr>
                        <td>{{ $p->no_rekam_medis }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->jk }}</td>
                        <td>{{ $p->tgl_lahir }}</td>
                        <td>{{ $p->hp }}</td>
                        <td>{{ $p->gol_darah }}</td>
                        <td>
                            <a href="{{ route('patients.show', $p->id) }}" class="btn btn-info btn-sm">
                                Lihat
                            </a>
                            <a href="{{ route('patients.edit', $p->id) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>
                            <form action="{{ route('patients.destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus Data Pasien ini?')">
                                    Hapus
                                </button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $patients->withQueryString()->links() }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let keyword = this.value.toLowerCase();
            let rows = document.querySelectorAll('#patientTable tbody tr');

            rows.forEach(row => {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ?
                    '' :
                    'none';
            });
        });
    </script>
@endsection
