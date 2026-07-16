# PRD (Product Requirements Document)
## SPORT VENUE MANAGEMENT (Sistem Manajemen Lapangan Olahraga)

### 1. Nama Aplikasi
SPORT VENUE MANAGEMENT (Sistem Manajemen Lapangan Olahraga)

### 2. Latar Belakang
Pengelolaan lapangan olahraga saat ini masih banyak dilakukan secara manual, baik dari sisi pencatatan penyewaan, pengelolaan jadwal lapangan, hingga rekapitulasi pembayaran. Hal ini seringkali menyebabkan terjadinya bentrok jadwal, kehilangan data, dan laporan keuangan yang tidak akurat. Oleh karena itu, diperlukan sebuah sistem informasi yang terkomputerisasi untuk mengelola seluruh proses bisnis penyewaan lapangan olahraga secara profesional.

### 3. Permasalahan
- Pencatatan jadwal penyewaan masih manual (buku/kertas), rawan hilang atau rusak.
- Sering terjadi bentrok jadwal akibat kesalahan pencatatan.
- Sulit memonitor ketersediaan lapangan secara *real-time*.
- Rekapitulasi laporan pendapatan dan transaksi sulit dan memakan waktu.
- Manajemen turnamen (peserta, bagan pertandingan) masih dilakukan terpisah atau manual.
- Pelanggan (member) kesulitan melihat ketersediaan lapangan secara langsung.

### 4. Solusi
Membangun aplikasi berbasis web "Sport Venue Management" yang memudahkan pemilik dan staff untuk mengatur data lapangan, jadwal penyewaan, transaksi, serta memungkinkan member (pelanggan) untuk melihat ketersediaan lapangan dan riwayat transaksi mereka sendiri.

### 5. Tujuan Aplikasi
- Mengdigitalisasi proses manajemen penyewaan lapangan olahraga.
- Mengurangi risiko *human error* dalam penjadwalan lapangan.
- Mempermudah penyajian laporan keuangan dan penyewaan lapangan.
- Meningkatkan kualitas layanan pelanggan melalui kemudahan akses informasi.

### 6. Target Pengguna
- **Pemilik (Owner):** Membutuhkan rekapitulasi data dan laporan pendapatan.
- **Staff (Admin/Kasir):** Melakukan input data master, mengelola booking, dan memproses pembayaran.
- **Member (Pelanggan):** Melihat ketersediaan lapangan, informasi booking, dan turnamen.

### 7. Hak Akses Pengguna (Role)
1. **Pemilik:** Memiliki akses ke dashboard statistik lengkap dan seluruh laporan.
2. **Staff:** Memiliki akses ke manajemen master data, transaksi booking, turnamen, dan laporan operasional.
3. **Member:** Memiliki akses ke profil pribadi, riwayat booking, dan informasi lapangan/turnamen (akses terbatas).

### 8. Fitur Utama
- **Autentikasi & Manajemen Pengguna:** Login, kelola profil, dan kelola akun pengguna berdasarkan role.
- **Master Data:** Pengelolaan data Venue, Jenis Lapangan, dan Lapangan.
- **Transaksi:** Manajemen Booking, Pembayaran, dan Penyewaan Peralatan.
- **Manajemen Turnamen:** Pendaftaran turnamen dan kelola peserta.
- **Laporan:** Laporan pendapatan, laporan booking harian/bulanan.

### 9. Struktur Database (Rencana)
- `users`: Menyimpan data pengguna (Pemilik, Staff, Member).
- `venues`: Menyimpan data lokasi/cabang sport venue.
- `court_types`: Menyimpan jenis lapangan (Futsal, Badminton, Basket, dll).
- `courts`: Menyimpan data lapangan beserta tarifnya.
- `bookings`: Menyimpan data jadwal dan status penyewaan.
- `payments`: Menyimpan data transaksi pembayaran booking.
- `equipments`: Menyimpan data peralatan olahraga yang bisa disewa.
- `equipment_rentals`: Menyimpan transaksi sewa peralatan.
- `tournaments`: Menyimpan data turnamen yang diselenggarakan.
- `tournament_participants`: Menyimpan data peserta/tim turnamen.

### 10. Alur Bisnis Aplikasi
1. **Pendaftaran/Login:** Pengguna masuk ke dalam sistem sesuai rolenya.
2. **Persiapan Data Master (Staff):** Staff menginput Venue, Jenis Lapangan, dan data Lapangan yang tersedia.
3. **Proses Booking:** 
   - Member atau Staff melihat ketersediaan lapangan di jadwal.
   - Melakukan pembuatan booking lapangan pada slot waktu yang kosong.
4. **Proses Pembayaran:** Booking yang dibuat harus dibayar (bisa DP atau Lunas). Staff memvalidasi pembayaran.
5. **Sewa Peralatan (Opsional):** Jika diperlukan, pelanggan menyewa peralatan tambahan (bola, raket).
6. **Laporan & Evaluasi:** Pemilik memantau hasil transaksi melalui dashboard dan menu laporan harian/bulanan.

### 11. Rencana Dashboard
Dashboard dirancang dengan antarmuka yang bersih (modern, warna dominan Biru Navy, Putih, Hijau, Abu muda).
Pada tahap awal, dashboard akan menampilkan:
- Pesan selamat datang.
- Jumlah total pengguna.
- Jumlah role pengguna yang terdaftar.
- Profil singkat pengguna yang sedang login.
- Informasi singkat tentang aplikasi.
*(Belum mencakup grafik/chart pada tahap ini)*

### 12. Daftar Modul
- Modul Dashboard
- Modul Master Data (Venue, Jenis Lapangan, Lapangan, Member)
- Modul Transaksi (Booking, Pembayaran, Penyewaan Peralatan)
- Modul Turnamen (Data Turnamen, Peserta Turnamen)
- Modul Laporan
- Modul Pengaturan & Profil

### 13. Kesimpulan
Aplikasi **Sport Venue Management** diharapkan menjadi solusi efektif untuk pengelolaan fasilitas olahraga. Dengan dibangun menggunakan framework Laravel 13 dan antarmuka Bootstrap, aplikasi ini ditargetkan memiliki performa baik, aman, dan mudah digunakan oleh seluruh kelompok pengguna (Pemilik, Staff, dan Member). Tahap awal pengembangan akan difokuskan pada fondasi dasar (role, user management, dan struktur tampilan utama).
