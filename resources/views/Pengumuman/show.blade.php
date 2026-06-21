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
        <h1>{{ $Pengumuman->title }}</h1>
    </div>

<p>{!! $Pengumuman->content !!}</p>
<br><br>
<h3>Tag : </h3> 
@forelse($Pengumuman->tags as $tag)
    <span>{{ $tag->name }}</span>@if(!$loop->last), @endif
@empty
    <p>Tidak ada tag.</p>
@endforelse


@auth
    @if(auth()->user()->isAdmin())
        <div class="admin-actions">
            <a href="{{ route('Pengumuman.edit', $Pengumuman) }}" class="btn-edit">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                Ubah
            </a>
        <form action="{{ route('Pengumuman.destroy', $Pengumuman) }}" method="post" style="display:inline;">
            @csrf 
            @method('DELETE')
            <button type="submit" class="btn-delete" onclick="return confirm('Hapus pengumuman ini?')">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                Hapus
            </button>
        </form>
    @endif
@endauth
    </div>
        <div class="form-actions" style="border-top: 1px solid #f1f5f9; padding-top: 24px; margin-top: 32px;">
            <a href="{{ route('Pengumuman.index') }}" class="btn-secondary">Kembali</a>
        </div>
</div>