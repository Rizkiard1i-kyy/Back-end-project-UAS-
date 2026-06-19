<h1>Daftar UKM</h1>

<a href="{{ route('ukm.create') }}">Buat UKM Baru</a>
<br><br>

@if ($ukm->isEmpty())
    <p>Belum ada UKM yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 300px">Nama UKM</th>            
            <th style="width: 150px">Ketua</th>
            <th style="width: 50px">Jumlah Anggota</th>
            <th style="width: 50px">detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ukm as $ukm)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $ukm->nama }}</a>
                </td>
                <td>
                    <a> {{ $ukm->mahasiswa->nama }}</a>
                </td>
                <td>
                    <a> {{ $ukm->anggota }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('ukm.show', $ukm) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>