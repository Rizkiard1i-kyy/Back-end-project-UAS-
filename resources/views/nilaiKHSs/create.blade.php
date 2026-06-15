<h1>Buat Data Nilai KHS Baru</h1>
<form method="POST" action="{{ route('nilaiKHS.store') }}">
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
    NAMA MATA KULIAH:
    <br>
    <select name="namaMataKuliah" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($namaMataKuliahs as $namaMataKuliah)
            <option value = "{{ $namaMataKuliah->id }}">{{ $namaMataKuliah->kodeMatkul }} - {{ $namaMataKuliah->namaMatkul }}</option>
        @endforeach
    </select>
    <br><br>
    STATUS:
    <br>
    <input name="status" required>
    <br><br>
    KETERANGAN:
    <br>
    <input name="keterangan" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('nilaiKHS.index') }}">Kembali</a>