<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">
            <img src="{{ asset('images/logo-untar.png') }}" alt="Logo UNTAR">
        </div>
        <h1>Halo! Selamat datang {{ $user->nama }} di Lintar X!</h1>
    </div>
</header>

<div class="container">
    <h1>Dashboard</h1>

    <div class="profile-info">
        <h3>Profil Login</h3>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>NIM:</strong> {{ $user->nim }}</p>
        <p><strong>Status:</strong> {{ $user->role }}</p>
    </div>


    <div class="menu-section">
        <h3 class="section-title">Akademik</h3>
        <div class="bubble-container">
                        <div class="card-item">
                <div class="card-icon bg-red">
                    <img src="{{ asset('images/icons/histori.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Histori Nilai</h4>
                <p class="card-desc">Lihat riwayat nilai seluruh mata kuliah yang sudah ditempuh.</p>
                <a href="{{ route('historiNilai.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-red">
                    <img src="{{ asset('images/icons/jadwal.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Jadwal Kuliah</h4>
                <p class="card-desc">Lihat jadwal mata kuliah, dosen pengajar, ruang, dan link kelas semester ini.</p>
                <a href="{{ route('jadwal.index') }}" class="card-link">Click Here</a>
            </div>

    
            <div class="card-item">
                <div class="card-icon bg-red">
                    <img src="{{ asset('images/icons/kalender.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Kalender Akademik</h4>
                <p class="card-desc">Lihat kegiatan akademik selama semester ini.</p>
                <a href="{{ route('kalenderAkademik.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-gold">
                    <img src="{{ asset('images/icons/ksm.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">KSM</h4>
                <p class="card-desc">Yuk cetak KSM sebelum UAS berjalan!</p>
                <a href="{{ route('ksm.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-gold">
                    <img src="{{ asset('images/icons/kehadiran.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Kehadiran</h4>
                <p class="card-desc">Pantau rekap kehadiran kamu di setiap mata kuliah per minggu.</p>
                <a href="{{ route('kehadiran.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-slate">
                    <img src="{{ asset('images/icons/khs.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Nilai KHS</h4>
                <p class="card-desc">Cek hasil studi dan IP semester kamu secara lengkap.</p>
                <a href="{{ route('nilaiHasil.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>


    <div class="menu-section">
        <h3 class="section-title">Layanan Mahasiswa</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-blue">
                    <img src="{{ asset('images/icons/konsultasi.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Konsultasi Akademik</h4>
                <p class="card-desc">Jadwalkan dan pantau sesi bimbingan dengan dosen penasihat akademik.</p>
                <a href="{{ route('konsultasi.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-blue">
                    <img src="{{ asset('images/icons/surat-keterangan.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Surat Keterangan</h4>
                <p class="card-desc">Dapatkan surat keterangan aktif kuliah atau surat keterangan lainnya dengan cepat.</p>
                <a href="{{ route('surat_keterangan.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-blue">
                    <img src="{{ asset('images/icons/surat-permohonan.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Surat Permohonan</h4>
                <p class="card-desc">Ajukan surat permohonan resmi secara online untuk berbagai keperluan akademik.</p>
                <a href="{{ route('surat_permohonan.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>

    <div class="menu-section">
        <h3 class="section-title">Bahan Ajar</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-green">
                    <img src="{{ asset('images/icons/ukm.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">RPS (Rancangan Program Studi)</h4>
                <p class="card-desc">Dapatkan bahan ajar berkualitas untuk mendukung proses belajar mengajar.</p>
                <a href="{{ route('rps.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>

    <div class="menu-section">
        <h3 class="section-title">Unit Kegiatan Mahasiswa</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-purple">
                    <img src="{{ asset('images/icons/ukm.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">UKM (Unit Kegiatan Mahasiswa)</h4>
                <p class="card-desc">Jelajahi berbagai UKM yang tersedia di kampus dan temukan yang sesuai dengan minatmu.</p>
                <a href="{{ route('ukm.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>

    <div class="menu-section">
        <h3 class="section-title">Uang Kuliah</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-red">
                    <img src="{{ asset('images/icons/uang-kuliah.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Skema Pembayaran</h4>
                <p class="card-desc">Lihat skema pembayaran uang kuliah untuk setiap jenjang studi dan ketahui tenggat waktu pembayaran.</p>
                <a href="{{ route('skema_pembayaran.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-red">
                    <img src="{{ asset('images/icons/tagihan.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Tagihan Pembayaran</h4>
                <p class="card-desc">Cek tagihan pembayaran uang kuliah kamu secara real-time dan pastikan pembayaran tepat waktu.</p>
                <a href="{{ route('tagihan_pembayaran.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>


    <div class="menu-section">
        <h3 class="section-title">SKPI</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-slate">
                    <img src="{{ asset('images/icons/skpi.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">SKPI</h4>
                <p class="card-desc">Yuk isi SKPI kamu, supaya bisa lulus tepat waktu.</p>
                <a href="{{ route('skpi.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>

    <div class="menu-section">
        <h3 class="section-title">Lainnya</h3>
        <div class="bubble-container">
            <div class="card-item">
                <div class="card-icon bg-slate">
                    <img src="{{ asset('images/Ai-Bot.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Chatbot</h4>
                <p class="card-desc">Ajukan pertanyaan kepada chatbot kami untuk mendapatkan bantuan.</p>
                <a href="{{ route('chatbot.index') }}" class="card-link">Click Here</a>
            </div>

            <div class="card-item">
                <div class="card-icon bg-green">
                    <img src="{{ asset('images/icons/feedback.png') }}" alt="" onerror="this.style.display='none'">
                </div>
                <h4 class="card-title">Pengumuman</h4>
                <p class="card-desc">Lihat pengumuman terbaru dari pihak kampus.</p>
                <a href="{{ route('Pengumuman.index') }}" class="card-link">Click Here</a>
            </div>
        </div>
    </div>


@if(auth()->user()->isAdmin())
<div class="menu-section">
    <h3 class="section-title">Admin Panel</h3>
    <div class="bubble-container">
        <div class="card-item">
            <div class="card-icon bg-red">
                <img src="{{ asset('images/icons/admin.png') }}" alt="" onerror="this.style.display='none'">
            </div>
            <h4 class="card-title">Pengelolaan Akun</h4>
            <p class="card-desc">Kelola data pengguna, konten, dan pengaturan aplikasi melalui panel admin.</p>
            <a href="{{ route('pengguna.index') }}" class="card-link">Click Here</a>
        </div>

        <div class="card-item">
            <div class="card-icon bg-red">
                <img src="{{ asset('images/icons/admin.png') }}" alt="" onerror="this.style.display='none'">
            </div>
            <h4 class="card-title">Pengelolahan Matkul</h4>
            <p class="card-desc">Kelola data mata kuliah, jadwal, dan informasi akademik lainnya melalui panel admin.</p>
            <a href="{{ route('mataKuliah.index') }}" class="card-link">Click Here</a>
        </div>
    </div>
</div>
@endif

<form method="POST" action="/logout" style="margin-top: 32px;">   
    @csrf
    <button type="submit" class="btn-logout">
        Logout
    </button>
</form>
</body>
</html>