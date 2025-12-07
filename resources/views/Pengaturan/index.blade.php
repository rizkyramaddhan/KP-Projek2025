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
                            <div id="alertError" class="alert alert-danger d-none"></div>
                            <form id="formProfil">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ Auth::user()->username }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ Auth::user()->email }}">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Minimal 8 karakter">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            placeholder="Ulangi password baru">
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary" id="btnUpdateProfil">
                                        <i class="fas fa-save me-1"></i>Simpan Perubahan
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

            </div>
        </div>
    </main>

    <script>
        // Form Submit Handler
        // Form Submit Handler
        const formProfil = document.getElementById("formProfil");

        if (formProfil) {
            formProfil.addEventListener("submit", async function(e) {
                e.preventDefault();

                const formData = new FormData(formProfil);

                const alertError = document.getElementById("alertError");
                alertError.classList.add("d-none");
                alertError.innerHTML = "";

                let id = formData.get('user_id');

                try {
                    const response = await fetch(`/pengaturan/${id}`, {
                        method: "POST",
                        body: formData,
                        credentials: 'same-origin',
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
                            "X-HTTP-Method-Override": "PUT"
                        }
                    });

                    // Jika validasi gagal (422)
                    if (response.status === 422) {
                        const errorData = await response.json();
                        let errorMessages = "";

                        Object.keys(errorData.errors).forEach((key) => {
                            errorMessages += `<div>${errorData.errors[key][0]}</div>`;
                        });

                        alertError.innerHTML = errorMessages;
                        alertError.classList.remove("d-none");
                        return;
                    }

                    // Jika sukses
                    const result = await response.json();

                    if (result.success) {
                        alert(result.message);

                        // Reset form
                        formProfil.reset();

                        // Reload halaman
                        location.reload();
                    }

                } catch (error) {
                    alert("Terjadi kesalahan server. Coba lagi.");
                }
            });
        }
    </script>
@endsection
