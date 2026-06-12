<h1>Edit Data RPS</h1>

<form method="POST" action="{{ route('rps.update', $rps->id) }}">
    @csrf @method('PUT')
    Kode Mata Kuliah:
    <br>
    <input name="kode_mk" value="{{ $rps->kode_mk }}" required>
    <br><br>
    Nama Mata Kuliah:
    <br>
    <input name="nama_mk" value="{{ $rps->nama_mk }}" required>
    <br><br>
    SKS:
    <br>
    <input type="number" name="sks" value="{{ $rps->sks }}" required>
    <br><br>
    Link Google Drive (PDF):
    <br>
    <input type="url" name="file_rps" value="{{ $rps->file_rps }}" required>
    <br><br>
    <button type="submit">Simpan Perubahan</button>
    <br><br>
    <a href="{{ route('rps.index') }}">Batal dan Kembali</a>
</form>