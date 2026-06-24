<html>
<head>
    <title>Tagihan Pembayaran</title>
</head>
<body>

<div>

    <div>
        @if($user->isAdmin())
            Data Tagihan Pembayaran Seluruh Mahasiswa<br>
            <span>Sebagai admin, kamu bisa melihat tagihan semua mahasiswa dan mengedit tanggal/statusnya.</span>
        @else
            Data Uang Kuliah: {{ strtoupper($user->nama) }} ({{ $user->nim }})<br>
            <span>Lihat tagihan per tahun akademik di bawah ini.</span>
        @endif
    </div>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    
    @if($tagihanGrouped->isEmpty())
        <div>Belum ada data tagihan pembayaran.</div>
    @else
        @foreach($tagihanGrouped as $tahun => $rows)
            <div>Tahun Akademik: <strong>{{ $tahun }}</strong></div>

            <div>
                <table>
                    <thead>
                        <tr>
                            <th  style="width:36px">No</th>
                            @if($user->isAdmin())
                                <th  style="width:160px">Mahasiswa</th>
                            @endif
                            <th  style="width:130px">Jenis</th>
                            <th  style="width:160px">No. Virtual Account</th>
                            <th  style="width:110px">Tgl. Batas Bayar</th>
                            <th  style="width:110px">Jumlah Tagihan</th>
                            <th>Rincian</th>
                            <th>Pembayaran</th>
                            <th  style="width:100px">STATUS</th>
                            @if($user->isAdmin())
                                <th style="width:80px">Aksi</th>
                            @endif
                        </tr>
                        <tr>
                            <th style="width:80px">Bank</th>
                            <th style="width:110px">Tanggal</th>
                            <th style="width:90px">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if($user->isAdmin())
                                <td>
                                    {{ $t->user->nama ?? '-' }}<br>
                                    {{ $t->user->nim ?? '-' }}
                                </td>
                            @endif
                            <td>{{ $t->jenis }}</td>
                            <td>{{ $t->no_virtual_account ?? '-' }}</td>
                            <td>
                                {{ $t->tgl_batas_bayar ? $t->tgl_batas_bayar->format('d M Y') : '-' }}
                            </td>
                            <td>
                                {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}
                            </td>
                            <td>{{ $t->rincian ?? '-' }}</td>
                            <td>{{ $t->bank ?? '-' }}</td>
                            <td>
                                {{ $t->tgl_pembayaran ? $t->tgl_pembayaran->format('d M Y') : '-' }}
                            </td>
                            <td>
                                {{ number_format($t->nominal_bayar, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($t->status == 'LUNAS')
                                    <span>LUNAS</span>
                                @else
                                    <span>
                                        BELUM LUNAS<br>
                                        -{{ number_format($t->jumlah_tagihan - $t->nominal_bayar, 0, ',', '.') }}
                                    </span>
                                @endif
                            </td>
                            @if($user->isAdmin())
                                <td>
                                    <a href="{{ route('tagihan_pembayaran.edit', $t->id) }}">Edit</a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif

</div>

<br>
<a href="{{ route('skema_pembayaran.index') }}">Kembali ke Skema Pembayaran</a>
<a href="/dashboard">Dashboard</a>

</body>
</html>