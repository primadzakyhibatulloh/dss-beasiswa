<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Mahasiswa</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; }
        table, th, td { border: 1px solid black; padding: 8px; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Laporan Peringkat Mahasiswa</h1>
    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Mahasiswa</th>
                <th>Nilai Core Factor</th>
                <th>Nilai Secondary Factor</th>
                <th>Nilai Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankingData as $item)
            <tr>
                <td>{{ $item->ranking }}</td>
                <td>{{ $item->nama_peserta }}</td>
                <td>{{ $item->nilai_core_factor }}</td>
                <td>{{ $item->nilai_secondary_factor }}</td>
                <td>{{ $item->nilai_total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
