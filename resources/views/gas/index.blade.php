@extends('layout.app')

@section('title', 'Data Gas LPG')

@section('content')
    <div class="container">
        <h1 class="mb-4">Data Gas LPG</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <a href="{{ route('gas.create') }}" class="btn btn-primary">Tambah Data Gas LPG</a>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>code Baramg</th>
                            <th>nama Barang</th>
                            <th>Harga</th>
                            <th>qty</th>
                            <th>jenis</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->code_barang }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->jenis }}</td>
                                <td>
                                    <a href="{{ route('gas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('gas.destroy', $item->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
