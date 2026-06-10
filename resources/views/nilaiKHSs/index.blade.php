<h1>Daftar Nilai KHS</h1>

<h2>KARTU HASIL STUDI</h2>

@if(auth()->user()->isAdmin())
    <a href="{{ route('nilaiKHS.create') }}">Buat Data Nilai KHS Baru</a>
    <br><br>
@endif

@if ($nilaiKHS->isEmpty())
    <p>Belum ada data nilai KHS yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 50px">Cek</th>
            <th style="width: 50px">No</th>           
            <th style="width: 100px">KODE MK</th>
            <th style="width: 150px">NAMA MATA KULIAH</th>
            <th style="width: 70px">STATUS</th>
            <th style="width: 70px">KREDIT(sks)</th>
            <th style="width: 70px">NILAI(huruf)</th>
            <th style="width: 70px">NILAI(angka)</th>
            <th style="width: 70px">BOBOT KUALITAS(sksN)</th>
            <th style="width: 50px">Ket.</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nilaiKHS as $nilaiKHS)
            <tr>
                <td style="text-align: center">{{ $loop->iteration }}</td>
                <td>
                    <a> {{ $nilaiKHS->kodeMK }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->namaMataKuliah }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->status }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->sks }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->nilaiHuruf }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->nilaiAngka }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->bobotKualitas }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->keterangan }}</a>
                </td>
                <td style="text-align: center">
                    <a href="{{ route('nilaiKHS.show', $nilaiKHS) }}">Detail</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</table>
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
                    <a> {{ $nilaiKHS->jumlahSKS }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->ips }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->kreditDiambil }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->kreditPeroleh }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->ipk }}</a>
                </td>
            </tr>
    </tbody>
</table>
@endif
<br><br>
<a href="/dashboard">Kembali Ke Dashboard</a>