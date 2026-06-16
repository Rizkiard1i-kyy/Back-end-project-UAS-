<h1>Detail Nilai KHS {{ $nilaiKHS->mahasiswa->nama }} ({{ $nilaiKHS->mahasiswa->nim }}) untuk {{ $nilaiKHS->mataKuliah->kodeMatkul }} {{ $nilaiKHS->mataKuliah->namaMatkul }} :</h1>

<p>Kode Matkul      : {{ $nilaiKHS->mataKuliah->kodeMatkul }}</p>
<p>Nama Matkul      : {{ $nilaiKHS->mataKuliah->namaMatkul }}</p>
<p>Nama Dosen       : {{ $nilaiKHS->dosen->nama }}</p>
<p>Tahun            : {{ $nilaiKHS->tahunAkademik }}</p>
<p>Status           : {{ $nilaiKHS->status }}</p>
<p>Kredit (SKS)     : {{ $nilaiKHS->mataKuliah->sks }}</p>
<p>Nilai (Huruf)    : {{ $nilaiKHS->nilaiHuruf }}</p>
<p>Nilai (Angka)    : {{ $nilaiKHS->nilaiAngka }}</p>
<p>Bobot kualitas   : {{ $nilaiKHS->bobotKualitas }}</p>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th style="width: 100px">Tugas</th>
            <th style="width: 100px">UTS</th>
            <th style="width: 100px">UAS</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>
                    <a> {{ $nilaiKHS->tugas }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->UTS }}</a>
                </td>
                <td>
                    <a> {{ $nilaiKHS->UAS }}</a>
                </td>
            </tr>
    </tbody>
</table>
@if(auth()->user()->isDosen())
    <br>
    <h3>Ubah Data Nilai KHS</h3>
    <form action="{{ route('nilaiKHS.update', $nilaiKHS) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>Tugas:</label>
            <input type="number" name="tugas" value="{{ $historiNilai-> bobot }}" required>
        </div>
        <div>
            <label>UTS:</label>
            <input type="number" name="uts" value="{{ $historiNilai-> bobot }}" required>
        </div>
        <div>
            <label>UAS:</label>
            <input type="number" name="uas" value="{{ $historiNilai-> bobot }}" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
@endif

@if(auth()->user()->isAdmin())
    <a href="{{ route('nilaiKHS.edit', $nilaiKHS) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('nilaiKHS.destroy', $nilaiKHS) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data nilai KHS ini?')">Hapus Data</button>
    </form>
@endif

<br><br>
<a href="{{ route('nilaiKHS.index') }}">Kembali</a>