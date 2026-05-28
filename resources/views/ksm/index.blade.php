<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar KSM</title>
</head>
<body>

<h1>Daftar KSM</h1>

@if (session('success'))
    <p style="color: green; margin-bottom: 10px;">{{ session('success') }}</p>
@endif

<a class="btn" href="{{ route('ksm.create') }}">+ Buat KSM Baru</a>

@if ($ksms->isEmpty())
    <p class="empty">Belum ada data KSM.</p>
@else
<table>
    <thead>
        <tr>
            <th style="width:36px">No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Semester</th>
            <th>Tahun Akademik</th>
            <th>Total SKS</th>
            <th style="width:110px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ksms as $ksm)
        <tr>
            <td style="text-align:center">{{ $loop->iteration }}</td>
            <td>{{ $ksm->nim }}</td>
            <td>{{ $ksm->nama }}</td>
            <td>{{ $ksm->prodi }}</td>
            <td>{{ $ksm->semester }}</td>
            <td>{{ $ksm->tahunAkademik }}</td>
            <td style="text-align:center">{{ $ksm->totalSks }}</td>
            <td class="action">
                <a href="{{ route('ksm.show', $ksm) }}">Detail</a>
                <a href="{{ route('ksm.edit', $ksm) }}">Edit</a>
                <form method="POST" action="{{ route('ksm.destroy', $ksm) }}" style="display:inline"
                      onsubmit="return confirm('Hapus KSM ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background:none;border:none;color:#c0392b;cursor:pointer;font-size:11px;padding:0">Hapus</button>
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
