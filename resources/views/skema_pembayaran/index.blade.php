<!DOCTYPE html>
<html>
<head>
    <title>Skema Pembayaran</title>
</head>
<body>
<div>

    <div>
        Uang Kuliah - Informasi Pilihan Metode Pembayaran BPP SEMESTER GANJIL 2026/2027
    </div>

    <div>
        Halo {{ strtoupper($user->nama) }}-{{ $user->nim }}
    </div>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <div>
        <div>FULL PAYMENT</div>
        <div>
            <div>
                <strong>NO VA BPP bayar FULL :</strong><br>
                18888{{ Auth::user()->nim }}10 Rp.9,000,000 rentang bayar {{ \Carbon\Carbon::parse($rentang['full_mulai'])->translatedFormat('d F') }} s.d. 
                {{ \Carbon\Carbon::parse($rentang['full_batas'])->translatedFormat('d F Y') }}
            </div>
            @if(!$skema)
                <form method="POST" action="{{ route('skema_pembayaran.store') }}">
                    @csrf
                    <input type="hidden" name="jenis_skema" value="FULL PAYMENT">
                    <button type="submit" class="btn-pilih">BAYAR SECARA FULL/PENUH, KLIK DISINI</button>
                </form>
            @else
                <button class="btn-pilih" disabled style="opacity:0.5; cursor:not-allowed;">
                    BAYAR SECARA FULL/PENUH, KLIK DISINI
                </button>
            @endif
        </div>
    </div>

    <div>ATAU</div>

    <div>
        <div>TERMIN</div>
        <div>
            <div>
                <strong>NO VA BPP bayar TERMIN:</strong><br>
                Termin 1: 18888{{ Auth::user()->nim }}11 Rp. 5,535,000 rentang bayar {{ \Carbon\Carbon::parse($rentang['termin1_batas'])->format('d M Y') }}<br>
                Termin 2: 18888{{ Auth::user()->nim }}12 Rp. 3,690,000 rentang bayar {{ \Carbon\Carbon::parse($rentang['termin2_batas'])->format('d M Y') }}<br>
                Total tagihan skema TERMIN: Rp. 9,225,000
            </div>
            @if(!$skema)
                <form method="POST" action="{{ route('skema_pembayaran.store') }}">
                    @csrf
                    <input type="hidden" name="jenis_skema" value="TERMIN">
                    <button type="submit" class="btn-pilih">BAYAR SECARA TERMIN/CICILAN, KLIK DISINI</button>
                </form>
            @else
                <button class="btn-pilih" disabled style="opacity:0.5; cursor:not-allowed;">
                    BAYAR SECARA TERMIN/CICILAN, KLIK DISINI
                </button>
            @endif
        </div>
    </div>

</div>

<br>
<a href="/dashboard"> Kembali ke Dashboard</a>
</body>
</html>