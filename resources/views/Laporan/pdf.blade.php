<!DOCTYPE html>
<html>
<head>
    <title>Laporan Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .filter-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Surat</h2>
        <p>{{ now()->format('d M Y') }}</p>
    </div>

    <div class="filter-info">
        @if($jenisSurat)
            <p>Jenis Surat: {{ ucfirst($jenisSurat) }}</p>
        @endif
        @if($tanggalMulai && $tanggalAkhir)
            <p>Periode: {{ $tanggalMulai }} - {{ $tanggalAkhir }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Jenis</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($suratList as $surat)
                <tr>
                    <td>{{ $surat->no_surat }}</td>
                    <td>{{ ucfirst($surat->jenis_surat) }}</td>
                    <td>{{ $surat->pengirim }}</td>
                    <td>{{ $surat->penerima }}</td>
                    <td>{{ $surat->tanggal_surat }}</td>
                    <td>{{ $surat->lastTracking?->status_surat ?? 'Belum ada status' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 