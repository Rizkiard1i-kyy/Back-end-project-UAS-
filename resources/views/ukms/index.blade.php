<h1>Daftar Kehadiran</h1>

<a href="{{ route('kehadiran.create') }}">Buat Data Kehadiran Baru</a>
<br><br>

@if ($kehadiran->isEmpty())
    <p>Belum ada data kehadiran yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 150px">Kode</th>            
            <th style="width: 300px">Mata Kuliah</th>
            <th style="width: 300px">Nama Mahasiswa</th>
            <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kehadiran as $kehadiran)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $kehadiran->kodeMatkul }}</a>
                </td>
                <td>
                    <a> {{ $kehadiran->namaMatkul }}</a>
                </td>
                <td>
                    <a> {{ $kehadiran->namaMahasiswa }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('kehadiran.show', $kehadiran) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>