<h1>Daftar Pengumuman</h1>
@auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('Pengumuman.create') }}">Buat Pengumuman Baru</a>
        <br><br>
    @endif
@endauth

@if ($Pengumuman->isEmpty())
    <p>Belum ada pengumuman yang tersimpan.</p>
@else
<table border="1" cellpadding="5" cellspacing="0">
<thead>
<tr>
<th style="width: 50px">No</th>
<th style="width: 300px">Judul</th>
<th style="width: 200px">Tags</th>
<th style="width: 120px">Aksi</th>
</tr>
</thead>
<tbody>
@foreach($Pengumuman as $item)
<tr>
<td style="text-align: center">{{ $loop->iteration }}</td>
<td>
<a href="{{ route('Pengumuman.show', $item) }}">
{{ $item->title }}
</a>
</td>
<td>
@foreach($item->tags as $tag)
    <span>{{ $tag->name }}</span>@if(!$loop->last), @endif
@endforeach
</td>
<td style="text-align: center">
@auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('Pengumuman.edit', $item) }}">Ubah</a>
        <form action="{{ route('Pengumuman.destroy', $item) }}" method="post" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('Hapus pengumuman ini?')">Hapus</button>
        </form>
    @endif
@endauth
</td>
</tr>
@endforeach
</tbody>
</table>
@endif
<a href="/dashboard">Kembali Ke Dashboard</a>
