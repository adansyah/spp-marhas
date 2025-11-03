@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-gray-900 p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold mb-2">Harga SPP / Bulan</h3>
            <p class="text-3xl font-bold text-indigo-400">Rp 250.000</p>
        </div>
        <div class="bg-gray-900 p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold mb-2">
                Total SPP {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
            </h3>
            <p class="text-3xl font-bold text-emerald-400"> Rp {{ number_format($penghasilanBulanIni, 0, ',', '.') }}</p>
        </div>
        <div class="bg-gray-900 p-6 rounded-2xl shadow-lg">
            <h3 class="text-lg font-semibold mb-2">Siswa Aktif</h3>
            <p class="text-3xl font-bold text-pink-400">{{ $user }}</p>
        </div>
    </div>

    <div class="mt-10 bg-gray-900 p-6 rounded-2xl shadow-lg">
        <h3 class="text-lg font-semibold mb-4">Grafik Pembayaran SPP</h3>
        <canvas id="chartSPP" height="120"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartSPP').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($bulanLabels),
                datasets: [{
                    label: 'Total Pembayaran SPP',
                    data: @json($dataNominal),
                    borderColor: '#6366f1',
                    backgroundColor: 'rgba(99, 102, 241, 0.3)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top', // 🔹 posisi atas
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: '#333',
                color: '#fff',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top', // 🔹 posisi atas
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: '#ff4d4d',
                color: '#fff',
            });
        </script>
    @endif
@endsection
