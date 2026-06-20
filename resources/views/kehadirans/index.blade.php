<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kehadiran</title>
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
        <h1>Daftar Kehadiran</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('kehadiran.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat Data Kehadiran Baru
            </a>
        @endif
    </div>

    @if ($kehadiran->isEmpty())
        <p>Belum ada data kehadiran yang tersimpan.</p>
    @else
        <div class="form-group">
            <form action="{{ route('kehadiran.index') }}" method="GET">
                <select name="filter" id="filter" class="form-control" onchange="this.form.submit()">
                    @foreach($daftarTahun as $tahun)
                        <option value="{{ $tahun }}" {{ $tahunDipilih == $tahun ? 'selected' : '' }}>{{ $tahun }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 20px; text-align: center;">No</th>
                        <th style="text-align: center">Kode</th>            
                        <th>Mata Kuliah</th>
                        @if(!auth()->user()->isMahasiswa())
                        <th>Mahasiswa</th>
                        @endif
                        <th style="width: 120px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kehadiran as $kehadiran)
                        <tr>
                            <td style="text-align: center">{{ $loop->iteration }}</td>
                            <td style="text-align: center">
                                <a> {{ $kehadiran->mataKuliah->kodeMatkul }}</a>
                            </td>
                            <td>
                                <a> {{ $kehadiran->mataKuliah->namaMatkul }}</a>
                            </td>
                            @if(!auth()->user()->isMahasiswa())
                            <td>
                                <a> {{ $kehadiran->mahasiswa->nim }} - {{ $kehadiran->mahasiswa->nama }}</a>
                            </td>
                            @endif
                            <td style="text-align: center">
                                <a href="{{ route('kehadiran.show', $kehadiran) }}" class="btn-action btn-detail">
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