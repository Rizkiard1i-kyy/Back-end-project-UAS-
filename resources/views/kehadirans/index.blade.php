<h1>Daftar Kehadiran</h1>

@if(auth()->user()->isAdmin())
    <a href="{{ route('kehadiran.create') }}">Buat Data Kehadiran Baru</a>
    <br><br>
@endif

@if ($kehadiran->isEmpty())
    <p>Belum ada data kehadiran yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 150px">Kode</th>            
            <th style="width: 300px">Mata Kuliah</th>
            <th style="width: 300px">Mahasiswa</th>
            <th style="width: 120px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kehadiran as $kehadiran)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $kehadiran->mataKuliah->kodeMatkul }}</a>
                </td>
                <td>
                    <a> {{ $kehadiran->mataKuliah->namaMatkul }}</a>
                </td>
                <td>
                    <a> {{ $kehadiran->mahasiswa->nim }} - {{ $kehadiran->mahasiswa->nama }}</a>
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