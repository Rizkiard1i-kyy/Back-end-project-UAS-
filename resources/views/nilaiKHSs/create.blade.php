<h1>Buat Data Nilai KHS Baru</h1>
<form method="POST" action="{{ route('nilaiKHS.store') }}">
    @csrf
    NIM:
    <br>
    <input name="nim" required>
    <br><br>
    TAHUN AKADEMIK:
    <br>
    <input name="tahunAkademik" required>
    <br><br>
    NILAI TUGAS:
    <br>
    <input name="tugas" required>
    <br><br>
    NILAI UTS:
    <br>
    <input name="uts" required>
    <br><br>
    NILAI UAS:
    <br>
    <input name="uas" required>
    <br><br>
    KODE MATA KULIAH:
    <br>
    <input name="kodeMK" required>
    <br><br>
    NAMA MATA KULIAH:
    <br>
    <input name="namaMataKuliah" required>
    <br><br>
    STATUS:
    <br>
    <input name="status" required>
    <br><br>
    SKS:
    <br>
    <input name="sks" required>
    <br><br>
    KETERANGAN:
    <br>
    <input name="keterangan" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('kehadiran.index') }}">Kembali</a>