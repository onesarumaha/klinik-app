@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        @if (session('success'))
            @push('scripts')
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: "{{ session('success') }}",
                    });
                </script>
            @endpush
        @endif
        <!-- Row -->
        <div class="row">
            <!-- Simple Tables -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Obat</h6>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalTambahObat">
                            Tambah Obat
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $index => $obat)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><a href="#" class="font-weight-bold text-primary">{{ $obat->kode }}</a></td>
                                        <td>{{ $obat->nama }}</td>
                                        <td>{{ $obat->kategori }}</td>
                                        <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                        <td>{{ $obat->stok ?? 0 }}</td>
                                        <td>
                                            @if (($obat->stok ?? 0) > 10)
                                                <span class="badge badge-success">Tersedia</span>
                                            @elseif (($obat->stok ?? 0) > 0)
                                                <span class="badge badge-warning">Hampir Habis</span>
                                            @else
                                                <span class="badge badge-danger">Habis</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('data-obat.edit', $obat->id) }}"
                                                class="btn btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>

    <!-- Modal Tambah Obat -->
    <div class="modal fade" id="modalTambahObat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLabel">Tambah Data Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('data-obat.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Kode Obat</label>
                                    <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode Obat"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Obat"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <input type="text" name="kategori" class="form-control" placeholder="Masukkan Kategori"
                                        required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <select name="satuan" class="form-control" required>
                                        <option value="" selected disabled>Pilih Satuan</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Kapsul">Kapsul</option>
                                        <option value="Sirup">Sirup</option>
                                        <option value="Botol">Botol</option>
                                        <option value="Box">Box</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" class="form-control" placeholder="Masukkan Harga"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Stok</label>
                                    <input type="number" name="stok" class="form-control" placeholder="Masukkan Stok"
                                        value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection