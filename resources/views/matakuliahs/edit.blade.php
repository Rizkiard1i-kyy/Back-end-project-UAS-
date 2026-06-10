<h1>Edit Data Mata Kuliah</h1>
<form method="POST" action="{{ route('mataKuliah.update', $mataKuliah) }}">
    @csrf @method('PUT')
    Kode Mata Kuliah:
    <br>
    <input name="kodeMatkul" value="{{ $mataKuliah-> kodeMatkul }}" required>
    <br>
    <br>
    Nama Mata Kuliah:
    <br>
    <input name="namaMatkul" value="{{ $mataKuliah-> namaMatkul }}" required>
    <br>
    <br>
    Jumlah SKS:
    <br>
    <input type="number" name="sks" value="{{ $mataKuliah-> sks }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('mataKuliah.index') }}">Kembali</a>