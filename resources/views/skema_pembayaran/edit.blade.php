<html>
<head>
    <title>Edit Skema Pembayaran</title>
</head>
<body>
<div>

    <div>
        <h3>Ubah Tanggal Pembayaran Mahasiswa</h3>
    </div>

        @if ($errors->any())
            <div>
                @foreach ($errors->all() as $e)
                    <div>{{ $e }}</div> @endforeach
            </div>
        @endif

    <div>
        <strong>Data Mahasiswa:</strong><br>
        Nama: {{ strtoupper($skemaPembayaran->mahasiswa->nama) }} <br>
        NIM: {{ $skemaPembayaran->mahasiswa->nim }} <br>
        Skema Dipilih: <strong>{{ $skemaPembayaran->jenis_skema }}</strong>
        <br><span>Jenis skema (TERMIN/FULL PAYMENT) dipilih sendiri oleh mahasiswa dan tidak bisa diubah di sini. Yang bisa diubah hanya tanggal mulai dan tanggal batas/akhir bayarnya.</span>
    </div>

    <br>

    <form method="POST" action="{{ route('skema_pembayaran.update', $skemaPembayaran->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Tanggal Mulai Pembayaran:</label><br>
            <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai', optional($tagihans->first())->tgl_mulai_bayar?->format('Y-m-d')) }}">
        </div>

        <br>

        @if($skemaPembayaran->jenis_skema == 'FULL PAYMENT')
            <div>
                <label>Tanggal Batas/Akhir Bayar (Full Payment):</label><br>
                <input type="date" name="tgl_batas_full" value="{{ old('tgl_batas_full', optional($tagihans->get('BPP (Full Payment)'))->tgl_batas_bayar?->format('Y-m-d')) }}">
            </div>
        @else
            <div>
                <label>Tanggal Batas/Akhir Bayar Termin 1:</label><br>
                <input type="date" name="tgl_batas_termin1" value="{{ old('tgl_batas_termin1', optional($tagihans->get('BPP (Termin 01)'))->tgl_batas_bayar?->format('Y-m-d')) }}">
            </div>

            <div>
                <label>Tanggal Batas/Akhir Bayar Termin 2:</label><br>
                <input type="date" name="tgl_batas_termin2" value="{{ old('tgl_batas_termin2', optional($tagihans->get('BPP (Termin 02)'))->tgl_batas_bayar?->format('Y-m-d')) }}">
            </div>
        @endif

        <br>
        <span>Kosongkan field tanggal jika ingin menggunakan tanggal standar kalender akademik.</span>
        <br><br>
        <button type="submit">Simpan Perubahan & Perbarui Tagihan</button>
    </form>

</div>

<br>
<a href="{{ route('skema_pembayaran.index') }}">Kembali ke Skema Pembayaran</a>

</body>
</html>
