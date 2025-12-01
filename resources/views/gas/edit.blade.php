@extends('layout.app')

@section('title', 'Edit Data Gas LPG')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Data Gas LPG</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('gas.update', $gas->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $gas->nama_barang }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="code_barang" class="form-label">Code Barang</label>
                <input type="text" class="form-control" id="code_barang" name="code_barang"
                    value="{{ $gas->code_barang }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{ $gas->harga }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Qty</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ $gas->qty }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $gas->jenis }}"
                    required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
