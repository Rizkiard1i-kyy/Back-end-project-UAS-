<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mata Kuliah</title>
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
            <h1>Daftar Mata Kuliah</h1>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('mataKuliah.create') }}" class="btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Data Mata Kuliah Baru
                </a>
            @endif
        </div>

        @if ($mataKuliah->isEmpty())
            <p>Belum ada data kalender akademik yang tersimpan.</p>
        @else
              <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">No</th>
                            <th>Kode</th>            
                            <th>Nama</th>
                            <th style="width: 210px; text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mataKuliah as $mataKuliah)
                            <tr>
                                <td style="text-align: center">{{ $loop->iteration }}</td>
                                <td>
                                    <a> {{ $mataKuliah->kodeMatkul }}</a>
                                </td>
                                <td>
                                    <a> {{ $mataKuliah->namaMatkul }}</a>
                                </td>
                                <td style="text-align: center">
                                    <a href="{{ route('mataKuliah.show', $mataKuliah) }}" class="btn-action btn-detail">
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