<h1>Buat Data Kehadiran Baru</h1>
<form method="POST" action="{{ route('kehadiran.store') }}">
    @csrf
    Kode:
    <br>
    <input name="kodeMatkul" required>
    <br>
    <br>
    Mata Kuliah:
    <br>
    <input name="namaMatkul" required>
    <br>
    <br>
    Semester:
    <br>
    <select name="semester" required>
        <option value="Gasal">Gasal</option>
        <option value="Genap">Genap</option>
    </select>
    <br>
    <br>
    Nama Dosen:
    <br>
    <input name="namaDosen" required>
    <br>
    <br>
    Nama Mahasiswa:
    <br>
    <input name="namaMahasiswa" required>
    <br>
    <br>
    Kelas:
    <br>
    <input name="kelas" required>
    <br>
    <br>
    Jumlah Pertemuan:
    <br>
    <input type="number" name="jumlahPertemuan" required>
    <br>
    <br>
    Jumlah Kehadiran:
    <br>
    <input type="number" name="jumlahKehadiran" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>