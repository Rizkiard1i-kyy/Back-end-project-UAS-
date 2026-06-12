<h1>Detail Kehadiran {{ $kehadiran->mahasiswa->nama }} ({{ $kehadiran->mahasiswa->nim }}) untuk {{ $kehadiran->mataKuliah->kodeMatkul }} {{ $kehadiran->mataKuliah->namaMatkul }}:</h1>

<p>Nama Dosen: {{ $kehadiran->dosen->nama }}</p>
<p>Semester: {{ $kehadiran->semester }}</p>
<p>Kelas: {{ $kehadiran->kelas }}</p>
<p>Jumlah Pertemuan: {{ $kehadiran->jumlahPertemuan }}</p>
<p>Jumlah Kehadiran: {{ $kehadiran->jumlahKehadiran }}</p>
<p>Persentase: {{ $kehadiran->persentase }}%</p>

@if(auth()->user()->isDosen())
    <br>
    <h3>Ubah Data Kehadiran</h3>
    <form action="{{ route('kehadiran.update', $kehadiran) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>Jumlah Pertemuan:</label>
            <input type="number" name="jumlahPertemuan" value="{{ $kehadiran-> jumlahPertemuan }}" required>
        </div>
        <div>
            <label>Jumlah Kehadiran:</label>
            <input type="number" name="jumlahKehadiran" value="{{ $kehadiran-> jumlahKehadiran }}" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
@endif

@if(auth()->user()->isAdmin())
    <a href="{{ route('kehadiran.edit', $kehadiran) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('kehadiran.destroy', $kehadiran) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data kehadiran ini?')">Hapus Data</button>
    </form>
@endif

<br><br>
<a href="{{ route('kehadiran.index') }}">Kembali</a>