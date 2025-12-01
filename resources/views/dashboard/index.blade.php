@extends('layout.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Dashboard</h1>
        <div class="card mb-4">
            <div class="card-body">
                <h5>Selamat Datang</h5>
                <p>abda login sebagai <strong></strong></p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>Total Log Activity</h6>
                            <h3>{{ \App\Models\LogActivity::count() }}</h3>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>Total User</h6>
                            <h3>{{ \App\Models\user::count() }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>Total barang</h6>
                            <h3>{{ $total_barang }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>Total stock</h6>
                            <h3>{{ $total_barang }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>Barang Stok</h6>
                            <h3>{{ $stok_rendah }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h6>grafik stok barang</h6>
                            <canvas id="stokChart" style="width: 100%; height: 300px;"></canvas>


                        </div>
                    </div>
                </div>
                <div card>
                    <div class="card-body">
                        <h5>barnag Terbaru</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>code Baramg</th>
                                    <th>nama Barang</th>
                                    <th>Harga</th>
                                    <th>qty</th>
                                    <th>jenis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barang_terbaru as $item)
                                    <tr>
                                        <td>{{ $item->code_barang }}</td>
                                        <td>{{ $item->nama_barang }}</td>
                                        <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->jenis }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/app.js'])
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            var ctx = document.getElementById('stokChart').getContext('2d');
            var stokChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chart_labels) !!},
                    datasets: [{
                        label: 'Qty Stok',
                        data: {!! json_encode($chart_data) !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
