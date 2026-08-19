#  E-Voting Ketua RT - Sistem Pemilihan Digital

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)

Sebuah sistem informasi *e-voting* modern yang bertujuan untuk mendigitalisasi proses pemilihan umum.

Sistem ini memisahkan hak akses antara **Admin** (Panitia) dan **Device** (Bilik Suara) guna menjaga keamanan, transparansi, dan mencegah manipulasi data.

---

## Fitur Utama

*   **Autentikasi Multi-Peran (Multi-Role)**
    Akses sistem dibagi menjadi `admin` (mengakses panel kendali penuh) dan `device` (hanya dapat mengakses form bilik suara untuk pemilih).
*   **Manajemen Kandidat Dinamis & Auto-WebP**
    Panitia dapat menambah/menghapus kandidat dengan mudah. Sistem secara otomatis akan mengompresi foto kandidat yang diunggah ke dalam format **.webp** menggunakan GD Library untuk menghemat ruang *server* dan mempercepat *loading* halaman.
*   **Dashboard Pemantauan Real-Time**
    Sistem dapat memantau data suara yang masuk, guna memvalidasi voting telah benar tersimpan.
*   **Chart Pemilihan & Privasi Data**
    Persentase hasil pemilihan divisualisasikan dalam bentuk *Pie Chart* interaktif menggunakan Chart.js. Rincian data pemilih disensor menggunakan efek *blur* (*toggle visibility*) untuk menjaga kerahasiaan pilihan warga.
*   **📄 Export to CSV & Reset Sistem**
    Data hasil pemilihan dapat diunduh (Export) ke dalam format CSV/Excel sebagai bukti laporan fisik. Tersedia juga fitur "Reset Suara" untuk membersihkan data agar aplikasi siap digunakan pada periode pemilihan berikutnya.

---

##  Teknologi yang Digunakan

*   **Backend:** PHP 8.x, Laravel 13
*   **Frontend:** Blade Templating, Vanilla CSS, Bootstrap 5
*   **Visualisasi Data:** Chart.js
*   **Ikon:** FontAwesome 6

---

##  Panduan Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda.

### Prasyarat
*   PHP >= 8.1 (Pastikan ekstensi GD Library aktif di `php.ini` untuk fitur WebP)
*   Composer
*   MySQL / MariaDB

### Langkah Instalasi

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/rmdhanw/e-vote.git](https://github.com/rmdhanw/e-vote.git)
   cd e-vote
