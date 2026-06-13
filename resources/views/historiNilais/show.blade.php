<h1>Detail Histori Nilai {{ $historiNilai->mahasiswa->nama }} ({{ $historiNilai->mahasiswa->nim }}) untuk {{ $historiNilai->mataKuliah->kodeMatkul }} {{ $historiNilai->mataKuliah->namaMatkul }}:</h1>

<p>Nama Dosen: {{ $historiNilai->dosen->nama }}</p>
<p>Tahun: {{ $historiNilai->tahunAkademik }}</p>
<p>sks: {{ $historiNilai->mataKuliah->sks }}</p>
<p>nilai: {{ $historiNilai->nilai }}</p>
<p>bobot: {{ $historiNilai->bobot }}</p>

@if(auth()->user()->isDosen())
    <br>
    <h3>Ubah Data Histori Nilai</h3>
    <form action="{{ route('historiNilai.update', $historiNilai) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>bobot:</label>
            <input type="number" name="bobot" step="0.01" min="0" max="4" value="{{ $historiNilai-> bobot }}" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
@endif

@if(auth()->user()->isAdmin())
    <a href="{{ route('historiNilai.edit', $historiNilai) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('historiNilai.destroy', $historiNilai) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data histori nilai ini?')">Hapus Data</button>
    </form>
@endif

<br><br>
<a href="{{ route('historiNilai.index') }}">Kembali</a>