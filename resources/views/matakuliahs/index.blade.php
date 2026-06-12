<h1>Daftar Mata Kuliah</h1>

<a href="{{ route('mataKuliah.create') }}">Buat Data Mata Kuliah Baru</a>
<br><br>

@if ($mataKuliah->isEmpty())
    <p>Belum ada data mata kuliah yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 150px">Kode</th>            
            <th style="width: 300px">Nama</th>
            <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($mataKuliah as $mataKuliah)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $mataKuliah->kodeMatkul }}</a>
                </td>
                <td>
                    <a> {{ $mataKuliah->namaMatkul }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('mataKuliah.show', $mataKuliah) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>