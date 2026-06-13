<h1>Buat Pengumuman Baru</h1>

<form method="POST" action="{{ route('Pengumuman.store') }}">
    @csrf

    Judul:
    <br>
    <input name="title" required>

    <br><br>

    Konten:
    <br>
    <textarea name="content" rows="8" required></textarea>

    <br><br>

    <label>Tags</label>

    @foreach($tags as $tag)
        <div>
            <input
                type="checkbox"
                name="tags[]"
                value="{{ $tag->id }}">

            {{ $tag->name }}
        </div>
    @endforeach

    <br>

    <button type="submit">Simpan</button>
</form>
