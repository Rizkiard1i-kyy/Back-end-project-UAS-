<h1>{{ $Pengumuman->title }}</h1>
<p>{!! $Pengumuman->content !!}</p>

<h5>Tags</h5>
@forelse($Pengumuman->tags as $tag)
    <span>{{ $tag->name }}</span>@if(!$loop->last), @endif
@empty
    <p>Tidak ada tag.</p>
@endforelse

<br><br>
<a href="{{ route('Pengumuman.index') }}">Kembali</a>

@auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('Pengumuman.edit', $Pengumuman) }}">Ubah</a>
        <form action="{{ route('Pengumuman.destroy', $Pengumuman) }}" method="post" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus pengumuman ini?')">Hapus</button>
        </form>
    @endif
@endauth
