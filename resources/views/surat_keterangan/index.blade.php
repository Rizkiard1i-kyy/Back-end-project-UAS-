<h1>Daftar Surat Keterangan</h1>
<a href="{{ route('surat_keterangan.create') }}">
    Tambah Surat
</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <td> No</td>
        <th>Jenis Surat</th>
        <th>Bahasa</th>
        <th>NIM</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($suratKeterangan as $surat)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $surat->jenis_surat }}</td>
        <td>{{ $surat->bahasa }}</td>
        <td>{{ $surat->nim }}</td>
        <td>{{ $surat->status }}</td>

        <td>

            <a href="{{ route('surat_keterangan.show', $surat->no) }}">
                Detail
            </a>

            @if(auth()->user()->role == 'admin')

                | 

                <a href="{{ route('surat_keterangan.edit', $surat->no) }}">
                    Edit Status
                </a>

            @endif

        </td>
    </tr>
    @endforeach

</table>
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>