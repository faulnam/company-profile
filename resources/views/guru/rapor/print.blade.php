<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor - {{ $student->name }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 14px; margin: 20px; line-height: 1.5; }
        h1, h2, h3, h4, h5 { text-align: center; margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
        .header-info { width: 100%; margin-bottom: 20px; border: none; }
        .header-info td { border: none; padding: 4px; }
        .signature-area { width: 100%; margin-top: 50px; border: none; }
        .signature-area td { border: none; text-align: center; width: 33%; vertical-align: top; }
        .signature-space { height: 80px; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; padding: 1cm; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">Cetak Rapor</button>
        <button onclick="window.close()" style="padding: 10px 20px; font-size: 14px; cursor: pointer;">Tutup</button>
    </div>

    <h3>LAPORAN HASIL BELAJAR SISWA</h3>
    <h4>(RAPOR)</h4>

    <hr style="margin-top: 15px; margin-bottom: 15px; border-top: 2px solid #000;">

    <table class="header-info">
        <tr>
            <td width="20%">Nama Siswa</td>
            <td width="2%">:</td>
            <td width="48%"><strong>{{ $student->name }}</strong></td>
            <td width="15%">Kelas</td>
            <td width="2%">:</td>
            <td width="13%">{{ $student->classroom?->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>NIS / NISN</td>
            <td>:</td>
            <td>{{ $student->nis }} / {{ $student->nisn }}</td>
            <td>Tahun Ajaran</td>
            <td>:</td>
            <td>{{ $academicYear?->name ?? '-' }}</td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="40%">Mata Pelajaran</th>
                <th width="15%">KKM</th>
                <th width="15%">Nilai Angka</th>
                <th width="25%">Predikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($grades as $index => $grade)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $grade->subject?->name ?? 'Mata Pelajaran Dihapus' }}</td>
                <td class="text-center">75</td> <!-- Dummy KKM, can be dynamic later -->
                <td class="text-center"><strong>{{ $grade->score }}</strong></td>
                <td class="text-center">
                    @if($grade->score >= 90) A (Sangat Baik)
                    @elseif($grade->score >= 80) B (Baik)
                    @elseif($grade->score >= 75) C (Cukup)
                    @else D (Kurang)
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data nilai untuk tahun ajaran ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <table class="signature-area">
        <tr>
            <td>
                Mengetahui,<br>
                Orang Tua / Wali
                <div class="signature-space"></div>
                ( ......................................... )
            </td>
            <td>
                <br>
                Kepala Sekolah
                <div class="signature-space"></div>
                ( ......................................... )
            </td>
            <td>
                {{ date('d F Y') }}<br>
                Wali Kelas
                <div class="signature-space"></div>
                ( <strong>{{ $student->classroom?->teacher?->name ?? '.........................................' }}</strong> )
            </td>
        </tr>
    </table>
</body>
</html>
