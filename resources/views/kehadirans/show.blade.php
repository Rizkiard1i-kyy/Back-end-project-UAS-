<h1>Detail Kehadiran {{ $kehadiran->mahasiswa->nama }} ({{ $kehadiran->mahasiswa->nim }}) untuk {{ $kehadiran->kodeMatkul }} {{ $kehadiran->namaMatkul }}:</h1>

<p>Nama Dosen: {{ $kehadiran->dosen->nama }}</p>
<p>Semester: {{ $kehadiran->semester }}</p>
<p>Kelas: {{ $kehadiran->kelas }}</p>
<p>Jumlah Pertemuan: {{ $kehadiran->jumlahPertemuan }}</p>
<p>Jumlah Kehadiran: {{ $kehadiran->jumlahKehadiran }}</p>
<p>Persentase: {{ $kehadiran->persentase }}%</p>

@if(auth()->user()->isAdmin() || auth()->user()->isDosen())
    <a href="{{ route('kehadiran.edit', $kehadiran) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('kehadiran.destroy', $kehadiran) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data kehadiran ini?')">Hapus Data</button>
    </form>
@endif
<br><br>
<a href="{{ route('kehadiran.index') }}">Kembali</a>