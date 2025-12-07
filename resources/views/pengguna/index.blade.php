@extends('layout.app')

@section('title', 'Data Gas Pengguna')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manajemen Pengguna</h1>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                    <i class="fas fa-plus fa-sm me-1"></i>Tambah Pengguna
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
                                        Total Pengguna
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalUser }}
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
                                        Pengguna Aktif
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        2,453
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
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        pengguna NonAktif
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">5</div>
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
                                <option value="">Semua Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="filterStatus">
                                <option value="">Semua Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Pending">Pending</option>
                                <option value="NonAktif">NonAktif</option>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableProduk">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Nama Produk</th>
                                    <th width="12%">Email</th>
                                    <th width="12%">No. Telepon</th>
                                    <th width="8%">Role</th>
                                    <th width="10%">Status</th>
                                    <th width="13%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyProduk">
                                @foreach ($AllUser as $user)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>05121212123</td>
                                        <td><span class="badge bg-primary">{{ $user->role }}</span></td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <button class="btn btnDetail btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#modalDetailPengguna" data-id="{{ $user->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btnEdit btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modalUpdateProduk" data-id="{{ $user->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btnDelete btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalDeletePengguna" data-id="{{ $user->id }}"
                                                onclick="hapusProduk(1)">
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
                            {{ $AllUser->links('pagination::bootstrap-5') }}
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
                    <h5 class="modal-title">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="alertError" class="alert alert-danger d-none"></div>
                    <form id="formTambahPengguna">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" required />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-select" required>
                                    <option value="">Pilih Role</option>
                                    <option value="administrator">administrator</option>
                                    <option value="staff">staff</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control" required />
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirmation" class="form-control" required />
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" form="formTambahPengguna" class="btn btn-primary">
                        Simpan Produk
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Pengguna -->
    <div class="modal fade" id="modalEditPengguna" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div id="alertEditError" class="alert alert-danger d-none"></div>

                    <form id="formEditPengguna" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" id="editUserId">

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Username</label>
                                <input type="text" id="editUsername" name="username" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Role</label>
                                <select id="editRole" name="role" class="form-select">
                                    <option value="administrator">Admin</option>
                                    <option value="staff">Staff</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Email</label>
                                <input type="email" id="editEmail" name="email" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Password Baru (opsional)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                    </form>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                    <!-- Perbaikan tombol -->
                    <button type="button" id="btnUpdatePengguna" class="btn btn-primary">Update Pengguna</button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Detail Pengguna --}}
    <div class="modal fade" id="modalDetailPengguna" tabindex="-1">
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
                            <th style="width: 200px;">Username</th>
                            <td id="detailUsername"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="detailEmail"></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td id="detailRole"></td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td id="detailCreated"></td>
                        </tr>
                        <tr>
                            <th>Diupdate Pada</th>
                            <td id="detailUpdated"></td>
                        </tr>
                    </table>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDeletePengguna" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Hapus Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>Apakah kamu yakin ingin menghapus pengguna ini?</p>
                    <strong id="deleteUsername"></strong>
                    <input type="hidden" id="deleteUserId">
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" id="btnConfirmDelete">Hapus</button>
                </div>

            </div>
        </div>
    </div>





    <script>
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
                const nama = row.cells[1].textContent.toLowerCase();
                const kategori = row.cells[4].textContent.toLowerCase();
                const status = row.cells[5].textContent.toLowerCase();

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


        document.querySelectorAll(".btnDetail").forEach(btn => {
            btn.addEventListener("click", async function() {

                let id = this.dataset.id;

                let response = await fetch(`/pengguna/${id}`);
                let user = await response.json();

                // Isi modal
                document.getElementById("detailUsername").innerText = user.username ?? "-";
                document.getElementById("detailEmail").innerText = user.email ?? "-";
                document.getElementById("detailRole").innerText = user.role ?? "-";
                document.getElementById("detailCreated").innerText = user.created_at ?? "-";
                document.getElementById("detailUpdated").innerText = user.updated_at ?? "-";

                new bootstrap.Modal(document.getElementById("modalDetailPengguna")).show();
            });
        });

        document.getElementById("modalDetailPengguna").addEventListener("hidden.bs.modal", () => {

            document.querySelectorAll(".modal-backdrop").forEach(el => el.remove());
        });

        // Tombol Delete di tabel
        document.querySelectorAll(".btnDelete").forEach(btn => {
            btn.addEventListener("click", async function() {

                let id = this.dataset.id;

                // ambil user detail (untuk ditampilkan di modal)
                let response = await fetch(`/pengguna/${id}`);
                let user = await response.json();

                document.getElementById("deleteUsername").innerText = user.username;
                document.getElementById("deleteUserId").value = id;

                new bootstrap.Modal(document.getElementById("modalDeletePengguna")).show();
            });
        });

        // Fix backdrop nyangkut
        document.getElementById("modalDeletePengguna").addEventListener("hidden.bs.modal", () => {
            document.querySelectorAll(".modal-backdrop").forEach(b => b.remove());
        });

        // Confirm Delete
        document.getElementById("btnConfirmDelete").addEventListener("click", async function() {

            let id = document.getElementById("deleteUserId").value;

            let response = await fetch(`/pengguna/${id}`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                    "X-HTTP-Method-Override": "DELETE"
                },
            });

            let result = await response.json();

            if (result.success) {
                // alert(result.message);
                new bootstrap.Modal(document.getElementById("modalDeletePengguna")).hide();
                location.reload();
            } else {
                alert("Gagal menghapus pengguna.");
            }
        });

        document.querySelectorAll(".btnEdit").forEach(btn => {
            btn.addEventListener("click", async function() {
                let id = this.dataset.id;

                let res = await fetch(`/pengguna/${id}`);
                let user = await res.json();

                // isi modal
                document.getElementById("editUserId").value = user.id;
                document.getElementById("editUsername").value = user.username;
                document.getElementById("editEmail").value = user.email;
                document.getElementById("editRole").value = user.role;

                new bootstrap.Modal(document.getElementById("modalEditPengguna")).show();
            });
        });

        document.getElementById("btnUpdatePengguna").addEventListener("click", async function() {

            const form = document.getElementById("formEditPengguna");
            const formData = new FormData(form);
            const id = document.getElementById("editUserId").value;

            const alertError = document.getElementById("alertEditError");
            alertError.classList.add("d-none");
            alertError.innerHTML = "";

            let response = await fetch(`/pengguna/${id}`, {
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

                bootstrap.Modal.getInstance(document.getElementById("modalEditPengguna")).hide();
                form.reset();

                // OPTIONAL: reload table
                location.reload();
            }
        });

        // Form Submit Handler
        const formTambah = document.getElementById("formTambahPengguna");

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
                    const response = await fetch("{{ route('pengguna.store') }}", {
                        method: "POST",
                        body: formData,
                        credentials: 'same-origin', // ← WAJIB!
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
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

                        // OPTIONAL: reload table
                        location.reload();
                    }

                } catch (error) {
                    alert("Terjadi kesalahan server. Coba lagi.");
                }
            });
        }
    </script>
@endsection
