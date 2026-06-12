<h1>Detail Mata Kuliah</h1>
<p>Kode Mata Kuliah: {{ $mataKuliah->kodeMatkul }}</p>
<p>Nama Mata Kuliah: {{ $mataKuliah->namaMatkul }}</p>
<p>SKS: {{ $mataKuliah->sks }}</p>

<a href="{{ route('mataKuliah.edit', $mataKuliah) }}">Ubah Data</a>
<br><br>
<form action="{{ route('mataKuliah.destroy', $mataKuliah) }}" method="POST"
    onsubmit="return confirm('Hapus mata kuliah ini?')">
    @csrf @method('DELETE')
    <button>Hapus Data</button>
</form>
<a href="{{ route('mataKuliah.index') }}">Kembali</a>