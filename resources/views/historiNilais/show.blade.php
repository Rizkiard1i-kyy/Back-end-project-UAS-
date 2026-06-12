<h1>Detail Histori Nilai {{ $historiNilai->mahasiswa->nama }} ({{ $historiNilai->mahasiswa->nim }}) untuk {{ $historiNilai->kode }} {{ $historiNilai->mataKuliah }}:</h1>

<p>Tahun: {{ $historiNilai->tahunAkademik }}</p>
<p>Kode Matakuliah: {{ $historiNilai->kode }}</p>
<p>sks: {{ $historiNilai->sks }}</p>
<p>nilai: {{ $historiNilai->nilai }}</p>
<p>bobot: {{ $historiNilai->bobot }}</p>

@if(auth()->user()->isDosen())
    <br>
    <h3>Ubah Data Histori Nilai</h3>
    <form action="{{ route('historiNilai.update', $historiNilai) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>sks:</label>
            <input type="number" name="sks" value="{{ $historiNilai-> sks }}" required>
        </div>
        <div>
            <label>nilai:</label>
            <select name="nilai" required>
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