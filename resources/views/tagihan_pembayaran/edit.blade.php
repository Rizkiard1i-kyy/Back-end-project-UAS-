<html>
<head>
    <title>Edit Tagihan Pembayaran</title>
</head>
<body>

<div>
    <div>
        <h3>Edit Tagihan: {{ $tagihanPembayaran->jenis }}</h3>
        <p>Mahasiswa: {{ $tagihanPembayaran->user->nama ?? 'Tidak diketahui' }} ({{ $tagihanPembayaran->user->nim ?? '-' }})</p>
    </div>

    @if ($errors->any())
        <div>
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('tagihan_pembayaran.update', $tagihanPembayaran->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Tahun Akademik:</label><br>
            <input type="text" name="tahun_akademik" value="{{ old('tahun_akademik', $tagihanPembayaran->tahun_akademik) }}" required>
        </div>

        <div>
            <label>Jenis Tagihan:</label><br>
            <input type="text" name="jenis" value="{{ old('jenis', $tagihanPembayaran->jenis) }}" required>
        </div>

        <div>
            <label>No. Virtual Account:</label><br>
            <input type="text" name="no_virtual_account" value="{{ old('no_virtual_account', $tagihanPembayaran->no_virtual_account) }}" required>
        </div>

        <div>
            <label>Tanggal Batas Bayar:</label><br>
            <input type="date" name="tgl_batas_bayar" value="{{ old('tgl_batas_bayar', $tagihanPembayaran->tgl_batas_bayar ? $tagihanPembayaran->tgl_batas_bayar->format('Y-m-d') : '') }}" required>
        </div>

        <div>
            <label>Jumlah Tagihan (Rp):</label><br>
            <input type="number" name="jumlah_tagihan" value="{{ old('jumlah_tagihan', $tagihanPembayaran->jumlah_tagihan) }}" required>
        </div>

        <div>
            <label>Rincian:</label><br>
            <textarea name="rincian">{{ old('rincian', $tagihanPembayaran->rincian) }}</textarea>
        </div>

        <h4>Catat Pembayaran (Opsional)</h4>

        <div>
            <label>Bank Pembayaran:</label><br>
            <input type="text" name="bank" value="{{ old('bank', $tagihanPembayaran->bank) }}">
        </div>

        <div>
            <label>Tanggal Pembayaran:</label><br>
            <input type="date" name="tgl_pembayaran" value="{{ old('tgl_pembayaran', $tagihanPembayaran->tgl_pembayaran ? $tagihanPembayaran->tgl_pembayaran->format('Y-m-d') : '') }}">
        </div>

        <div>
            <label>Nominal Bayar (Rp):</label><br>
            <input type="number" name="nominal_bayar" value="{{ old('nominal_bayar', $tagihanPembayaran->nominal_bayar) }}">
        </div>

        <div>
            <label>Status:</label><br>
            <select name="status" required>
                <option value="BELUM LUNAS" {{ old('status', $tagihanPembayaran->status) == 'BELUM LUNAS' ? 'selected' : '' }}>BELUM LUNAS</option>
                <option value="LUNAS" {{ old('status', $tagihanPembayaran->status) == 'LUNAS' ? 'selected' : '' }}>LUNAS</option>
            </select>
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>

</div>

<br>
<a href="{{ route('tagihan_pembayaran.index') }}">Kembali ke Daftar Tagihan</a>

</body>
</html>