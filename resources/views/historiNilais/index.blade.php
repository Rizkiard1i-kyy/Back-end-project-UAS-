<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Histori Nilai</title>
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
        <h1>Daftar Histori Nilai</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('historiNilai.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat Data Histori Nilai Baru
            </a>
        @endif
    </div>

    <div class="form-group">
        <form action="{{ route('historiNilai.index') }}" method="GET">
            <label for="tahunAkademik">Tahun akademik :</label>
                    
            <select name="tahunAkademik" required>
                <option value="20251">Gasal 2025</option>
                <option value="20252">Genap 2025</option>
            </select>
            <button type="submit">Cek</button>
        </form>
    </div>

    @if ($historiNilai->isEmpty())
        <p>Belum ada data histori nilai yang tersimpan.</p>
    @else
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 50px">No</th>
                        @if(!auth()->user()->isMahasiswa())
                        <th style="width: 50px">NIM</th>
                        @endif
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
                            @if(!auth()->user()->isMahasiswa())
                            <td>
                                <a> {{ $historiNilai->mahasiswa->nim }}</a>
                            td>
                            @endif
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
                                <a href="{{ route('historiNilai.show', $historiNilai) }}" class="btn-action btn-detail">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>
</div>
</body>
</html>