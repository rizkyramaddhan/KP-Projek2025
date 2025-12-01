@extends('layout.app')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-3">Sistem Pendukung Keputusan - Metode SAW</h2>
        <p>Pilih barang yang akan diberikan penilaian berdasarkan kriteria SPK.</p>

        <a href="{{ route('spk.hasil') }}" class="btn btn-success mb-3">
            Lihat Hasil Perhitungan SPK
        </a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Barang</th>
                    <th>Kode</th>
                    <th>Jenis</th>
                    <th>Qty</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($barang as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->code_barang }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>
                            <a href="{{ route('spk.penilaian.form', $item->id) }}" class="btn btn-warning btn-sm">
                                Penilaian SPK
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
