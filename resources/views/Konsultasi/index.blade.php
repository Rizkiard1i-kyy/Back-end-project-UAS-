<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
        <h1>Konsultasi Akademik</h1>

@if(auth()->user()->isMahasiswa())
    <a href="{{ route('konsultasi.create') }}" class="btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Surat
        </a>
@endif
    </div>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

@if($konsultasi->isEmpty())
    <p>kaga ada data konsultasi.</p>
@else

<div class="table-container">
<table class="modern-table">
    <thead>
        <tr>
            <th style="width: 60px; text-align: center;">no</th>
            @if(auth()->user()->isAdmin()) <th>Mahasiswa</th> @endif
            <th>dosen</th>
            <th>tanggal</th>
            <th>jam</th>
            <th>topik</th>
            <th>status</th>
            <th style="width: 200px;">aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($konsultasi as $k)
        <tr>
            <td style="text-align: center; font-weight: 600; color: #64748b;">{{ $loop->iteration }}</td>
            @if(auth()->user()->isAdmin()) <td>{{ $k->nama_mahasiswa }} ({{ $k->nim }})</td> @endif
            <td style="font-weight: 600; color: #0f172a;">{{$k->nama_dosen }}</td>
            <td>{{$k->tanggal->format('d/m/Y') }}</td>
            <td>{{$k->jam }}</td>
            <td>{{Str::limit($k->topik, 50) }}</td>
            <td >{{ucfirst($k->status) }}</td>
            <td><a href="{{ route('konsultasi.show', $k) }}" class="btn-action btn-detail">detail</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
</div>

<br>
<a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>
</div>

</body>
</html>