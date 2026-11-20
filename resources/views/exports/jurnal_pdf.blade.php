<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekapitulasi Jurnal PKL</title>
    <style>
        body { font-family: sans-serif; font-size: 11pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN REKAPITULASI JURNAL HARIAN PKL</h2>
        <p>PT Metanouva Informatika</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Peserta</th>
                <th>Kategori</th>
                <th>Judul Kegiatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jurnals as $index => $j)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $j->user->name }}</td>
                    <td>{{ $j->kategori?->nama ?? '-' }}</td>
                    <td>{{ $j->judul }}</td>
                    <td>{{ strtoupper($j->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data jurnal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>