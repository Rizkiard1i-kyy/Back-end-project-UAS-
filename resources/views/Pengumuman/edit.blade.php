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
        <h1>Ubah Pengumuman</h1>
    </div>
<div class="form-card">    
<form method="POST" action="{{ route('Pengumuman.update', $Pengumuman) }}">
@csrf @method('PUT')

<div class="form-group">
<label>Judul:</label>
<input name="title" value="{{ $Pengumuman->title }}" class="form-control" required>
</div>

<div class="form-group">
<label>Konten:</label>
<textarea name="content" rows="8" class="form-control" required>{{ $Pengumuman->content }}</textarea>
</div>

<div class="form-group">
<label>Tag :</label>
@foreach($tags as $tag)
    <div>
        <input
            type="checkbox"
            name="tags[]"
            value="{{ $tag->id }}"
            {{ $Pengumuman->tags->contains($tag->id) ? 'checked' : '' }}
        >
        {{ $tag->name }}
    </div>
@endforeach
</div>

    <button type="submit" class="btn-primary btn-submit">Simpan</b utton>
</form>
</div>
    <a href="{{ route('Pengumuman.index') }}" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali
    </a>
    </div>
    </body>
    </html>