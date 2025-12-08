@extends('layout.app')

@section('title', 'Data Gas LPG')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manajemen Transaksi</h1>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                    <i class="fas fa-plus fa-sm me-1"></i>Tambah Transaksi
                </button>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Transaksi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    </div>
                                </div>
                                <div class="card-icon bg-primary-gradient">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Stok Tersedia
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    </div>
                                </div>
                                <div class="card-icon bg-success-gradient">
                                    <i class="fas fa-warehouse"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Pendapatan Bulan Ini
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="card-icon bg-warning-gradient">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Total Pendapatan
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                </div>
                                <div class="card-icon"
                                    style="
                      background: linear-gradient(
                        135deg,
                        #e74a3b 0%,
                        #be2617 100%
                      );
                    ">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Cari nama produk..." id="searchInput" />
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterKategori">
                                <option value="">Semua Kategori</option>
                                <option value="GAS2KG">GAS2KG</option>
                                <option value="GAS3KG">GAS3KG</option>
                                <option value="GAS5KG">GAS5KG</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="menipis">Stok Menipis</option>
                                <option value="habis">Habis</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-secondary w-100" onclick="resetFilter()">
                                <i class="fas fa-redo me-1"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Produk -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableProduk">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">code Barang</th>
                                    <th width="20%">Nama Produk</th>
                                    <th width="12%">Kategori</th>
                                    <th width="12%">Harga</th>
                                    <th width="8%">Stok</th>
                                    <th width="10%">Status</th>
                                    <th width="13%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyProduk">
                                {{-- @foreach ($Items as $item)
                                    <tr>
                                        <td>{{ $item->iteration }}</td>
                                        <td>
                                            {{ $item->code_barang }}
                                        </td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td><span class="badge bg-success">{{ $item->jenis }}</span></td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td><span class="badge bg-{{ $item->warna_stok }}">{{ $item->status_stok }}</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btnDetail btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailProduk" data-id="{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btnEdit btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdateProduk" data-id="{{ $item->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="hapusProduk(5)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-3">
                        <ul class="pagination justify-content-end">

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Tambah Produk -->
    <div class="modal fade" id="modalTambahProduk" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="alertError" class="alert alert-danger d-none"></div>
                    <form id="formTambahProduk">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Code Barang <span class="text-danger">*</span></label>
                                <input type="text" name="code_barang" class="form-control" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis" required>
                                    <option value="">Pilih Role</option>
                                    <option value="GAS3KG">GAS3KG</option>
                                    <option value="GAS5KG">GAS5Kg</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_barang" class="form-control" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" name="harga" class="form-control" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="qty" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" form="formTambahProduk" class="btn btn-primary">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Detail Produk --}}
    <div class="modal fade" id="modalDetailProduk" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div id="alertEditError" class="alert alert-danger d-none"></div>

                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Code Baramg</th>
                            <td id="detailCodeBarang"></td>
                        </tr>
                        <tr>
                            <th>Nama Produk</th>
                            <td id="detailNamaBarang"></td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td id="detailJenis"></td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td id="detailHarga"></td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td id="detailQTY"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td id="detailStatus"></td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td id="detailCreateAt"></td>
                        </tr>
                        <tr>
                            <th>DiUbah Pada</th>
                            <td id="detailUpdatedAt"></td>
                        </tr>
                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Update Produk -->
    <div class="modal fade" id="modalUpdateProduk" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="alertEditError" class="alert alert-danger d-none"></div>
                    <form id="formUpdateProduk">
                        @csrf
                        <input type="hidden" name="user_id" id="editBarangId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Code Barang <span class="text-danger">*</span></label>
                                <input type="text" name="code_barang" id="editCodeBarang" class="form-control"
                                    required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select" name="jenis" id="editJenis" required>
                                    <option value="">Pilih Role</option>
                                    <option value="GAS3KG">GAS3KG</option>
                                    <option value="GAS5KG">GAS5Kg</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                <input type="text" name="nama_barang" id="editNamaBarang" class="form-control"
                                    required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" name="harga" id="editHarga" class="form-control" required />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="qty" id="editQTY" class="form-control" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" id="btnUpdateBarang" form="formUpdateProduk" class="btn btn-primary">
                                Update Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Search & Filter Functions
            const searchInput = document.getElementById("searchInput");
            const filterKategori = document.getElementById("filterKategori");
            const filterStatus = document.getElementById("filterStatus");

            if (searchInput) {
                searchInput.addEventListener("input", filterTable);
            }
            if (filterKategori) {
                filterKategori.addEventListener("change", filterTable);
            }
            if (filterStatus) {
                filterStatus.addEventListener("change", filterTable);
            }

            function filterTable() {
                const searchValue = searchInput.value.toLowerCase();
                const kategoriValue = filterKategori.value.toLowerCase();
                const statusValue = filterStatus.value.toLowerCase();
                const rows = document.querySelectorAll("#bodyProduk tr");

                rows.forEach((row) => {
                    const nama = row.cells[2].textContent.toLowerCase();
                    const kategori = row.cells[3].textContent.toLowerCase();
                    const status = row.cells[6].textContent.toLowerCase();

                    const matchSearch = nama.includes(searchValue);
                    const matchKategori =
                        kategoriValue === "" || kategori.includes(kategoriValue);
                    const matchStatus =
                        statusValue === "" || status.includes(statusValue);

                    if (matchSearch && matchKategori && matchStatus) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            }

            function resetFilter() {
                searchInput.value = "";
                filterKategori.value = "";
                filterStatus.value = "";
                filterTable();
            }



        });
    </script>
@endsection
