<h1>Ubah Pengumuman</h1>
<form method="POST" action="{{ route('Pengumuman.update', $Pengumuman) }}">
@csrf @method('PUT')

Judul:
<br>
<input name="title" value="{{ $Pengumuman->title }}" required>
<br><br>

Konten:
<br>
<textarea name="content" rows="8" required>{{ $Pengumuman->content }}</textarea>
<br><br>

<label>Tags</label>
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

<br>
<button type="submit">Simpan</button>
</form>
