<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data PPDB</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        h2 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px;">Cetak / Simpan PDF</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px;">Tutup</button>
    </div>

    <h2>Laporan Data Penerimaan Peserta Didik Baru (PPDB)</h2>
    <p>Dicetak pada: {{ now()->format('d M Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Email Orang Tua</th>
                <th>No. Telepon</th>
                <th>Asal Sekolah</th>
                <th>Rata-rata Nilai</th>
                <th>Status</th>
                <th>Tanggal Pendaftaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse($registrations as $index => $reg)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $reg->name }}</td>
                <td>{{ $reg->parent_email }}</td>
                <td>{{ $reg->phone }}</td>
                <td>{{ $reg->origin_school }}</td>
                <td>{{ $reg->average_grade }}</td>
                <td>{{ $reg->status }}</td>
                <td>{{ $reg->created_at->format('d/m/Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center;">Tidak ada data pendaftaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
