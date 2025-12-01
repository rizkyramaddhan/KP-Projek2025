@extends('layout.app')

@section('content')
    <div class="container mt-4">
        {{-- Header Section --}}
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-graph-up-arrow text-primary me-2" style="font-size: 2rem;"></i>
                    <div>
                        <h2 class="mb-0">Hasil Perhitungan SPK</h2>
                        <p class="text-muted mb-0">Metode Simple Additive Weighting (SAW)</p>
                    </div>
                </div>
                <p class="mb-0 text-secondary">
                    Tabel berikut menampilkan prioritas barang berdasarkan nilai tertinggi dari perhitungan SAW
                </p>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Statistics Cards --}}
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Total Barang</p>
                                <h3 class="mb-0">{{ count($hasil) }}</h3>
                            </div>
                            <div class="bg-primary bg-opacity-10 p-3 rounded">
                                <i class="bi bi-box-seam text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100 border-start border-success border-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Prioritas Tertinggi</p>
                                <h5 class="mb-0 text-truncate" style="max-width: 180px;">
                                    {{ $hasil[0]['item']->nama_barang ?? '-' }}
                                </h5>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <i class="bi bi-trophy text-success" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-1">Nilai Tertinggi</p>
                                <h3 class="mb-0">{{ number_format($hasil[0]['nilai'] ?? 0, 4) }}</h3>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <i class="bi bi-star-fill text-warning" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ranking Table --}}
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0">
                    <i class="bi bi-list-ol me-2"></i>Peringkat Barang
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center" style="width: 80px;">Peringkat</th>
                                <th>Nama Barang</th>
                                <th class="text-end">Harga (Rp)</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Nilai SAW</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hasil as $i => $h)
                                <tr>
                                    <td class="text-center">
                                        @if ($i == 0)
                                            <span class="badge bg-warning text-dark px-3 py-2">
                                                <i class="bi bi-trophy-fill"></i> #{{ $i + 1 }}
                                            </span>
                                        @elseif($i == 1)
                                            <span class="badge bg-secondary px-3 py-2">
                                                <i class="bi bi-award-fill"></i> #{{ $i + 1 }}
                                            </span>
                                        @elseif($i == 2)
                                            <span class="badge bg-info px-3 py-2">
                                                <i class="bi bi-award"></i> #{{ $i + 1 }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark px-3 py-2">
                                                #{{ $i + 1 }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $h['item']->nama_barang }}</strong>
                                    </td>
                                    <td class="text-end">
                                        {{ number_format($h['item']->harga, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary">{{ $h['item']->qty }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-success px-3 py-2">
                                            {{ number_format($h['nilai'], 4) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($i < 3)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Prioritas
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">Normal</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                        <p class="text-muted mt-2">Tidak ada data perhitungan</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex gap-2 mt-4">
            <a href="{{ route('spk.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-outline-primary">
                <i class="bi bi-printer"></i> Cetak Hasil
            </button>
            <button onclick="exportTable()" class="btn btn-outline-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </button>
        </div>

    </div>

    {{-- Print Styles --}}
    <style>
        @media print {

            .btn,
            .alert {
                display: none !important;
            }

            .card {
                border: 1px solid #dee2e6 !important;
                box-shadow: none !important;
            }
        }
    </style>

    {{-- Export Function (Optional) --}}
    <script>
        function exportTable() {
            alert('Fitur export akan segera tersedia');
            // Implementasi export ke Excel bisa ditambahkan di sini
        }
    </script>
@endsection
