<h1>Buat Data Kehadiran Baru</h1>
<form method="POST" action="{{ route('kehadiran.store') }}">
    @csrf
    Mata Kuliah:
    <br>
    <select name="matkul" required>
        <option value = "">-Pilih Mata Kuliah-</option>
        @foreach($matkuls as $matkul)
            <option value = "{{ $matkul->id }}">{{ $matkul->kodeMatkul }} - {{ $matkul->namaMatkul }}</option>
        @endforeach
    </select>
    <br>
    <br>
    Semester:
    <br>
    <select name="semester" required>
        <option value = "">-Pilih Semester-</option>
        <option value="Gasal">Gasal</option>
        <option value="Genap">Genap</option>
    </select>
    <br>
    <br>
    Nama Dosen:
    <br>
    <select name="namaDosen" required>
        <option value = "">-Pilih Dosen-</option>
        @foreach($dosens as $dosen)
            <option value = "{{ $dosen->id }}">{{ $dosen->nama }}</option>
        @endforeach
    </select>   
    <br>
    <br>
    NIM:
    <br>
    <select name="nim" required>
        <option value = "">-Pilih Mahasiswa-</option>
        @foreach($mahasiswas as $mhs)
            <option value = "{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
        @endforeach
    </select>
    <br>
    <br>
    Kelas:
    <br>
    <input name="kelas" value="{{ old('kelas') }}" required>
    <br>
    <br>
    Jumlah Pertemuan:
    <br>
    <input type="number" name="jumlahPertemuan" value="{{ old('jumlahPertemuan') }}" required>
    <br>
    <br>
    Jumlah Kehadiran:
    <br>
    <input type="number" name="jumlahKehadiran" value="{{ old('jumlahKehadiran') }}" required>
    <br>
    <br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('kehadiran.index') }}">Kembali</a>