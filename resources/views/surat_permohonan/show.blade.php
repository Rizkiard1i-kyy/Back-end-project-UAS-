<h1>Detail Surat Permohonan</h1>

<p><strong>Jenis Surat:</strong> {{ $suratPermohonan->jenis_surat }}</p>

<p><strong>Bahasa:</strong> {{ $suratPermohonan->bahasa }}</p>

<p><strong>Status:</strong> {{ $suratPermohonan->status }}</p>

<p><strong>NIM:</strong> {{ $suratPermohonan->nim }}</p>

<p><strong>Tanggal Pengajuan:</strong>
    {{ \Carbon\Carbon::parse($suratPermohonan->tanggal_pengajuan)->format('d-m-Y H:i') }}
</p>

<a href="{{ route('surat_permohonan.index') }}">
    Kembali ke Daftar Surat
</a>