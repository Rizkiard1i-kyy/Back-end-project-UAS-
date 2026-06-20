<h1>Detail UKM {{ $ukm->nama }}:</h1>

<h2>{{ $ukm->detail }}</h2>

@if(auth()->user()->isAdmin())
    <a href="{{ route('ukm.edit', $ukm) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('ukm.destroy', $ukm) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus UKM ini?')">Hapus Data</button>
    </form>
@endif

<br><br>
<a href="{{ route('ukm.index') }}">Kembali</a>