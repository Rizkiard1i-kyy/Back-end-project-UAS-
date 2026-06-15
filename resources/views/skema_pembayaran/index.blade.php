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
            <div >
                <strong>NO VA BPP bayar FULL :</strong><br>
                1888853525014610 &nbsp; Rp.9,000,000 &nbsp; rentang bayar 08 Juni s.d. 09 Juli 2026
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
                Termin 1: 1888853525014611 &nbsp; Rp. 5,535,000 &nbsp; rentang bayar 08 Juni s.d. 09 Juli 2026<br>
                Termin 2: 1888853525014612 &nbsp; Rp. 3,690,000 &nbsp; rentang bayar 28 Juli s.d. 23 Agustus 2026<br>
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