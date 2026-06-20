<!DOCTYPE html>
<html>
<head>
    <title>Tagihan Pembayaran</title>
</head>
<body>

<div>

    <div>
        Data Uang Kuliah: {{ strtoupper($user->nama) }} ({{ $user->nim }})<br>
        <span>Lihat tagihan per tahun akademik di bawah ini.</span>
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
                            <th rowspan="2" style="width:36px">No</th>
                            <th rowspan="2" style="width:130px">Jenis</th>
                            <th rowspan="2" style="width:160px">No. Virtual Account</th>
                            <th rowspan="2" style="width:110px">Tgl. Batas Bayar</th>
                            <th rowspan="2" style="width:110px">Jumlah Tagihan</th>
                            <th rowspan="2">Rincian</th>
                            <th colspan="3">Pembayaran</th>
                            <th rowspan="2" style="width:100px">STATUS</th>
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
                            <td>{{ $t->jenis }}</td>
                            <td>{{ $t->no_virtual_account ?? '-' }}</td>
                            <td>
                                {{ $t->tgl_batas_bayar ? $t->tgl_batas_bayar->format('d F Y') : '-' }}
                            </td>
                            <td>
                                {{ number_format($t->jumlah_tagihan, 0, ',', '.') }}
                            </td>
                            <td>{{ $t->rincian ?? '-' }}</td>
                            <td>{{ $t->bank ?? '-' }}</td>
                            <td>
                                {{ $t->tgl_pembayaran ? $t->tgl_pembayaran->format('d F Y') : '-' }}
                            </td>
                            <td>
                                {{ number_format($t->nominal_bayar, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($t->status === 'LUNAS')
                                    <span>LUNAS</span>
                                @else
                                    <span>
                                        BELUM LUNAS<br>
                                        -{{ number_format($t->jumlah_tagihan - $t->nominal_bayar, 0, ',', '.') }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif

</div>

<br>
<a href="{{ route('skema_pembayaran.index') }}" style="font-size:12px;">Kembali ke Skema Pembayaran</a>
&nbsp;&nbsp;
<a href="/dashboard" style="font-size:12px;">Dashboard</a>

</body>
</html>