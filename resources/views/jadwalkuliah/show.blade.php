<h1>Detail Jadwal {{ $jadwal->mataKuliah->kodeMatkul }} - {{ $jadwal->mataKuliah->namaMatkul }}:</h1>

<p>Tahun Akademik: {{ $jadwal->tahun_akademik }}</p>
<p>SKS: {{ $jadwal->mataKuliah->sks }}</p>
<p>Kelas: {{ $jadwal->kelas }}</p>
<p>Dosen Pengajar: {{ $jadwal->dosen->nama }}</p>
<p>Ruang & Waktu: {{ $jadwal->ruangDanWaktu }}</p>
<p>Kode Join Teams: {{ $jadwal->kodeMSteams }}</p>
<p>Email Dosen: {{ $jadwal->dosen->email }}</p>

<br>
@if(!auth()->user()->isMahasiswa())
<a href="{{ route('jadwal.edit', $jadwal->id) }}">Ubah Data</a>
<br><br>

<form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="post" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data jadwal ini?')">Hapus Data</button>
</form>
<br><br>
@endif

<a href="{{ route('jadwal.index') }}">Kembali</a>