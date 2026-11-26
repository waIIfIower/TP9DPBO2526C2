# Janji
Saya Muhammad Dzaka Indrianto dengan NIM 2508755 mengerjakan Tugas Praktikum 9 pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

# Proyek MVP - Manajemen Data Rekrutmen & HR

Proyek ini adalah implementasi aplikasi web berbasis PHP Native yang menggunakan arsitektur **Model-View-Presenter (MVP)** dengan pendekatan **Strict Passive View**. Proyek ini mengelola data rekrutmen HR yang mencakup data **Kandidat** dan data **Lowongan**.

## Arsitektur Program (MVP)

Program ini memisahkan logika aplikasi menjadi tiga komponen utama untuk menjaga kode tetap rapi, terstruktur, dan mudah dikembangkan (*Separation of Concerns*).

1. **Model (`models/`)**:
   - Bertanggung jawab mengelola data dan berinteraksi langsung dengan database (MySQL) menggunakan PDO *prepared statement*.
   - Mengimplementasikan interface `KontrakModel` dan `KontrakModelLowongan`.
   - Contoh: `TabelKandidat.php` dan `TabelLowongan.php`.

2. **View (`views/`)**:
   - Bertanggung jawab menampilkan antarmuka pengguna (HTML) kepada user dengan konsep **Strict Passive View** (tidak memiliki perulangan `foreach`, fungsi `count()`, maupun referensi langsung ke Model/Entity).
   - Mengimplementasikan interface `KontrakView` dan `KontrakViewLowongan`.
   - Contoh: `ViewKandidat.php` dan `ViewLowongan.php`.

3. **Presenter (`presenters/`)**:
   - Bertindak sebagai perantara (jembatan) antara View dan Model.
   - Menerima input dari View (melalui `index.php`), memproses logika bisnis, meminta data ke Model, merakit baris tabel HTML (`<tr>...</tr>`), dan menyerahkannya kembali ke View.
   - Mengimplementasikan interface `KontrakPresenter` dan `KontrakPresenterLowongan`.

### Alur Program

1. **Request**: User membuka `index.php`.
2. **Routing**: `index.php` mengecek parameter `modul` (`kandidat` atau `lowongan`), `screen` (`list`, `add`, atau `edit`), serta aksi `POST` (`tambah`, `ubah`, atau `hapus`).
3. **Inisialisasi**: `index.php` membuat objek Model, View, dan Presenter yang sesuai.
4. **Proses**:
   - Presenter meminta data ke Model (`getAllKandidat()` atau `getAllLowongan()`).
   - Model melakukan query ke Database.
   - Model memetakan hasil query menjadi list objek Entity (`Kandidat` atau `Lowongan`) dan mengembalikannya ke Presenter.
   - Presenter mengolah list objek Entity menjadi potongan baris tabel HTML dan menghitung total data.
   - Presenter menyerahkan string HTML siap tampil ke View.
5. **Response**: View merender HTML (menggunakan template `skin.html` / `skin_lowongan.html` dan `form.html` / `form_lowongan.html`) dan menampilkannya ke user.

<<<<<<< HEAD
=======
Untuk form Edit, Presenter mengambil data berdasarkan ID dan meneruskan nilainya ke View. Saat form dikirim, `index.php` meneruskan aksi POST ke Presenter. Presenter memvalidasi input dan memanggil Model. Setelah aksi selesai, `index.php` mengarahkan browser kembali ke daftar.

>>>>>>> a3b1fd1 (initial commit)
## Struktur Folder

```text
TP9DPBO2526C2/
├── project/
│   ├── models/
│   │   ├── DB.php
│   │   ├── Kandidat.php
│   │   ├── KontrakModel.php
│   │   ├── TabelKandidat.php
│   │   ├── Lowongan.php
│   │   ├── KontrakModelLowongan.php
│   │   └── TabelLowongan.php
│   │
│   ├── views/
│   │   ├── KontrakView.php
│   │   ├── ViewKandidat.php
│   │   ├── KontrakViewLowongan.php
│   │   └── ViewLowongan.php
│   │
│   ├── presenters/
│   │   ├── KontrakPresenter.php
│   │   ├── PresenterKandidat.php
│   │   ├── KontrakPresenterLowongan.php
│   │   └── PresenterLowongan.php
│   │
│   ├── template/
│   │   ├── skin.html
│   │   ├── form.html
│   │   ├── skin_lowongan.html
│   │   └── form_lowongan.html
│   │
│   └── index.php
│
├── dokumentasi/
<<<<<<< HEAD
│   └── Record.mp4
│
├── mvp_db.sql
└── README.md
=======
│   ├── demo-crud.mp4
│   └── PANDUAN_SCREENRECORD.md
│
├── mvp_db.sql
└── README.md
```

## Cara Menjalankan

1. Jalankan MySQL atau MariaDB. Gunakan PHP 7.4 atau lebih baru dengan ekstensi `pdo_mysql`.
2. Impor [mvp_db.sql](mvp_db.sql) dari root repo pada instalasi baru. Dump ini membuat database `mvp_kandidat_db`, tabel `kandidat` dan `lowongan`, serta data contoh.
3. Sesuaikan koneksi di [`project/models/DB.php`](project/models/DB.php) jika perlu. Pengaturan awal menggunakan host `localhost`, pengguna `root`, dan kata sandi kosong.
4. Dari root repo, jalankan `php -S localhost:8000 -t project` dan buka `http://localhost:8000/`. Jika menggunakan Apache, salin isi `project/` ke direktori situs dan buka URL direktori tersebut.

## Dokumentasi Screenrecord

[Video demo CRUD Kandidat dan Lowongan](dokumentasi/demo-crud.mp4) berdurasi 48 detik. Bagian Kandidat dimulai pada `00:00` dan bagian Lowongan pada `00:24`. Tiap bagian menunjukkan daftar, form tambah, form edit yang terisi data lama, serta hasil penyimpanan dan penghapusan.

Demo direkam dari aplikasi yang berjalan dengan PHP 8.4 dan MariaDB 10.4. Pengujian HTTP terpisah memverifikasi perubahan data langsung di MariaDB. [Panduan merekam ulang demonstrasi](dokumentasi/PANDUAN_SCREENRECORD.md).
>>>>>>> a3b1fd1 (initial commit)
