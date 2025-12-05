@extends('layout.app')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                <a href="#" class="btn btn-primary btn-sm">
                    <i class="fas fa-download fa-sm me-1"></i>Generate Report
                </a>
            </div>

            <!-- Stats Cards Row -->
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
                                        {{ $total_user }}
                                    </div>
                                </div>
                                <div class="card-icon bg-primary-gradient">
                                    <i class="fas fa-users"></i>
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
                                        Pendapatan (Bulan Ini)
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Rp 12.5M
                                    </div>
                                </div>
                                <div class="card-icon bg-success-gradient">
                                    <i class="fas fa-dollar-sign"></i>
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
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Total Transaksi
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        5
                                    </div>
                                </div>
                                <div class="card-icon bg-info-gradient">
                                    <i class="fas fa-clipboard-list"></i>
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
                                        Total Barang
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_barang }}</div>
                                </div>
                                <div class="card-icon bg-warning-gradient">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row g-4">
                <!-- Recent Activity -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">
                                Aktivitas Terbaru
                            </h6>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Aktivitas</th>
                                            <th>Role</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($last_logActivity as $activity)
                                            <tr>
                                                <td>#001</td>
                                                <td>{{ $activity->username }}</td>
                                                <td>{{ $activity->activity }}</td>
                                                <td><span
                                                        class="badge bg-success">{{ $activity->user ? $activity->user->role : 'role tidak ditemukan' }}</span>
                                                </td>
                                                <td>{{ $activity->created_at }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-block" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahPengguna">
                                    <i class="fas fa-plus me-2"></i>Tambah Pengguna
                                </button>
                                <button class="btn btn-success btn-block" data-bs-toggle="modal"
                                    data-bs-target="#modalTambahProduk">
                                    <i class="fas fa-box me-2"></i>Tambah Produk
                                </button>
                                <button class="btn btn-info btn-block">
                                    <i class="fas fa-file-alt me-2"></i>Buat Laporan
                                </button>
                                <button class="btn btn-warning btn-block">
                                    <i class="fas fa-cog me-2"></i>Pengaturan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>

        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="modalTambahProduk" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formUpdateProduk">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Code Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-select" required>
                                        <option value="">Pilih Role</option>
                                        <option value="GAS3KG">GAS3KG</option>
                                        <option value="GAS5KG">GAS5Kg</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Aktif">Aktif</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" form="formTambahProduk" class="btn btn-primary">
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Tambah pengguna --}}
        <div class="modal fade" id="modalTambahPengguna" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Pengguna Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTambahProduk">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-select" required>
                                        <option value="">Pilih Role</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Staff">Staff</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" required />
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" required />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="NonAktif">NonAktif</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" form="formTambahProduk" class="btn btn-primary">
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
