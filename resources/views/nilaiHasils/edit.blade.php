<h1>Edit Data Nilai KHS Baru</h1>
<form method="POST" action="{{ route('nilaiHasil.update', $nilaiHasil) }}">
    @csrf @method('PUT')
    NIM:
    <br>
    <select name= "nim" required>
        <option value = "">-Pilih NIM Mahasiswa-</option>
        @foreach($mahasiswas as $mhs)
            <option value = "{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
        @endforeach
    </select>
    <br><br>
    NAMA DOSEN:
    <br>
    <select name="namaDosen" required>
        <option value = "">-Pilih Dosen-</option>
        @foreach($dosens as $dosen)
            <option value = "{{ $dosen->id }}">{{ $dosen->nama }}</option>
        @endforeach
    </select>   
    <br><br>
    TAHUN AKADEMIK:
    <br>
    <select name="tahunAkademik" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        <option value = "20251">Gasal 2025</option>
        <option value = "20252">Genap 2025</option>
     </select>   
    <br><br>
    NAMA MATA KULIAH:
    <br>
    <select name="namaMataKuliah" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($namaMataKuliahs as $namaMataKuliah)
            <option value = "{{ $namaMataKuliah->id }}">{{ $namaMataKuliah->kodeMatkul }} - {{ $namaMataKuliah->namaMatkul }}</option>
        @endforeach
    </select>
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
    STATUS:
    <br>
    <input name="status" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('nilaiHasil.index') }}">Kembali</a>