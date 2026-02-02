@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Data Pasien</h3>

        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('data_pasien.create') }}" class="btn btn-primary">Tambah Pasien</a>
            </div>
            <div class="col-md-6">
                <form action="{{ route('data_pasien.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama / No RM / NIK" value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No RM</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>No HP</th>
                    <th>Alamat</th>
                    <th>Gol. Darah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pasien as $p)
                    <tr>
                        <td>{{ $p->no_rekam_medis }}</td>
                        <td>{{ $p->nik }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->jenis_kelamin }}</td>
                        <td>{{ $p->tanggal_lahir }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->gol_darah }}</td>
                        <td>
                            <a href="{{ route('data_pasien.show', $p->id) }}" class="btn btn-info btn-sm">Lihat</a>
                            <a href="{{ route('data_pasien.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('data_pasien.destroy', $p->id) }}" method="POST"
                                style="display:inline-block" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $pasien->appends(['search' => request('search')])->links() }}
    </div>

    @push('scripts')
        <script>
            // Success Alert
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 1500,
                    showConfirmButton: false
                });
            @endif

            // Delete Confirmation
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection