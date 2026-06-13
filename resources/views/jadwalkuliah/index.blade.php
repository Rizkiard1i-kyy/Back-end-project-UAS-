<h1>Daftar Jadwal Kuliah</h1>

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
@if(!auth()->user()->isMahasiswa())
    <a href="{{ route('jadwal.create') }}">Tambah Jadwal Kuliah Baru</a>
    <br><br>
@endif

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode MK</th>
            <th>Nama MK</th>
            <th>SKS</th>
            <th>Kelas</th>
            <th>Dosen Pengajar</th>
            <th>Ruang & Waktu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $jadwal)
        <tr>
            <td>{{ $loop->iteration }}</td> 
            <td>{{ $jadwal->kodeMK }}</td>
            <td>{{ $jadwal->namaMK }}</td>
            <td>{{ $jadwal->sks }}</td>
            <td>{{ $jadwal->kelas }}</td>
            <td>{{ $jadwal->dosenPengajar }}</td>
            <td>{{ $jadwal->ruangDanWaktu }}</td>
            <td>
                <a href="{{ route('jadwal.show', $jadwal->id) }}">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>