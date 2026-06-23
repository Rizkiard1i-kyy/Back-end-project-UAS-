<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai KHS</title>
    <link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Halo! Selamat datang {{ auth()->user()->nama ?? 'User' }} di Lintar X!</h1>
    </div>
</header>

<div class="container">
    <div class="page-header">
        <h1>Daftar Nilai KHS</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('nilaiHasil.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat Data Nilai KHS Baru
            </a>
        @endif
    </div>

    <div class="form-group">
        <form action="{{ route('nilaiHasil.index') }}" method="GET">
            <label for="tahunAkademik">Tahun akademik :</label>
                    
            <select name="tahunAkademik" required>
                <option value="20251">Gasal 2025</option>
                <option value="20252">Genap 2025</option>
            </select>
            <button type="submit">Cek</button>
        </form>
    </div>

    @if ($nilaiHasil->isEmpty())
        <p>Belum ada data nilai KHS yang tersimpan.</p>
    @else
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        @if(!auth()->user()->isMahasiswa())
                            <th style="width: 50px">NIM</th>
                        @endif        
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
                            @if(!auth()->user()->isMahasiswa())
                                <td>
                                    <a> {{ $nilaiHasil->mahasiswa->nim }}</a>
                                </td>
                            @endif
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
                                <a href="{{ route('nilaiHasil.show', $nilaiHasil) }}" class="btn-action btn-detail">
                                    Detail
                                </a>
                            </td>
                        </tr>
                     @endforeach
                </tbody>
            </table>
        </div>
        @if(auth()->user()->isMahasiswa())
            <div class="table-container">
                <table class="modern-table">
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
                                <a> {{ $nilaiKumulatif->kreditDiambil }}</a>
                            </td>
                            <td>
                                <a> {{ $nilaiKumulatif->kreditPeroleh }}</a>
                            </td>
                            <td>
                                <a> {{ $nilaiKumulatif->ipk }}</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    @endif
    <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>
</div>
</body>
</html>