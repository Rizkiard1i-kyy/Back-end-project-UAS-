<h1>Buat Data Mata Kuliah Baru</h1>
<form method="POST" action="{{ route('mataKuliah.store') }}">
    @csrf
    Kode Mata Kuliah:
    <br>
    <input name="kodeMatkul" value="{{ old('kodeMatkul') }}" required>
    <br>
    <br>
    Nama Mata Kuliah:
    <br>
    <input name="namaMatkul" value="{{ old('namaMatkul') }}" required>
    <br>
    <br>
    Jumlah SKS:
    <br>
    <input type="number" name="sks" value="{{ old('sks') }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('mataKuliah.index') }}">Kembali</a>