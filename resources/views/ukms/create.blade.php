<h1>Buat UKM Baru</h1>
<form method="POST" action="{{ route('ukm.store') }}">
    @csrf
    NAMA UKM:
    <br>
    <input name="nama" required>
    <br><br>
    NAMA KETUA:
    <br>
    <select name= "ketua" required>
        <option value = "">-Pilih NIM Mahasiswa-</option>
        @foreach($mahasiswas as $mhs)
            <option value = "{{ $mhs->id }}">{{ $mhs->nim }} - {{ $mhs->nama }}</option>
        @endforeach
    </select>
    <br><br>
    JUMLAH ANGGOTA:
    <br>
    <input type="number" name="anggota" required>
    <br><br>
    DETAIL:
    <br>
    <input name="detail" required>
    <br><br>
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('ukm.index') }}">Kembali</a>