<h1>Daftar Histori Nilai</h1>

@if(auth()->user()->isAdmin())
    <a href="{{ route('historiNilai.create') }}">Buat Data Histori Nilai Baru</a>
    <br><br>
@endif

@if ($historiNilai->isEmpty())
    <p>Belum ada data histori nilai yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>
            <th style="width: 100px">TH.AKAD</th>            
            <th style="width: 100px">KODE</th>
            <th style="width: 150px">MATA KULIAH</th>
            <th style="width: 50px">SKS</th>
            <th style="width: 50px">NILAI</th>
            <th style="width: 50px">BOBOT</th>
            <th style="width: 120px">AKSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach($historiNilai as $historiNilai)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $historiNilai->tahunAkademik }}</a>
                </td>
                <td>
                    <a> {{ $historiNilai->mataKuliah->kodeMatkul }}</a>
                </td>
                <td>
                    <a> {{ $historiNilai->mataKuliah->namaMatkul }}</a>
                </td>
                <td>
                    <a> {{ $historiNilai->mataKuliah->sks }}</a>
                </td>
                <td>
                    <a> {{ $historiNilai->nilai }}</a>
                </td>
                <td>
                    <a> {{ $historiNilai->bobot }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('historiNilai.show', $historiNilai) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>