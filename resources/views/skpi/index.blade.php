<h1>Daftar SKPI (Penalaran dan Keilmuan)</h1>

<a href="{{ route('skpi.create') }}">Tambah Kegiatan SKPI Baru</a>
<br><br>

@if ($skpis->isEmpty())
    <p>Belum ada data kegiatan SKPI yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 250px">Nama Kegiatan</th>            
            <th style="width: 200px">Jenis</th>
            <th style="width: 150px">Klasifikasi</th>
            <th style="width: 100px">Validasi</th>
            <th style="width: 80px">Poin</th>
            <th style="width: 100px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skpis as $skpi)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>{{ $skpi->kegiatan }}</td>
                <td>{{ $skpi->jenis }}</td>
                <td>{{ $skpi->klasifikasi }}</td>
                <td style="text-align: center">{{ $skpi->validasi }}</td>
                <td style="text-align: center; font-weight: bold;">{{ $skpi->point }}</td>
                <td style="text-align: center">
                    <a href="{{ route('skpi.show', $skpi->id) }}">Detail</a>
                </td>
            </tr>
        @endforeach
        
        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">Total Point Terkumpul (Tervalidasi):</td>
            <td style="text-align: center; font-weight: bold; color: red;">{{ $totalPoint }}</td>
            <td></td>
        </tr>
    </tbody>
</table>
<p style="font-size: 12px; color: #555;">*Poin yang dijumlahkan adalah berdasarkan data yang sudah divalidasi</p>
@endif

<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>