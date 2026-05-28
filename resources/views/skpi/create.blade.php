<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah SKPI</title>
</head>
<body style="font-family: sans-serif; padding: 20px;">
    <div style="border: 1px solid #ccc; padding: 20px; max-width: 600px; background-color: #f9f9f9;">
        <h3 style="margin-top: 0;">Tambah Data Kegiatan SKPI</h3>

        <form action="{{ route('skpi.store') }}" method="POST">
            @csrf 

            <div style="margin-bottom: 10px;">
                <label>Nama Kegiatan:</label><br>
                <input type="text" name="kegiatan" style="width: 100%; padding: 5px;" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Jenis Kegiatan:</label><br>
                <input type="text" name="jenis" placeholder="Contoh: Penalaran dan Keilmuan" style="width: 100%; padding: 5px;" required>
            </div>

            <div style="margin-bottom: 10px;">
                <label>Klasifikasi (Peran):</label><br>
                <select name="klasifikasi" style="width: 100%; padding: 5px;" required>
                    <option value="Peserta">Peserta</option>
                    <option value="Panitia">Panitia</option>
                    <option value="Ketua Umum">Ketua Umum</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Link Bukti Sertifikat (Google Drive):</label><br>
                <input type="url" name="bukti" style="width: 100%; padding: 5px;" required>
            </div>

            <button type="submit" style="padding: 5px 15px; background: #eee; border: 1px solid #777; cursor: pointer;">Simpan</button>
            <a href="{{ route('skpi.index') }}" style="margin-left: 10px; text-decoration: none; color: red;">Kembali</a>
        </form>
    </div>
</body>
</html>