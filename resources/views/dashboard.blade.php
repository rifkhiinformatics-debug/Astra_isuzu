<x-app-layout>

    <style>
        .card-container {
            display: flex;
            justify-content: center;
            gap: 50px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .summary-card {
            flex: 0 1 200px;
            padding: 20px;
            background-color: white;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .summary-card p {
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 5px;
        }
        .summary-card h4 {
            font-size: 22px;
            font-weight: 700;
            margin-top: 0;
        }

        .data-table-container {
            width: 100%;
            overflow-x: auto;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .data-table th,
        .data-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
        }
        .data-table thead {
            background-color: #3B82F6;
            color: white;
        }

        /* Tombol Aksi */
        .btn-edit {
            background-color: #3B82F6;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            margin-right: 5px;
        }
        .btn-edit:hover {
            background-color: #2563EB;
        }

        .btn-delete {
            background-color: #DC2626;
            color: white;
            padding: 5px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            border: none;
            cursor: pointer;
        }
        .btn-delete:hover {
            background-color: #B91C1C;
        }
    </style>

    <div style="padding: 0 20px;"> 
        
        <!-- CARD SUMMARY -->
        <div class="card-container">
            <div class="summary-card">
                <p>Total Transaksi</p>
                <h4 style="color: #3B82F6;">{{ $totalTransaksi }}</h4>
            </div>

            <div class="summary-card">
                <p>Belum Bayar</p>
                <h4 style="color: #DC3545;">{{ $belumBayar }}</h4>
            </div>
            
            <div class="summary-card">
                <p>Pengingat Terkirim</p>
                <h4 style="color: #FBBF24;">{{ $pengingatTerkirim }}</h4>
            </div>
            
            <div class="summary-card">
                <p>Sudah Bayar</p>
                <h4 style="color: #10B981;">{{ $sudahBayar }}</h4>
            </div>
        </div>

        <!-- TABLE -->
        <div class="data-table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th> 
                        <th style="width: 25%;">Nama</th> 
                        <th style="width: 15%;">Nomor Customer</th>
                        <th style="width: 15%;">Tanggal Bayar</th>
                        <th style="width: 15%; text-align: center;">Status</th>
                        <th style="width: 20%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $transaksi->nama }}</td> 
                            <td>{{ $transaksi->nomor_customer }}</td> 
                            <td>{{ $transaksi->tanggal_bayar ?? '-' }}</td>
                            <td style="text-align: center;">{{ $transaksi->status }}</td>
                            <td style="text-align: center;">
                                
                                <!-- Tombol Edit -->
                                <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="btn-edit">Edit</a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: #718096;">
                                Tidak ada data transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
