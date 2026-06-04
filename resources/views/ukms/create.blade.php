<h1>Buat Data Kehadiran Baru</h1>
<form method="POST" action="{{ route('historiNilai.store') }}">
    @csrf
    NIM:
    <br>
    <input name="nim" required>
    <br><br>
    TAHUN AKADEMIK:
    <br>
    <input name="tahunAkademik" required>
    <br><br>
    KODE:
    <br>
    <input name="kode" required>
    <br><br>
    MATA KULIAH:
    <br>
    <input name="mataKuliah" required>
    <br><br>
    SKS:
    <br>
    <input type="number" name="sks" required>
    <br><br>
    NILAI:
    <br>
    <input name="nilai" required>
    <br><br>
    BOBOT:
    <br>
    <input type="number" name="bobot" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>