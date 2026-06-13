<h1>Buat Data Histori Nilai Baru</h1>
<form method= "POST" action="{{ route('historiNilai.store') }}">
    @csrf
    NIM:
    <br>
    <select name= "nim" required>
        <option value = "">-Pilih NIM Mahasiswa-</option>
        @foreach($mahasiswas as $mhs)
            <option value = "{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
        @endforeach
    </select>
    <br><br>
    TAHUN AKADEMIK:
    <br>
    <input name= "tahunAkademik" required>
    <br><br>
    KODE:
    <br>
    <input name= "kode" required>
    <br><br>
    MATA KULIAH:
    <br>
    <input name= "mataKuliah" required>
    <br><br>
    SKS:
    <br>
    <input type="number" name= "sks" required>
    <br><br>
    NILAI:
    <br>
    <select name= "nilai" required>
        <option value = "">-PILIH NILAI-</option>
        <option value="A">A</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B">B</option>
        <option value="B-">B-</option>
        <option value="C+">C+</option>
        <option value="C">C</option>
        <option value="D">D</option>
        <option value="E">E</option>
        <option value="F">F</option>
    </select>
    <br><br>
    BOBOT:
    <br>
    <input type= "number" name= "bobot" required>
    <br><br>
    <button type= "submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('historiNilai.index') }}">Kembali</a>