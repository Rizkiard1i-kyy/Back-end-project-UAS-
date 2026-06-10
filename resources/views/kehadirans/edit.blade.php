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

<br><br>
<a href="{{ route('kehadiran.index') }}">Kembali</a>