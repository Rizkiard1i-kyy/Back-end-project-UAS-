<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat KSM Baru</title>
</head>
<body>

<div class="card">
    <div class="card-header">AKADEMIK - BUAT KARTU STUDI MAHASISWA</div>
    <div class="card-body">

        @if ($errors->any())
            <ul class="error" style="margin-bottom:12px; padding-left:16px;">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif

        <form method="POST" action="{{ route('ksm.store') }}">
            @csrf

            <h3>Identitas Mahasiswa</h3>
            <div class="grid-2">
                <div>
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" required>

                    <label>No. Pokok Mahasiswa (NIM)</label>
                    <input type="text" name="nim" value="{{ old('nim') }}" required>

                    <label>Program Studi</label>
                    <input type="text" name="prodi" value="{{ old('prodi') }}" required>
                </div>
                <div>
                    <label>Semester</label>
                    <select name="semester" required>
                        <option value="">-- Pilih --</option>
                        <option value="Genap"  {{ old('semester') === 'Genap'  ? 'selected' : '' }}>Genap</option>
                        <option value="Ganjil" {{ old('semester') === 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                    </select>

                    <label>Tahun Akademik</label>
                    <input type="text" name="tahunAkademik" placeholder="2025 / 2026" value="{{ old('tahunAkademik') }}" required>
                </div>
            </div>

            <h3>Mata Kuliah</h3>

            <table class="mk-table" id="mk-table">
                <thead>
                    <tr>
                        <th style="width:36px">No</th>
                        <th style="width:90px">Kode M.K</th>
                        <th>Nama Mata Kuliah</th>
                        <th style="width:46px">sks</th>
                        <th style="width:50px">Kelas</th>
                        <th style="width:60px">Status</th>
                        <th style="width:50px">Aksi</th>
                    </tr>
                </thead>
                <tbody id="mk-tbody">
                    @if (old('mataKuliahs'))
                        @foreach (old('mataKuliahs') as $i => $mk)
                        <tr>
                            <td style="text-align:center">{{ $i + 1 }}</td>
                            <td><input type="text" name="mataKuliahs[{{ $i }}][kodeMatkul]" value="{{ $mk['kodeMatkul'] ?? '' }}" required></td>
                            <td><input type="text" name="mataKuliahs[{{ $i }}][namaMatkul]" value="{{ $mk['namaMatkul'] ?? '' }}" required></td>
                            <td><input type="number" name="mataKuliahs[{{ $i }}][sks]" value="{{ $mk['sks'] ?? '' }}" min="1" required></td>
                            <td><input type="text" name="mataKuliahs[{{ $i }}][kelas]" value="{{ $mk['kelas'] ?? '' }}" required></td>
                            <td>
                                <select name="mataKuliahs[{{ $i }}][status]" required>
                                    <option value="B"  {{ ($mk['status'] ?? '') === 'B'  ? 'selected' : '' }}>B</option>
                                    <option value="P"  {{ ($mk['status'] ?? '') === 'P'  ? 'selected' : '' }}>P</option>
                                    <option value="U"  {{ ($mk['status'] ?? '') === 'U'  ? 'selected' : '' }}>U</option>
                                </select>
                            </td>
                            <td style="text-align:center"><button type="button" class="btn-del" onclick="removeRow(this)">Hapus</button></td>
                        </tr>
                        @endforeach
                    @else

                        <tr>
                            <td style="text-align:center">1</td>
                            <td><input type="text" name="mataKuliahs[0][kodeMatkul]" required></td>
                            <td><input type="text" name="mataKuliahs[0][namaMatkul]" required></td>
                            <td><input type="number" name="mataKuliahs[0][sks]" min="1" required></td>
                            <td><input type="text" name="mataKuliahs[0][kelas]" required></td>
                            <td>
                                <select name="mataKuliahs[0][status]" required>
                                    <option value="B">B</option>
                                    <option value="U">U</option>
                                </select>
                            </td>
                            <td style="text-align:center"><button type="button" class="btn-del" onclick="removeRow(this)">Hapus</button></td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <button type="button" class="btn-add" onclick="addRow()">+ Tambah Mata Kuliah</button>

            <br>
            <button type="submit" class="btn-submit">Simpan KSM</button>
            &nbsp;
            <a href="{{ route('ksm.index') }}" style="font-size:12px; color:#2d6a9f;">Batal</a>
        </form>
    </div>
</div>

<script>
let rowCount = document.getElementById('mk-tbody').rows.length;

function addRow() {
    const tbody = document.getElementById('mk-tbody');
    const i     = rowCount++;
    const no    = tbody.rows.length + 1;

    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td style="text-align:center">${no}</td>
        <td><input type="text"   name="mataKuliahs[${i}][kodeMatkul]" required></td>
        <td><input type="text"   name="mataKuliahs[${i}][namaMatkul]" required></td>
        <td><input type="number" name="mataKuliahs[${i}][sks]" min="1" required></td>
        <td><input type="text"   name="mataKuliahs[${i}][kelas]" required></td>
        <td>
            <select name="mataKuliahs[${i}][status]" required>
                <option value="B">B</option>
                <option value="U">U</option>
            </select>
        </td>
        <td style="text-align:center"><button type="button" class="btn-del" onclick="removeRow(this)">Hapus</button></td>
    `;
    tbody.appendChild(tr);
    renumberRows();
}

function removeRow(btn) {
    const tbody = document.getElementById('mk-tbody');
    if (tbody.rows.length <= 1) return;
    btn.closest('tr').remove();
    renumberRows();
}

function renumberRows() {
    document.querySelectorAll('#mk-tbody tr').forEach((tr, idx) => {
        tr.cells[0].textContent = idx + 1;
    });
}
</script>
</body>
</html>
