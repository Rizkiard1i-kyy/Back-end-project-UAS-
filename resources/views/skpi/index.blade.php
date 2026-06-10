<h1>Daftar SKPI (Penalaran dan Keilmuan)</h1>
@if(session('error'))
    <div>
        {{ session('error') }}
    </div>
@endif
@if(session('success'))
    <div>
        {{ session('success') }}
    </div>
@endif
@if(in_array(auth()->user()->role, ['mahasiswa']))
    <a href="{{ route('skpi.create') }}">Tambah Jadwal Kuliah Baru</a>
    <br><br>
@endif
@if ($skpis->isEmpty())
    <p>Belum ada data kegiatan SKPI yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Kegiatan</th>
            <th>Jenis</th>
            <th>Klasifikasi</th>
            <th>Validasi</th>
            <th>Poin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($skpis as $skpi)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $skpi->kegiatan }}</td>
            <td>{{ $skpi->jenis }}</td>
            <td>{{ $skpi->klasifikasi }}</td>
            <td>{{ $skpi->validasi }}</td>
            <td>{{ $skpi->point }}</td>
            <td>
                <a href="{{ route('skpi.show', $skpi->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5">
                <b>Total Point Terkumpul (Tervalidasi)</b>
            </td>
            <td>
                <b>{{ $totalPoint }}</b>
            </td>
            <td></td>
        </tr>
    </tbody>
</table>
<p>*Poin yang dijumlahkan adalah berdasarkan data yang sudah divalidasi</p>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>