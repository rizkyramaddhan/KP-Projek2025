@extends('layout.app')

@section('title', 'Pengaturan')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Pengaturan Sistem</h1>
            </div>

            <div class="row g-4">
                <!-- Pengaturan Profil -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan Profil</h6>
                        </div>
                        <div class="card-body">
                            <form id="formProfil">
                                <div class="row">

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="Admin User" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" class="form-control" value="admin" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" required>
                                            <option value="">Pilih Status</option>
                                            <option value="Aktif">Aktif</option>
                                            <option value="NonAktif">NonAktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Ubah Password -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
                        </div>
                        <div class="card-body">
                            <form id="formPassword">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" class="form-control" required
                                            placeholder="Minimal 8 karakter">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" class="form-control" required
                                            placeholder="Ulangi password baru">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-key me-1"></i>Ubah Password
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Pengaturan Aplikasi -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan Aplikasi</h6>
                        </div>
                        <div class="card-body">
                            <form id="formAplikasi">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Aplikasi</label>
                                        <input type="text" class="form-control" value="AdminPanel" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Sistem</label>
                                        <input type="email" class="form-control" value="system@adminpanel.com" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Timezone</label>
                                        <select class="form-select">
                                            <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                            <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                            <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Bahasa</label>
                                        <select class="form-select">
                                            <option value="id" selected>Indonesia</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Format Tanggal</label>
                                        <select class="form-select">
                                            <option value="d-m-Y" selected>DD-MM-YYYY</option>
                                            <option value="Y-m-d">YYYY-MM-DD</option>
                                            <option value="m/d/Y">MM/DD/YYYY</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Mata Uang</label>
                                        <select class="form-select">
                                            <option value="IDR" selected>IDR (Rupiah)</option>
                                            <option value="USD">USD (Dollar)</option>
                                            <option value="EUR">EUR (Euro)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Simpan Pengaturan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Settings -->
                <div class="col-lg-4">
                    <!-- Notifikasi -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Pengaturan Notifikasi</h6>
                        </div>
                        <div class="card-body">
                            <form id="formNotifikasi">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifEmail" checked>
                                    <label class="form-check-label" for="notifEmail">
                                        Notifikasi Email
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifPush" checked>
                                    <label class="form-check-label" for="notifPush">
                                        Push Notification
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifTransaksi" checked>
                                    <label class="form-check-label" for="notifTransaksi">
                                        Notifikasi Transaksi
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifPengguna">
                                    <label class="form-check-label" for="notifPengguna">
                                        Notifikasi Pengguna Baru
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="notifStok" checked>
                                    <label class="form-check-label" for="notifStok">
                                        Peringatan Stok Habis
                                    </label>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i>Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Keamanan -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Keamanan</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label d-block">Two-Factor Authentication</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="twoFactor">
                                    <label class="form-check-label" for="twoFactor">
                                        Aktifkan 2FA
                                    </label>
                                </div>
                                <small class="text-muted">Tingkatkan keamanan akun dengan verifikasi dua langkah</small>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <label class="form-label">Sesi Login Aktif</label>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <i class="fas fa-desktop text-primary me-2"></i>
                                        <small>Chrome - Windows</small>
                                    </div>
                                    <span class="badge bg-success">Aktif</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <i class="fas fa-mobile-alt text-primary me-2"></i>
                                        <small>Mobile - Android</small>
                                    </div>
                                    <button class="btn btn-danger btn-sm">Logout</button>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout Semua Perangkat
                            </button>
                        </div>
                    </div>

                    <!-- Backup & Restore -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Backup & Restore</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small">Backup terakhir: 3 Desember 2024, 14:30 WIB</p>
                            <div class="d-grid gap-2">
                                <button class="btn btn-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Backup Sekarang
                                </button>
                                <button class="btn btn-warning btn-sm">
                                    <i class="fas fa-upload me-1"></i>Restore Data
                                </button>
                                <button class="btn btn-info btn-sm">
                                    <i class="fas fa-history me-1"></i>Riwayat Backup
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Maintenance Mode -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Mode Maintenance</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="maintenanceMode">
                                <label class="form-check-label" for="maintenanceMode">
                                    Aktifkan Mode Maintenance
                                </label>
                            </div>
                            <small class="text-muted">Website akan ditutup sementara untuk pemeliharaan</small>
                            <hr>
                            <button class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-trash me-1"></i>Clear Cache
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
