<x-app-layout>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f9fafb;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            height: 100%;
            width: 220px;
            background: #111827;
            color: white;
            padding-top: 20px;
            transition: transform 0.3s ease-in-out;
            z-index: 1000;
        }
        .sidebar h3 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 18px;
            letter-spacing: 1px;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #d1d5db;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background: #b91c1c;
            color: white;
        }

        /* Toggle Button (mobile) */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 15px; left: 15px;
            background: #b91c1c;
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            z-index: 1100;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 220px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        /* CARD SUMMARY */
        .card-container {
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }
        .summary-card {
            flex: 1 1 220px;
            padding: 20px;
            border-radius: 12px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .summary-card p {
            font-size: 14px;
            margin-bottom: 8px;
            opacity: 0.9;
        }
        .summary-card h4 {
            font-size: 26px;
            font-weight: bold;
        }
        .bg-dark { background: #1f2937; }
        .bg-red { background: #b91c1c; }

        /* TABEL */
        .data-table-container {
            width: 100%;
            overflow-x: auto;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            background: white;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .data-table th,
        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .data-table thead {
            background: #111827;
            color: white;
        }
        .data-table tbody tr:hover {
            background: #f3f4f6;
        }

        /* STATUS */
        .badge {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }
        .badge-success { background: #dcfce7; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }

        /* BUTTONS */
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            border: none;
            cursor: pointer;
            color: white;
        }
        .btn-edit { background: #1f2937; }
        .btn-edit:hover { background: #374151; }
        .btn-delete { background: #b91c1c; }
        .btn-delete:hover { background: #7f1d1d; }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .menu-toggle { display: block; }
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 15px; }
            .card-container { flex-direction: column; }
            .summary-card { width: 100%; }
        }
    </style>

    <!-- Toggle Button -->
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

    <!-- SIDEBAR -->
    <div class="sidebar" id="sidebar">
        <h3>Astra Isuzu</h3>
        <a href="#">Dashboard</a>
        <a href="#">Input Transaksi</a>
        <a href="#">Laporan</a>
        <a href="#">Pengaturan</a>
    </div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- CARD SUMMARY -->
        <div class="card-container">
            <div class="summary-card bg-dark">
                <p>Total Transaksi</p>
                <h4>{{ $totalTransaksi }}</h4>
            </div>
            <div class="summary-card bg-red">
                <p>Belum Bayar</p>
                <h4>{{ $belumBayar }}</h4>
            </div>
            <div class="summary-card bg-dark">
                <p>Pengingat Terkirim</p>
                <h4>{{ $pengingatTerkirim }}</h4>
            </div>
            <div class="summary-card bg-red">
                <p>Sudah Bayar</p>
                <h4>{{ $sudahBayar }}</h4>
            </div>
        </div>

        <!-- TABLE -->
        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Nomor Customer</th>
                        <th>Tanggal_follow up</th>
                        <th style="text-align:center;">Status</th>
                        <th style="text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $transaksi->nama }}</td>
                            <td>{{ $transaksi->nomor_customer }}</td>
                            <td>{{ $transaksi->tanggal_bayar ?? '-' }}</td>
                            <td style="text-align:center;">
                                @if($transaksi->status == 'Sudah Bayar')
                                    <span class="badge badge-success">Sudah Bayar</span>
                                @else
                                    <span class="badge badge-danger">Belum Bayar</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding:20px; text-align:center; color:#6b7280;">
                                Tidak ada data transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }
    </script>
</x-app-layout>
