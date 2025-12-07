@extends('layout.app')

@section('title', 'Data Gas LPG')

@section('content')
    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Manajemen Log Activity</h1>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total LogActivity
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        {{ $totalLogActivity }}
                                    </div>
                                </div>
                                <div class="card-icon bg-primary-gradient">
                                    <i class="fas fa-clock"></i>
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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar LogActivity</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tableProduk">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="10%">Username</th>
                                    <th width="20%">Activity</th>
                                    <th width="12%">Dibuat Pada</th>
                                    <th width="12%">Diubah Pada</th>
                                </tr>
                            </thead>
                            <tbody id="bodyProduk">
                                @foreach ($logActivities as $activity)
                                    <tr>
                                        <td>{{ $loop->iteration + $logActivities->firstItem() - 1 }}</td>
                                        <td>
                                            {{ $activity->username }}
                                        </td>
                                        <td>{{ $activity->activity }}</td>
                                        <td>{{ $activity->created_at }}</td>
                                        <td>{{ $activity->updated_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-3">
                        <ul class="pagination justify-content-end">
                            {{ $logActivities->links('pagination::bootstrap-5') }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </main>





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
                    const nama = row.cells[1].textContent.toLowerCase();
                    // const kategori = row.cells[3].textContent.toLowerCase();
                    // const status = row.cells[6].textContent.toLowerCase();

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
