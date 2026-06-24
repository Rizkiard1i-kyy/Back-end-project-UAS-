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

    @if($user->isAdmin())

        <div>Data Skema Pembayaran Mahasiswa yang Sudah Memilih</div>
        <span>Sebagai admin, kamu bisa melihat skema yang dipilih setiap mahasiswa dan mengedit tanggal pembayarannya. Mahasiswa yang belum memilih skema tidak muncul di sini karena belum ada data yang bisa diedit.</span>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Skema Dipilih</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($skemas as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($s->mahasiswa->nama ?? '-') }}</td>
                        <td>{{ $s->mahasiswa->nim ?? '-' }}</td>
                        <td>{{ $s->jenis_skema }}</td>
                        <td>
                            <a href="{{ route('skema_pembayaran.edit', $s->id) }}">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada mahasiswa yang memilih skema pembayaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    @else

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
                        <input name="jenis_skema" value="FULL PAYMENT">
                        <button>BAYAR SECARA FULL/PENUH, KLIK DISINI</button>
                    </form>
                @else
                    <button>
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
                        <input name="jenis_skema" value="TERMIN">
                        <button>BAYAR SECARA TERMIN/CICILAN, KLIK DISINI</button>
                    </form>
                @else
                    <button>
                        BAYAR SECARA TERMIN/CICILAN, KLIK DISINI
                    </button>
                @endif
            </div>
        </div>

    @endif

</div>

<br>
<a href="/dashboard"> Kembali ke Dashboard</a>
</body>
</html>
