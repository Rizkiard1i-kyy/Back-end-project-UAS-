<h1>Tambah Data RPS Baru</h1>

<form method="POST" action="{{ route('rps.store') }}">
    @csrf
    Kode Mata Kuliah:
    <br>
    <input name="kode_mk" required>
    <br>
    <br>
    Nama Mata Kuliah:
    <br>
    <input name="nama_mk" required>
    <br>
    <br>
    SKS:
    <br>
    <input type="number" name="sks" required>
    <br>
    <br>
    Link Google Drive:
    <br>
    <input type="url" name="file_rps" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('rps.index') }}">Kembali</a>