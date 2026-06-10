<h1>Detail Surat Keterangan</h1>

<p><strong>Jenis Surat:</strong> {{ $suratKeterangan->jenis_surat }}</p>

<p><strong>Bahasa:</strong> {{ $suratKeterangan->bahasa }}</p>

<p><strong>Status:</strong> {{ $suratKeterangan->status }}</p>

<p><strong>NIM:</strong> {{ $suratKeterangan->nim }}</p>

<p><strong>Tanggal Pengajuan:</strong>
    {{ \Carbon\Carbon::parse($suratKeterangan->tanggal_pengajuan)->format('d-m-Y H:i') }}
</p>

<a href="{{ route('surat_keterangan.index') }}">
    Kembali ke Daftar Surat
</a>