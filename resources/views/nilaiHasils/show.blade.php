<h1>Detail Nilai KHS {{ $nilaiHasil->mahasiswa->nama }} ({{ $nilaiHasil->mahasiswa->nim }}) untuk {{ $nilaiHasil->mataKuliah->kodeMatkul }} {{ $nilaiHasil->mataKuliah->namaMatkul }} :</h1>

<p>Kode Matkul      : {{ $nilaiHasil->mataKuliah->kodeMatkul }}</p>
<p>Nama Matkul      : {{ $nilaiHasil->mataKuliah->namaMatkul }}</p>
<p>Nama Dosen       : {{ $nilaiHasil->dosen->nama }}</p>
<p>Tahun            : {{ $nilaiHasil->tahunAkademik }}</p>
<p>Status           : {{ $nilaiHasil->status }}</p>
<p>Kredit (SKS)     : {{ $nilaiHasil->mataKuliah->sks }}</p>
<p>Nilai (Huruf)    : {{ $nilaiHasil->nilaiHuruf }}</p>
<p>Nilai (Angka)    : {{ $nilaiHasil->nilaiAngka }}</p>
<p>Bobot kualitas   : {{ $nilaiHasil->bobotKualitas }}</p>

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
                    <a> {{ $nilaiHasil->tugas }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->uts }}</a>
                </td>
                <td>
                    <a> {{ $nilaiHasil->uas }}</a>
                </td>
            </tr>
    </tbody>
</table>
@if(auth()->user()->isDosen())
    <br>
    <h3>Ubah Data Nilai KHS</h3>
    <form action="{{ route('nilaiHasil.update', $nilaiHasil) }}" method="POST">
        @csrf
        @method('PATCH')
        <div>
            <label>Tugas :</label>
            <input type="number" name="tugas" value="{{ $nilaiHasil-> tugas }}" required>
        </div>
        <div>
            <label>UTS :</label>
            <input type="number" name="uts" value="{{ $nilaiHasil-> uts }}" required>
        </div>
        <div>
            <label>UAS :</label>
            <input type="number" name="uas" value="{{ $nilaiHasil-> uas }}" required>
        </div>
        <button type="submit">Simpan Perubahan</button>
    </form>
@endif

@if(auth()->user()->isAdmin())
    <a href="{{ route('nilaiHasil.edit', $nilaiHasil) }}">Ubah Data</a>
    <br><br>
    <form action="{{ route('nilaiHasil.destroy', $nilaiHasil) }}" method="post" style="display:inline;">
        @csrf @method('DELETE')
        <button type="submit" onclick="return confirm('Anda yakin ingin menghapus data nilai KHS ini?')">Hapus Data</button>
    </form>
@endif

<br><br>
<a href="{{ route('nilaiHasil.index') }}">Kembali</a>