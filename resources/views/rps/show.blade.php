<h1>Detail RPS {{ $rps->kode_mk }} - {{ $rps->nama_mk }}</h1>

<p>Fakultas: Fakultas Teknologi Informasi</p>
<p>Jurusan: TEKNIK INFORMATIKA</p>
<p>SKS: {{ $rps->sks }}</p>
<p>Link Google Drive: <a href="{{ $rps->file_rps }}" target="_blank" style="color: blue;">Lihat File PDF</a></p>

<br>
@if(!auth()->user()->isMahasiswa())
<a href="{{ route('rps.edit', $rps->id) }}">Ubah Data</a>
<br><br>

<form action="{{ route('rps.destroy', $rps->id) }}" method="post" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data RPS ini?')">Hapus Data</button>
</form>
<br><br>
@endif

<a href="{{ route('rps.index') }}">Kembali</a>