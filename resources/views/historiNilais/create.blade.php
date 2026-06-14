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
    <input name= "tahunAkademik" required>
    <br><br>
    MATA KULIAH:
    <br>
    <select name="namaMataKuliah" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($namaMataKuliahs as $namaMataKuliah)
            <option value = "{{ $namaMataKuliah->id }}">{{ $namaMataKuliah->kodeMatkul }} - {{ $namaMataKuliah->namaMatkul }}</option>
        @endforeach
    </select>
    <br><br>
    BOBOT:
    <br>
    <input type="number" name="bobot" step="0.01" min="0" max="4" required>
    <br><br>
    <button type= "submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('historiNilai.index') }}">Kembali</a>