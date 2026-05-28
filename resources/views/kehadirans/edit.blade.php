<h1>Edit Data Kehadiran</h1>
<form method="POST" action="{{ route('kehadiran.update', $kehadiran) }}">
    @csrf @method('PUT')
    Kode:
    <br>
    <input name="kodeMatkul" value="{{ $kehadiran-> kodeMatkul }}" required>
    <br>
    <br>
    Mata Kuliah:
    <br>
    <input name="namaMatkul" value="{{ $kehadiran-> namaMatkul }}" required>
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
    <input name="namaDosen" value="{{ $kehadiran-> namaDosen }}" required>
    <br>
    <br>
    Nama Mahasiswa:
    <br>
    <input name="namaMahasiswa" value="{{ $kehadiran-> namaMahasiswa }}" required>
    <br>
    <br>
    Kelas:
    <br>
    <input name="kelas" value="{{ $kehadiran-> kelas }}" required>
    <br>
    <br>
    Jumlah Pertemuan:
    <br>
    <input type="number" name="jumlahPertemuan" value="{{ $kehadiran-> jumlahPertemuan }}" required>
    <br>
    <br>
    Jumlah Kehadiran:
    <br>
    <input type="number" name="jumlahKehadiran" value="{{ $kehadiran-> jumlahKehadiran }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>