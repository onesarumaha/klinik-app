@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tambah Rekam Medis</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rekam_medis.index') }}">Rekam Medis</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah</li>
            </ol>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('rekam_medis.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pemeriksaan</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Pilih Pasien</label>
                                <select class="form-control select2" name="pasien_id" required>
                                    <option value="">-- Pilih Pasien --</option>
                                    @foreach($pasien as $p)
                                        <option value="{{ $p->id }}" {{ old('pasien_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->no_rekam_medis }} - {{ $p->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tekanan Darah</label>
                                        <input type="text" name="tekanan_darah" class="form-control" placeholder="120/80"
                                            value="{{ old('tekanan_darah') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Suhu (°C)</label>
                                        <input type="text" name="suhu" class="form-control" placeholder="36.5"
                                            value="{{ old('suhu') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Berat (Kg)</label>
                                        <input type="text" name="berat_badan" class="form-control" placeholder="60"
                                            value="{{ old('berat_badan') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tinggi (Cm)</label>
                                        <input type="text" name="tinggi_badan" class="form-control" placeholder="170"
                                            value="{{ old('tinggi_badan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keluhan Utama</label>
                                <textarea name="keluhan" class="form-control" rows="3"
                                    required>{{ old('keluhan') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Diagnosis</label>
                                <textarea name="diagnosis" class="form-control" rows="3"
                                    required>{{ old('diagnosis') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Catatan Tambahan</label>
                                <textarea name="catatan" class="form-control" rows="2">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Resep Obat</h6>
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="addDrugRow()">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="drug-container">
                                <!-- Drug Row Template -->
                                <div class="drug-row mb-3 p-2 border rounded">
                                    <div class="form-group mb-2">
                                        <label>Obat</label>
                                        <select name="obats[0][obat_id]" class="form-control drug-select" required
                                            onchange="checkStock(this)">
                                            <option value="">-- Pilih Obat --</option>
                                            @foreach($obat as $o)
                                                <option value="{{ $o->id }}" data-stok="{{ $o->stok }}">
                                                    {{ $o->nama }} (Stok: {{ $o->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label>Jumlah</label>
                                                <input type="number" name="obats[0][jumlah]" class="form-control drug-qty"
                                                    min="1" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group mb-0">
                                                <label>Dosis</label>
                                                <input type="text" name="obats[0][dosis]" class="form-control"
                                                    placeholder="3x1 hari">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary btn-block">Simpan Rekam Medis</button>
                            <a href="{{ route('rekam_medis.index') }}" class="btn btn-secondary btn-block">Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        let drugCount = 1;

        function addDrugRow() {
            const container = document.getElementById('drug-container');
            const row = document.createElement('div');
            row.className = 'drug-row mb-3 p-2 border rounded position-relative';
            row.innerHTML = `
                <button type="button" class="btn btn-sm text-danger position-absolute" style="top:0; right:0" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="form-group mb-2">
                    <label>Obat</label>
                    <select name="obats[${drugCount}][obat_id]" class="form-control drug-select" required onchange="checkStock(this)">
                        <option value="">-- Pilih Obat --</option>
                        @foreach($obat as $o)
                            <option value="{{ $o->id }}" data-stok="{{ $o->stok }}">
                                {{ $o->nama }} (Stok: {{ $o->stok }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label>Jumlah</label>
                            <input type="number" name="obats[${drugCount}][jumlah]" class="form-control drug-qty" min="1" required>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mb-0">
                            <label>Dosis</label>
                            <input type="text" name="obats[${drugCount}][dosis]" class="form-control" placeholder="3x1 hari">
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(row);
            drugCount++;
        }

        function checkStock(select) {
            const option = select.options[select.selectedIndex];
            const stok = parseInt(option.getAttribute('data-stok'));
            const qtyInput = select.closest('.drug-row').querySelector('.drug-qty');
            qtyInput.max = stok;
            qtyInput.placeholder = 'Max ' + stok;
        }
    </script>
@endsection