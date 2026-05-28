<h1>Detail Surat Keterangan</h1>

<p><strong>No:</strong> {{ $surat->no }}</p>
<p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
<p><strong>Bahasa:</strong> {{ $surat->bahasa }}</p>
<p><strong>Status:</strong> {{ $surat->status }}</p>

<a href="{{ route('surat_keterangan.index') }}">
    Kembali ke Daftar Surat 
</a>