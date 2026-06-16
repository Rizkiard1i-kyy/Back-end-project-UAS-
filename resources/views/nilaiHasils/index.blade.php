<h1>Daftar Nilai KHS</h1>

@if(auth()->user()->isAdmin())
    <a href="{{ route('nilaiHasil.create') }}">Buat Data Nilai KHS Baru</a>
    <br><br>
@endif

<h2>KARTU HASIL STUDI</h2>
<form action="{{ route('nilaiHasil.index') }}" method="GET">
    <label for="tahunAkademik">Tahun akademik :</label>
    
    <select name="tahunAkademik" required>
        <option value="">-- Semua Semester --</option>
        <option value="20251">Gasal 2025</option>
        <option value="20252">Genap 2025</option>
    </select>
    <button type="submit">Cek</button>
</form>

@if ($nilaiHasil->isEmpty())
    <p>Belum ada data nilai KHS yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">No</th>           
            <th style="width: 100px">KODE MK</th>
            <th style="width: 150px">NAMA MATA KULIAH</th>
            <th style="width: 70px">STATUS</th>
            <th style="width: 70px">KREDIT(sks)</th>
            <th style="width: 70px">NILAI(huruf)</th>
            <th style="width: 70px">NILAI(angka)</th>
            <th style="width: 70px">BOBOT KUALITAS(sksN)</th>
            <th style="width: 50px">Ket.</th>
            <th style="width: 50px">Cek</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilaiHasil as $nilaiHasil)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $nilaiHasil->mataKuliah->kodeMatkul }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->mataKuliah->namaMatkul }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->status }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->sks }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->nilaiHuruf }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->bobotKualitas }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->bobotKualitas * $nilaiHasil->sks}}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->keterangan }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('nilaiHasil.show', $nilaiHasil) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@if(!auth()->user()->isAdmin())
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">Jumlah SKS</th>
            <th style="width: 50px">IPS</th>
            <th style="width: 70px">Kredit Diambil</th>
            <th style="width: 50px">Kredit Peroleh</th>
            <th style="width: 50px">IPK</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>
                    <a> {{ $nilaiHasil->sksSemester }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->ips }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->kreditDiambil }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->kreditPeroleh }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->ipk }}</a>
                </td>
            </tr>
    </tbody>
</table>
@endif
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>