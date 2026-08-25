# Sistem Informasi Manajemen Sekolah dan Portal Profil Terpadu

Sistem Informasi Manajemen Sekolah dan Portal Profil Terpadu adalah aplikasi berbasis web yang menggabungkan portal informasi profil sekolah modern dan sistem tata kelola akademik institusi pendidikan multi peran. Aplikasi ini dirancang untuk memudahkan manajemen konten sekolah, pendaftaran siswa baru (PPDB) online beserta ujian masuk daring, pengelolaan kurikulum, pencatatan presensi, rekapitulasi nilai, cetak e-rapor, serta pemantauan tagihan SPP bagi orang tua siswa.

---

## Akun Role Asli (Production / Default)

Berikut adalah daftar akun pengguna asli untuk setiap peran sistem:

| Peran | Email | Password |
|---|---|---|
| Super Admin | `admin@sekolah.com` | `qwertyu123` |
| Staf Tata Usaha | `tu@sekolah.com` | `qwertyu123` |
| Wali Kelas / Guru | `guru@sekolah.com` | `qwertyu123` |
| Wali Murid / Orang Tua | `wali@sekolah.com` | `qwertyu123` |

---

## Akun Role Demo (Fitur Auto Delete 3 Menit)

Aplikasi ini dilengkapi dengan akun demo untuk pengujian interaktif setiap peran. Setiap data atau konten baru yang dibuat oleh akun demo akan secara otomatis terhapus dari sistem dalam waktu 3 menit setelah pembuatan.

| Peran Demo | Email Demo | Password Demo | Masa Berlaku Konten |
|---|---|---|---|
| Demo Super Admin | `demo_admin@sekolah.com` | `password` | 3 Menit Otomatis Terhapus |
| Demo Tata Usaha | `demo_tu@sekolah.com` | `password` | 3 Menit Otomatis Terhapus |
| Demo Wali Kelas | `demo_guru@sekolah.com` | `password` | 3 Menit Otomatis Terhapus |
| Demo Wali Murid | `demo_wali@sekolah.com` | `password` | 3 Menit Otomatis Terhapus |

---

## Fitur Utama

- **Portal Profil Publik**: Menampilkan profil sekolah, berita, kategori, halaman statis kustom, informasi jurusan, dan profil GTK (Guru dan Tenaga Kependidikan).
- **PPDB Online Terpadu**: Formulir pendaftaran calon siswa, upload berkas persyaratan, pembayaran formulir pendaftaran, dan modul ujian seleksi tes masuk online.
- **Manajemen Akademik (Tata Usaha)**: Pengelolaan data siswa, data wali murid, rombongan belajar / kelas, mata pelajaran, penjadwalan pelajaran, verifikasi kelulusan PPDB, dan ekspor data ke CSV/PDF.
- **Manajemen Keuangan & SPP**: Penerbitan tagihan biaya pendidikan / SPP, konfirmasi status pembayaran, dan riwayat transaksi keuangan.
- **Portal Guru & Wali Kelas**: Pencatatan jadwal mengajar, penginputan presensi kehadiran siswa, pengisian nilai tugas dan ujian, serta pencetakan lembar e-rapor siswa.
- **Portal Wali Murid**: Akses monitoring jadwal pelajaran anak, rekap kehadiran siswa, riwayat pembayaran tagihan, serta unduh dan cetak e-rapor anak.
- **Sistem Role & Keamanan**: Menggunakan autentikasi Laravel Breeze dan otorisasi berbasis Spatie Laravel Permission.
- **Pembersihan Otomatis Data Demo**: Mekanisme otomatis berbasis event listener dan cron schedule untuk menghapus konten uji coba demo setelah 3 menit.

---

## Teknologi yang Digunakan (Tech Stack)

- **Backend**: PHP 8.3 & Laravel 13
- **Database**: MySQL
- **Autentikasi & Otorisasi**: Laravel Breeze & Spatie Laravel Permission
- **Frontend**: Blade Templating, Tailwind CSS, Alpine.js
- **Build Tool**: Vite
- **Automation**: Laravel Scheduler & Eloquent Event Listeners

---

## Panduan Instalasi & Menjalankan Proyek

1. **Clone repository dan masuk ke direktori proyek**:
   ```bash
   git clone <repository-url>
   cd rekomendasi
   ```

2. **Install dependensi PHP & Node.js**:
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) pada file `.env`.

4. **Jalankan Migrasi dan Seeder**:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Build Asset Frontend & Jalankan Server**:
   ```bash
   npm run build
   php artisan serve
   ```
   Aplikasi siap diakses melalui peramban web di `http://localhost:8000`.
