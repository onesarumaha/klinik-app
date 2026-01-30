@extends('layouts.app')

@section('content')
  <div class="container-fluid" id="container-wrapper">
                        <div
                            class="d-sm-flex align-items-center justify-content-between mb-4"
                        >
                            <h1 class="h3 mb-0 text-gray-800">Data Obat</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item">Data Obat</li>
                            </ol>
                        </div>

                        <!-- Row -->
                        <div class="row">
                            <!-- DataTable with Hover -->
                            <div class="col-lg-12">
                                <div class="card mb-4">
                                    <div class="table-responsive p-3">
                                        <table
                                            class="table align-items-center table-flush table-hover"
                                            id="dataTableHover"
                                        >
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Satuan</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @forelse ($data as $index => $obat)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $obat->kode }}</td>
                                                        <td>{{ $obat->nama }}</td>
                                                        <td>{{ $obat->kategori }}</td>
                                                        <td>{{ $obat->satuan }}</td>
                                                        <td>Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                                                        <td>{{ $obat->stok }}</td>
                                                        <th>
                                                            <div class="dropdown">
                                                                <a class="btn btn-primary dropdown-toggle btn-sm"
                                                                    href="#"
                                                                    role="button"
                                                                    id="dropdownMenuLink"
                                                                    data-toggle="dropdown"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false"
                                                                >
                                                                    Action
                                                                </a>
                                                                <div
                                                                    class="dropdown-menu"
                                                                    aria-labelledby="dropdownMenuLink"
                                                                >
                                                                    <a class="dropdown-item" href="#" >Hapus</a>
                                                                    <a class="dropdown-item" href="#" >Edit</a>
                                                                    <a class="dropdown-item" href="#" >Detail</a>
                                                                   
                                                                </div>
                                                            </div>
                                                        </th>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">Data tidak ada</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Row-->

                    </div>
@endsection
