<h1>Detail Kegiatan SKPI: {{ $skpi->kegiatan }}</h1>

<p>Jenis Kegiatan: {{ $skpi->jenis }}</p>
<p>Klasifikasi (Peran): {{ $skpi->klasifikasi }}</p>

<p>Tanggal Input: {{ \Carbon\Carbon::parse($skpi->tgl_input)->format('d F Y') }}</p>

<p>Status Validasi: {{ $skpi->validasi }}</p>
<p>Poin Didapat: {{ $skpi->point }}</p>
<p>Bukti Sertifikat: <a href="{{ $skpi->bukti }}" target="_blank">Buka Link Google Drive</a></p>

@if(in_array(auth()->user()->role, ['mahasiswa']))
<a href="{{ route('skpi.edit', $skpi->id) }}">Ubah Data</a>
<br><br>

<form action="{{ route('skpi.destroy', $skpi->id) }}" method="post" style="display:inline;">
    @csrf @method('DELETE')
    <button type="submit" onclick="return confirm('Anda yakin ingin menghapus riwayat SKPI ini?')">Hapus Data</button>
</form>
<br><br>
@endif

<a href="{{ route('skpi.index') }}">Kembali</a>