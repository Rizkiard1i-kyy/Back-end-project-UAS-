<!DOCTYPE html>
<html>
<head>
<title>manajemen pengguna</title>
<link rel="stylesheet" href="{{ asset('css/aset.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>halo! selamat datang {{ auth()->user()->nama ?? 'admin' }} di lintar x!</h1>
    </div>
</header>

<div class="container">

@if(session('success'))
<p class="badge badge-approved">{{ session('success') }}</p>
@endif

<div class="page-header">
    <h1>manajemen pengguna</h1>
    <a href="{{ route('pengguna.create') }}" class="btn-primary">tambah pengguna</a>
</div>

@if($pengguna->isEmpty())
<p>belum ada pengguna.</p>
@else
<div class="table-container">
<table class="modern-table">
    <thead>
        <tr>
            <th>no</th>
            <th>nama</th>
            <th>email</th>
            <th>nim</th>
            <th>role</th>
            <th>aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengguna as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->nama }}</td>
            <td>{{ $p->email }}</td>
            <td>{{ $p->nim ?? '-' }}</td>
            <td>{{ ucfirst($p->role) }}</td>
            <td>
                <a href="{{ route('pengguna.show', $p) }}" class="btn-action btn-detail">detail</a>
                <a href="{{ route('pengguna.edit', $p) }}" class="btn-action btn-edit">edit</a>
                @if($p->id !== auth()->id())
                <form action="{{ route('pengguna.destroy', $p) }}" method="POST" style="display:inline"
                    onsubmit="return confirm('Hapus pengguna {{ $p->nama }}?')">
                    @csrf @method('DELETE')
                    <button class="btn-action">hapus</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endif

<br>
<a href="/dashboard" class="btn-back">kembali ke dashboard</a>
</div>

</body>
</html>