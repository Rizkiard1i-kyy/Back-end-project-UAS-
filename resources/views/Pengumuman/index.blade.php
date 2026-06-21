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
        <h1>Pengumuman</h1>
    </div>
<main class="container">
        
        <div class="main-grid">
            
                    <section class="results-column">
                
                @if ($Pengumuman->isEmpty())

                    </div>
                @else
                    @foreach($Pengumuman as $item)
                        <article class="soft-bar">
                            
                            <div class="breadcrumb-line">
                                <span class="tag-main">
                                    @if($item->tags->isNotEmpty())
                                        @foreach($item->tags as $tag)
                                            {{ $tag->name }}@if(!$loop->last),@endif
                                            @endforeach
                                             @else
                                        Umum
                                    @endif
                                </span>
                                <span class="arrow">›</span>
                                <span>Pengumuman Penting</span>
                            </div>
                            <h2 class="announcement-title">
                                <a href="{{ route('Pengumuman.show', $item) }}">
                                    {{ $item->title }}
                                </a>
                            </h2>
                            <div class="announcement-snippet">
                                <span class="announcement-date">
                                    {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : date('d M Y') }} -
                                </span>
                                Informasi resmi terkait "{{ $item->title }}". Silakan klik tautan judul di atas untuk membaca detail pengumuman selengkapnya dan mengunduh lampiran yang berkaitan.
                            </div>
                            <div class="tags-wrapper">
                                @foreach($item->tags as $tag)
                                    <span class="tag-badge">#{{ $tag->name }}</span>
                                @endforeach
                            </div>
                            @auth
                                @if(auth()->user()->isAdmin())
                                    <div class="admin-actions">
                                        <a href="{{ route('Pengumuman.edit', $item) }}" class="btn-edit">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                            Ubah
                                        </a>
                                        
                                        <form action="{{ route('Pengumuman.destroy', $item) }}" method="post" style="display:inline;">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Hapus pengumuman ini?')">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </article>
                    @endforeach
                    @if(method_exists($Pengumuman, 'links'))
                        <div class="laravel-pagination-wrapper" style="margin-top: 32px;">
                            {{ $Pengumuman->links() }}
                        </div>
                    @else
                        <div class="clean-pagination">
                        </div>
                    @endif
                @endif
            </section>
            <aside class="sidebar-column">
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="knowledge-panel">
                            <h3 class="kp-header">Panel Administrator</h3>
                            
                            <div class="kp-content">
                                <div class="kp-section">
                                    <a href="{{ route('Pengumuman.create') }}" class="btn-create-announce">
                                        <span class="plus-sign">+</span>
                                        <span>Buat Pengumuman Baru</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endauth
                        </div>
                    </div>
                </div>
            </aside>
            
        </div>
        <div class="container">
        <a href="/dashboard" class="btn-back">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali Ke Dashboard
    </a>    
        </div>
    </main>
</body>
</html>

