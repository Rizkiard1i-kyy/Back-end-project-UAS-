<html>
<head>
    <title>Daftar KSM</title>
</head>
<body>

<h1>Daftar KSM</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<a href="{{ route('ksm.create') }}">+ Buat KSM Baru</a>

@if ($ksms->isEmpty())
    <p>Belum ada data KSM.</p>
@else
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Semester</th>
            <th>Tahun Akademik</th>
            <th>Total SKS</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ksms as $ksm)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ksm->nim }}</td>
            <td>{{ $ksm->nama }}</td>
            <td>{{ $ksm->prodi }}</td>
            <td>{{ $ksm->semester }}</td>
            <td>{{ $ksm->tahunAkademik }}</td>
            <td>{{ $ksm->totalSks }}</td>
            <td>
                <a href="{{ route('ksm.show', $ksm) }}">Detail</a>
                <a href="{{ route('ksm.edit', $ksm) }}">Edit</a>
                <form method="POST" action="{{ route('ksm.destroy', $ksm) }}"
                      onsubmit="return confirm('Hapus KSM ini?')">
                    @csrf
                    @method('DELETE')
                    <button>Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<br>
<a class="back" href="/dashboard">← Kembali ke Dashboard</a>

</body>
</html>
