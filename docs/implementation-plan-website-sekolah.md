# Implementation Plan — Website Sekolah (Clone UI: smkn1-cmi.sch.id)

## 1. Hasil Audit Website Acuan

Saya sudah cek langsung ke `https://www.smkn1-cmi.sch.id/`. Temuan penting:

- **Platform asli**: WordPress 7.0.3, tema bergaya *magazine/news portal* — mirip keluarga tema Newspaper/TagDiv/Jnews, dengan mega menu, hero grid berita, dan sidebar tab Terbaru/Populer/Trending.
- **Struktur header**: top-bar tanggal+jam live & ikon sosial → logo+nama+tagline center → **mega menu** 12 item (Beranda, Profil, Kurikulum, Program Sekolah, GTK, Kesiswaan, Sarana Prasarana, Hubungan Industri, Fitur, Inovasi Sekolah, Jurusan, Kontak, Sertifikasi, SPMB) dengan dropdown 2–3 level → bar kedua → bar **Top Tags**.
- **Hero section**: grid berita utama (1 besar + 4 thumbnail kecil) + panel sidebar tab (Terbaru/Populer/Trending) berisi 4 kartu berita kecil.
- **Grid berita**: 2 kolom kartu (gambar, badge kategori multi-tag berwarna, judul, tanggal, excerpt), pagination di bawah (`1 2 … 39`).
- **Sidebar kanan**: Search box, Instagram feed grid, Kalender bulanan interaktif (tanggal ber-link ke arsip post), Kategori (nested, dengan jumlah post), Recent Posts, Recent Comments.
- **Footer**: logo+tagline, sosial media, copyright + credit developer.
- **Konten dinamis**: 382 post "Berita Sekolah", kategori berlapis (Kesiswaan > Prestasi Siswa > per-jurusan), sistem tag.

Kesimpulan: ini portal berita sekolah berbasis CMS. Karena kamu ingin dibangun dengan **Laravel + Tailwind** (custom, bukan WordPress), semua elemen di atas akan direplikasi sebagai **komponen Blade + Tailwind**, dengan data digerakkan oleh model/CRUD Laravel sendiri (bukan plugin CMS).

---

## 2. Arsitektur

Karena **tidak memakai Filament**, admin panel dibangun manual di atas Laravel — bukan generator CRUD instan. Pendekatan:

- **Backend**: Laravel (terbaru), struktur MVC standar + Repository/Service layer untuk modul yang lebih kompleks (PPDB, notifikasi Fonnte).
- **Frontend publik (situs sekolah)**: Blade + Tailwind CSS, disusun sebagai komponen reusable (`<x-card-berita>`, `<x-mega-menu>`, `<x-sidebar-widget>`, dll) agar identik dengan struktur situs acuan.
- **Admin panel (custom, tanpa Filament)**: Blade + Tailwind juga, dengan layout admin terpisah (`resources/views/admin/layouts`), form CRUD dibuat manual per modul (Controller + FormRequest + Blade view), tabel data pakai **Livewire** atau **Alpine.js + fetch/Ajax** untuk interaksi tanpa reload penuh (search, filter, pagination server-side).
- **Auth admin**: Laravel Breeze/Fortify (role-based: Super Admin, Admin Konten, Admin PPDB).
- **Autentikasi & otorisasi**: middleware + `spatie/laravel-permission` untuk role & permission per modul CRUD.
- **Media/Upload**: Laravel Storage (local/S3-compatible) untuk foto berita, dokumen PPDB.
- **Notifikasi WhatsApp**: Service class `FonnteService` yang memanggil Fonnte API via `Http::post()` Laravel, dipicu lewat Event/Listener (bukan langsung di controller) agar mudah di-queue.
- **Queue & job**: Laravel Queue (database/redis driver) untuk kirim notifikasi Fonnte secara async supaya submit form PPDB tetap cepat.
- **Search**: Laravel Scout (opsional) atau query builder biasa dengan index MySQL fulltext untuk search box.

---

## 3. Tech Stack

- **Framework**: Laravel (PHP 8.2+)
- **Frontend styling**: Tailwind CSS (dikonfigurasi custom sesuai warna brand — teal/hijau seperti situs acuan, tipografi, spacing)
- **Interaktivitas ringan**: Alpine.js (dropdown mega menu, tab Terbaru/Populer/Trending, kalender, modal galeri)
- **Interaktivitas admin/data-table dinamis**: Livewire (search, filter, pagination CRUD tanpa reload)
- **Database**: MySQL 8 / MariaDB
- **Auth & Role**: Laravel Breeze (starter kit) + `spatie/laravel-permission`
- **Upload/Media**: Laravel Storage + `spatie/laravel-medialibrary` (untuk galeri foto/video multi-file per post)
- **Editor konten kaya**: TipTap atau Quill.js (WYSIWYG untuk berita/pengumuman) — ringan, tanpa dependency CMS
- **Notifikasi WhatsApp**: Fonnte API (HTTP client Laravel) + Laravel Queue
- **Kalender**: FullCalendar.js (untuk agenda) atau kalender custom Blade+Alpine untuk widget sidebar
- **SEO**: `spatie/laravel-sitemap`, meta tag manual per halaman, schema.org markup untuk artikel berita
- **Cache**: Laravel Cache (Redis) untuk widget sidebar (kategori, recent posts) agar tidak query berulang
- **Testing**: Pest/PHPUnit untuk modul PPDB & notifikasi (kritikal karena menyangkut data pendaftar)
- **Hosting**: VPS dengan Nginx + PHP-FPM + Supervisor (untuk worker queue Fonnte)

---

## 4. Struktur Modul CRUD (Custom Admin Panel, Non-Filament)

Setiap modul di bawah = 1 set: Migration → Model → Policy/Permission → Controller (Resource) → FormRequest validasi → Blade views (index/create/edit) di admin, ditambah halaman publik terkait.

| Modul | CRUD | Field kunci |
|---|---|---|
| Profil Sekolah (sejarah, visi-misi, kepsek, struktur) | ✅ | konten rich text + gambar |
| Guru & Staff | ✅ | nama, NIP, jabatan, foto, mapel |
| Siswa | Opsional | NIS, kelas, jurusan |
| Jurusan / Konsentrasi Keahlian | ✅ | nama, deskripsi, gambar, kaprog |
| Ekstrakurikuler | ✅ | nama, pembina, jadwal, galeri |
| Prestasi | ✅ | judul, tingkat, tanggal, kategori/tag |
| Fasilitas | ✅ | nama, foto, deskripsi |
| Program (Teaching Factory, SPW, dst) | ✅ | nama, deskripsi, dokumen |
| Alumni | ✅ | nama, angkatan, jurusan, testimoni |
| Berita | ✅ | judul, kategori multi, tag, gambar, excerpt, konten |
| Pengumuman | ✅ | judul, lampiran PDF, tanggal berlaku |
| Agenda | ✅ | judul, tanggal event, lokasi |
| Galeri (foto/video) | ✅ | album, media (multi-upload) |
| FAQ | ✅ | pertanyaan, jawaban, kategori |

Kategori & tag dibuat sebagai tabel relasi many-to-many (`categories`, `tags`, pivot table) supaya struktur sidebar "Kategori" (nested) dan "Top Tags" bisa identik dengan situs acuan.

---

## 5. Modul PPDB (fitur utama)

**Alur:**

```
Calon Siswa → Form PPDB (frontend Laravel) → Database (tabel ppdb_pendaftar)
    → Event PendaftarBaru → Listener → FonnteService → WA Admin
    → Admin verifikasi di dashboard (status: pending/diverifikasi/ditolak)
    → Event StatusBerubah → Listener → FonnteService → WA Orang Tua/Siswa
```

**CRUD PPDB:**
- Gelombang PPDB (nama gelombang, tanggal buka-tutup, kuota per jurusan)
- Jurusan tujuan pendaftaran
- Data calon siswa (nama, NISN, asal sekolah, nilai, no HP ortu)
- Upload dokumen (KK, akta, ijazah/rapor — validasi tipe & ukuran file via FormRequest)
- Status pendaftaran (dashboard admin dengan filter status & jurusan, dibangun pakai Livewire table)

**Integrasi Fonnte:**
1. Submit form → simpan ke DB → dispatch `PendaftarBaruEvent` → Listener panggil `FonnteService::send()` ke nomor admin.
2. Admin klik Approve/Reject di dashboard → dispatch `StatusPendaftaranBerubahEvent` → Listener kirim WA ke nomor ortu/siswa.
3. Semua pengiriman dicatat di tabel `notification_logs` (status terkirim/gagal, payload, response API) untuk audit dan retry manual jika gagal.
4. Proses pengiriman dijalankan lewat Laravel Queue (worker via Supervisor) agar tidak memperlambat response form ke user.

---

## 6. Fase Pengerjaan

**Fase 0 — Setup & Fondasi**
Setup project Laravel, konfigurasi Tailwind, struktur folder (components, layouts, admin), setup database & migration dasar, setup auth (Breeze) + role/permission, setup queue & Fonnte credential.

**Fase 1 — Replikasi UI Publik (pixel-perfect)**
Bangun komponen Blade: header top-bar, mega menu (dropdown multi-level via Alpine), hero grid berita + tab Terbaru/Populer/Trending, kartu berita dengan badge kategori multi-warna, sidebar widget (search, IG feed embed, kalender interaktif, kategori nested, recent posts, recent comments), footer. Pastikan responsive penuh (mobile/tablet/desktop) sesuai breakpoint situs acuan.

**Fase 2 — Modul Konten Sekolah (Admin Panel Custom)**
Bangun CRUD manual untuk: Profil Sekolah, Guru & Staff, Jurusan, Ekstrakurikuler, Prestasi, Fasilitas, Program, Alumni, Berita, Pengumuman, Agenda, Galeri, FAQ. Termasuk halaman publik masing-masing modul (listing + detail), sistem kategori/tag, dan integrasi rich text editor untuk konten panjang.

**Fase 3 — PPDB + Integrasi Fonnte**
Form pendaftaran publik, dashboard verifikasi admin (Livewire table dengan filter/search), setup event-listener notifikasi, queue worker, logging notifikasi, testing end-to-end alur pendaftaran sampai notifikasi WA masuk.

**Fase 4 — QA, SEO, Deploy**
Testing lintas device/browser, optimasi performa (cache, lazy load gambar), sitemap & meta SEO, setup Google Analytics/Search Console, deployment ke server production (Nginx, Supervisor untuk queue), training penggunaan admin panel untuk staf sekolah.

---

## 7. Yang Saya Butuhkan dari Kamu untuk Mulai

1. Konfirmasi domain & hosting/VPS (baru atau sudah punya server dengan akses SSH?)
2. Data awal sekolah (logo, profil, daftar jurusan, foto guru, dll) — atau pakai data dummy dulu untuk fase UI?
3. Akun Fonnte (API key + nomor WA admin) untuk fase PPDB
4. Konfirmasi role admin yang dibutuhkan (misal: Super Admin, Admin Berita, Admin PPDB) agar struktur permission dari awal sudah sesuai kebutuhan

Kalau mau, langkah berikutnya saya bisa langsung mulai dari **Fase 1 — bangun komponen UI publik (header, mega menu, hero, sidebar) dalam Blade + Tailwind** sebagai bukti kesesuaian tampilan sebelum lanjut ke modul CRUD dan PPDB.
