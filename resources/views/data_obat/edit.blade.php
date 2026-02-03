@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Dan Detail Obat</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('data-obat') }}">Data Obat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Dan Detail Obat</li>
            </ol>
        </div>

        <div class="row">
            <!-- Medicine Details -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Obat</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Kode Obat</strong>
                                <span>{{ $obat->kode }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Nama Obat</strong>
                                <span>{{ $obat->nama }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Kategori</strong>
                                <span>{{ $obat->kategori }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Satuan</strong>
                                <span>{{ $obat->satuan }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Harga</strong>
                                <span>Rp {{ number_format($obat->harga, 0, ',', '.') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Stok</strong>
                                <span>{{ $obat->stok ?? 0 }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Status</strong>
                                @if (($obat->stok ?? 0) > 10)
                                    <span class="badge badge-success">Tersedia</span>
                                @elseif (($obat->stok ?? 0) > 0)
                                    <span class="badge badge-warning">Hampir Habis</span>
                                @else
                                    <span class="badge badge-danger">Habis</span>
                                @endif
                            </li>
                        </ul>
                        <div class="mt-4 text-center">
                            <form action="{{ route('data-obat.destroy', $obat->id) }}" method="POST" id="deleteForm">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-block" onclick="confirmDelete()">
                                    <i class="fas fa-trash"></i> Hapus Obat
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Obat</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('data-obat.update', $obat->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>Kode Obat</label>
                                <input type="text" name="kode" class="form-control" value="{{ $obat->kode }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Nama Obat</label>
                                <input type="text" name="nama" class="form-control" value="{{ $obat->nama }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <input type="text" name="kategori" class="form-control"
                                    value="{{ $obat->kategori }}" required>
                            </div>

                            <div class="form-group">
                                <label>Satuan</label>
                                <select name="satuan" class="form-control" required>
                                    <option value="Tablet" {{ $obat->satuan == 'Tablet' ? 'selected' : '' }}>Tablet
                                    </option>
                                    <option value="Kapsul" {{ $obat->satuan == 'Kapsul' ? 'selected' : '' }}>Kapsul
                                    </option>
                                    <option value="Sirup" {{ $obat->satuan == 'Sirup' ? 'selected' : '' }}>Sirup
                                    </option>
                                    <option value="Botol" {{ $obat->satuan == 'Botol' ? 'selected' : '' }}>Botol
                                    </option>
                                    <option value="Box" {{ $obat->satuan == 'Box' ? 'selected' : '' }}>Box</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" value="{{ $obat->harga }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" value="{{ $obat->stok ?? 0 }}">
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('data-obat') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function confirmDelete() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data obat ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm').submit();
                    }
                })
            }
        </script>
    @endpush
@endsection
