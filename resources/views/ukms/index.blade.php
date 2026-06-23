<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data UKM</title>
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
        <h1>Daftar UKM</h1>
        @if(auth()->user()->isAdmin())
            <a href="{{ route('ukm.create') }}" class="btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat Data UKM Baru
            </a>
        @endif
    </div>


    @if ($ukm->isEmpty())
        <p>Belum ada UKM yang tersimpan.</p>
    @else
        <div class="table-container">
            <table class="modern-table">
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
                                <a href="{{ route('ukm.show', $ukm) }}" class="btn-action btn-detail">
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