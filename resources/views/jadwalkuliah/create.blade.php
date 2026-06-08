<h1>Tambah Jadwal Kuliah Baru</h1>
<form method="POST" action="{{ route('jadwal.store') }}">
    @csrf
    Kode MK:
    <br>
    <input name="kodeMK" required>
    <br>
    <br>
    
    Nama MK:
    <br>
    <input name="namaMK" required>
    <br>
    <br>
    
    SKS:
    <br>
    <input type="number" name="sks" required>
    <br>
    <br>
    
    Kelas:
    <br>
    <input name="kelas" required>
    <br>
    <br>
    
    Dosen Pengajar:
    <br>
    <input name="dosenPengajar" required>
    <br>
    <br>
    
    Ruang & Waktu:
    <br>
    <input name="ruangDanWaktu" required>
    <br>
    <br>
    
    Kode Join Teams:
    <br>
    <input name="kodeMSteams">
    <br>
    <br>
    
    Email Dosen:
    <br>
    <input type="email" name="emailDosen" required>
    <br>
    <br>
    
    <button type="submit">Simpan</button>
</form>

<br><br>
<a href="{{ route('jadwal.index') }}">Kembali</a>