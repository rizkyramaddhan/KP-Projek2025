@extends('layout.app')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-3">Penilaian SPK – {{ $barang->nama_barang }}</h2>
        <p>Isi nilai untuk setiap kriteria di bawah ini. Nilai berupa angka (misal: 1–10).</p>

        {{-- Debug: tampilkan jumlah kriteria (hapus setelah beres) --}}
        <div class="mb-3">
            <small class="text-muted">Jumlah kriteria: {{ $kriteria->count() }}</small>
        </div>

        <form action="{{ route('spk.penilaian.store', $barang->id) }}" method="POST">
            @csrf

            {{-- Informasi Barang --}}
            <div class="card mb-3">
                <div class="card-body">
                    <strong>Nama Barang:</strong> {{ $barang->nama_barang }} <br>
                    <strong>Kode:</strong> {{ $barang->code_barang }} <br>
                    <strong>Jenis:</strong> {{ $barang->jenis }}
                </div>
            </div>

            {{-- Jika tidak ada kriteria, tampilkan pesan --}}
            @if ($kriteria->isEmpty())
                <div class="alert alert-warning">Belum ada kriteria. Tambahkan kriteria terlebih dahulu.</div>
            @else
                {{-- Input Kriteria --}}
                <div class="card p-3">
                    @foreach ($kriteria as $k)
                        <div class="mb-3">
                            <label class="form-label d-block">
                                {{ $k->nama_kriteria }}
                                <small class="text-muted">({{ $k->attribut }}, bobot: {{ $k->bobot }})</small>
                            </label>

                            {{-- Pastikan input terlihat: tambahkan placeholder/min/max --}}
                            <input type="number" name="kriteria[{{ $k->id }}]" class="form-control" step="0.01"
                                min="0" max="999999" placeholder="Masukkan nilai untuk {{ $k->nama_kriteria }}"
                                value="{{ old('kriteria.' . $k->id) }}" required>

                            {{-- Tampilkan error validasi spesifik --}}
                            @if ($errors->has('kriteria.' . $k->id))
                                <div class="text-danger small mt-1">
                                    {{ $errors->first('kriteria.' . $k->id) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif

            <button class="btn btn-primary mt-3">Simpan Penilaian</button>
            <a href="{{ route('spk.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
