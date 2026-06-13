<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skema Pembayaran</title>
</head>
<body>
    <h1>Skema Pembayaran</h1>
    <a href="{{ route('skema_pembayaran.create') }}">Tambah Skema Pembayaran</a>
    <table>
        <thead>
            <tr>
                <th>Skema</th>
                <th>Jumlah Cicilan</th>
                <th>Jumlah Pembayaran</th>
                <th>Tanggal Jatuh Tempo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skemaPembayaran as $item)
                <tr>
                    <td>{{ $item->namaSkema }}</td>
                    <td>{{ $item->jumlahCicilan }}</td>
                    <td>{{ $item->jumlahPembayaran }}</td>
                    <td>{{ $item->tanggalJatuhTempo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>