@extends('layout.app')

@section('title', 'Data Gas LPG')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manajemen Produk</h1>
                <div class="d-flex gap-2 mt-3 mt-sm-0">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                        <i class="fas fa-plus fa-sm me-1"></i>Tambah Produk Baru
                    </button>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahStok">
                        <i class="fas fa-box fa-sm me-1"></i>Tambah Stok Produk
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Produk
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalBarang }}
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
                                        {{ $totalQty }}
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
                                        Stok Menipis
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stokMenipis }}</div>
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
                                        Stok Habis
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stokHabis }}</div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
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
                                @foreach ($Items as $item)
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
                                            <button class="btn btn-sm btnDelete btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDeleteProduk" data-id="{{ $item->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-3">
                        <ul class="pagination justify-content-end">
                            {{ $Items->links('pagination::bootstrap-5') }}
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

    {{-- Modal Delete Produk --}}
    <div class="modal fade" id="modalDeleteProduk" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Apakah kamu yakin ingin menghapus Produk ini?</p>
                    <strong id="deleteProduk"></strong>
                    <input type="hidden" id="deleteProdukId">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Stok -->
    <div class="modal fade" id="modalTambahStok" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stok</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="alertError" class="alert alert-danger d-none"></div>
                    <form id="formTambahStok">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Barang<span class="text-danger">*</span></label>
                                <select class="form-select" name="barang_id" id="barangId" required>
                                    <option value="">Pilih Nama Barang</option>
                                    @foreach ($Items as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_barang }} (Kode:
                                            {{ $item->code_barang }})</option>
                                    @endforeach
                                </select>
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
                            <button type="submit" form="formTambahStok" id="btnTambahStok" class="btn btn-primary">
                                Simpan Produk
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

            // CRUD Functions
            document.querySelectorAll(".btnDetail").forEach(btn => {
                btn.addEventListener("click", async function() {
                    let id = this.dataset.id;

                    let res = await fetch(`/gas/${id}`);
                    let Barang = await res.json();

                    // isi modal
                    // document.getElementById("detailBarangId").innerText = Barang.id ?? "-";
                    document.getElementById("detailCodeBarang").innerText = Barang
                        .code_barang ?? "-";
                    document.getElementById("detailJenis").innerText = Barang.jenis;
                    document.getElementById("detailNamaBarang").innerText = Barang
                        .nama_barang ?? "-";
                    document.getElementById("detailHarga").innerText = parseInt(Barang.harga) ??
                        "-";
                    document.getElementById("detailQTY").innerText = Barang.qty ?? "-";
                    document.getElementById("detailStatus").innerText = Barang
                        .status_stok ??
                        "-";
                    document.getElementById("detailCreateAt").innerText = Barang.created_at ??
                        "-";
                    document.getElementById("detailUpdatedAt").innerText = Barang.updated_at ??
                        "-";

                    new bootstrap.Modal(document.getElementById("modalDetailProduk")).show();


                });
            });

            document.querySelectorAll(".btnEdit").forEach(btn => {
                btn.addEventListener("click", async function() {
                    let id = this.dataset.id;

                    let res = await fetch(`/gas/${id}`);
                    let Barang = await res.json();

                    // isi modal
                    document.getElementById("editBarangId").value = Barang.id;
                    document.getElementById("editCodeBarang").value = Barang.code_barang;
                    document.getElementById("editJenis").value = Barang.jenis;
                    document.getElementById("editNamaBarang").value = Barang.nama_barang;
                    document.getElementById("editHarga").value = parseInt(Barang.harga);
                    document.getElementById("editQTY").value = Barang.qty;

                    new bootstrap.Modal(document.getElementById("modalUpdateProduk")).show();
                });
            });

            document.getElementById("btnUpdateBarang").addEventListener("click", async function() {

                const form = document.getElementById("formUpdateProduk");
                const formData = new FormData(form);
                const id = document.getElementById("editBarangId").value;

                const alertError = document.getElementById("alertEditError");
                alertError.classList.add("d-none");
                alertError.innerHTML = "";

                let response = await fetch(`/gas/${id}`, {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "X-HTTP-Method-Override": "PUT"
                    },
                    body: formData
                });

                if (response.status === 422) {
                    let errorData = await response.json();
                    let text = "";

                    Object.keys(errorData.errors).forEach(key => {
                        text += `<div>${errorData.errors[key][0]}</div>`;
                    });

                    alertError.innerHTML = text;
                    alertError.classList.remove("d-none");
                    return;
                }

                let result = await response.json();

                if (result.success) {
                    alert(result.message);

                    bootstrap.Modal.getInstance(document.getElementById("modalUpdateProduk")).hide();
                    form.reset();

                    // OPTIONAL: reload table
                    location.reload();
                }
            });

            document.getElementById("modalDetailProduk").addEventListener("hidden.bs.modal", () => {
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
            });

            document.getElementById("modalUpdateProduk").addEventListener("hidden.bs.modal", () => {
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
            });

            // Tombol Delete di tabel
            document.querySelectorAll(".btnDelete").forEach(btn => {
                btn.addEventListener("click", async function() {

                    let id = this.dataset.id;

                    // ambil user detail (untuk ditampilkan di modal)
                    let response = await fetch(`/gas/${id}`);
                    let Barang = await response.json();

                    document.getElementById("deleteProduk").innerText = Barang.nama_barang;
                    document.getElementById("deleteProdukId").value = id;

                    new bootstrap.Modal(document.getElementById("modalDeleteProduk")).show();
                });
            });

            // Confirm Delete
            document.getElementById("btnConfirmDelete").addEventListener("click", async function() {

                let id = document.getElementById("deleteProdukId").value;

                let response = await fetch(`/gas/${id}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "X-HTTP-Method-Override": "DELETE"
                    },
                });

                let result = await response.json();

                if (result.success) {
                    alert(result.message);
                    new bootstrap.Modal(document.getElementById("modalDeleteProduk")).hide();
                    location.reload();
                    modal.hide();

                    // Reset form
                    formTambah.reset();

                } else {
                    alert("Gagal menghapus pengguna.");
                }
            });

            document.getElementById("modalDeleteProduk").addEventListener("hidden.bs.modal", () => {
                document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
            });

            document.getElementById("btnTambahStok").addEventListener("click", async function() {

                const form = document.getElementById("formTambahStok");
                const formData = new FormData(form);
                const id = document.getElementById("barangId").value;

                const alertError = document.getElementById("alertEditError");
                alertError.classList.add("d-none");
                alertError.innerHTML = "";

                let response = await fetch(`/gas/tambah-stok`, {
                    method: "POST",
                    credentials: "same-origin",
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                        "X-HTTP-Method-Override": "PUT"
                    },
                    body: formData
                });

                if (response.status === 422) {
                    let errorData = await response.json();
                    let text = "";

                    Object.keys(errorData.errors).forEach(key => {
                        text += `<div>${errorData.errors[key][0]}</div>`;
                    });

                    alertError.innerHTML = text;
                    alertError.classList.remove("d-none");
                    return;
                }

                let result = await response.json();

                if (result.success) {
                    alert(result.message);

                    bootstrap.Modal.getInstance(document.getElementById("modalTambahStok")).hide();
                    form.reset();

                    // OPTIONAL: reload table
                    location.reload();
                }
            });

            const formTambah = document.getElementById("formTambahProduk");

            if (formTambah) {
                formTambah.addEventListener("submit", async function(e) {
                    e.preventDefault();

                    // Ambil data form
                    const formData = new FormData(formTambah);

                    // Reset Error Alert
                    const alertError = document.getElementById("alertError");
                    alertError.classList.add("d-none");
                    alertError.innerHTML = "";

                    try {
                        const response = await fetch("{{ route('gas.store') }}", {
                            method: "POST",
                            body: formData,
                            credentials: 'same-origin', // ← WAJIB!
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                                    .value
                            }
                        });

                        // Jika validasi gagal Laravel → status 422
                        if (response.status === 422) {
                            const errorData = await response.json();
                            let errorMessages = "";

                            Object.keys(errorData.errors).forEach((key) => {
                                errorMessages += `<div>${errorData.errors[key][0]}</div>`;
                            });

                            alertError.innerHTML = errorMessages;
                            alertError.classList.remove("d-none");
                            return; // hentikan proses
                        }

                        // Ambil result sukses
                        const result = await response.json();

                        if (result.success) {
                            alert(result.message);

                            // Tutup modal
                            const modal = bootstrap.Modal.getInstance(
                                document.getElementById("modalTambahProduk")
                            );
                            modal.hide();

                            // Reset form
                            formTambah.reset();
                        }

                    } catch (error) {
                        alert("Terjadi kesalahan server. Coba lagi.");
                    }
                });
            }

        });
    </script>
@endsection
