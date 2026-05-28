<!DOCTYPE html>
<html lang="id">
    <h2>Tambah Jadwal Kuliah Baru</h2>

    <form action="{{ route('jadwal.store') }}" method="POST">
        <div style="margin-bottom: 10px;">
            <label>Kode MK:</label><br>
            <input type="text" name="kodeMK" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Nama MK:</label><br>
            <input type="text" name="namaMK" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>SKS:</label><br>
            <input type="number" name="sks" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Kelas:</label><br>
            <input type="text" name="kelas" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Dosen Pengajar:</label><br>
            <input type="text" name="dosenPengajar" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Ruang & Waktu:</label><br>
            <input type="text" name="ruangDanWaktu" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Kode Join Teams :</label><br>
            <input type="text" name="kodeMSteams">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Email Dosen:</label><br>
            <input type="email" name="emailDosen" required>
        </div>

        <button type="submit">Simpan Jadwal</button>
        <button type="submit">Batal</button>
    </form>
</body>
</html>