# TP9 DPBO — Implementasi Arsitektur Model-View-Presenter (MVP) Strict Passive View

Aplikasi manajemen rekrutmen dan HR berbasis PHP Native dengan pola arsitektur **Model-View-Presenter (MVP)** menggunakan pendekatan **Strict Passive View (*Dumb View*)**.

---

## 1. Struktur Direktori

```text
TP9DPBO2526C.../
├── project/
│   ├── index.php
│   ├── mvp_db.sql
│   ├── README.md
│   ├── models/
│   │   ├── DB.php
│   │   ├── Kandidat.php
│   │   ├── KontrakModel.php
│   │   ├── TabelKandidat.php
│   │   ├── Lowongan.php
│   │   ├── KontrakModelLowongan.php
│   │   └── TabelLowongan.php
│   ├── presenters/
│   │   ├── KontrakPresenter.php
│   │   ├── PresenterKandidat.php
│   │   ├── KontrakPresenterLowongan.php
│   │   └── PresenterLowongan.php
│   ├── views/
│   │   ├── KontrakView.php
│   │   ├── ViewKandidat.php
│   │   ├── KontrakViewLowongan.php
│   │   └── ViewLowongan.php
│   └── template/
│       ├── form.html
│       ├── skin.html
│       ├── form_lowongan.html
│       └── skin_lowongan.html
├── dokumentasi/
│   └── PANDUAN_SCREENRECORD.md
├── mvp_db.sql
└── README.md
```

---

## 2. Desain Program & Arsitektur MVP (Strict Passive View)

Aplikasi memisahkan tanggung jawab menjadi tiga lapisan independen yang berkomunikasi melalui **kontrak (*interface*)**:

1. **Model (`models/`)**
   - `DB.php`: Kelas dasar koneksi database menggunakan **PDO** dengan *prepared statement* untuk mencegah SQL Injection.
   - `Kandidat.php` & `Lowongan.php`: *Entity class* yang merepresentasikan baris data dari tabel `kandidat` dan `lowongan`.
   - `KontrakModel.php` & `KontrakModelLowongan.php`: *Interface* kontrak akses data CRUD (`getAll`, `getById`, `add`, `update`, `delete`).
   - `TabelKandidat.php` & `TabelLowongan.php`: Implementasi konkret *query* SQL dan *mapping* hasil ke objek *entity*.

2. **View (`views/` & `template/`)**
   - `KontrakView.php` & `KontrakViewLowongan.php`: *Interface* kontrak *rendering* tampilan (`renderDaftar`, `renderForm`).
   - `ViewKandidat.php` & `ViewLowongan.php`: Implementasi **Strict Passive View** yang **100% terpisah dari Model/Entity**, tidak memiliki perulangan (`foreach`) maupun fungsi agregasi (`count()`), serta hanya memuat template HTML dan mengganti *placeholder token* (`{{TABLE_ROWS}}`, `{{TOTAL_DATA}}`, dll.).

3. **Presenter (`presenters/`)**
   - `KontrakPresenter.php` & `KontrakPresenterLowongan.php`: *Interface* kontrak logika presentasi dan aksi CRUD.
   - `PresenterKandidat.php` & `PresenterLowongan.php`: Menghubungkan kontrak Model dan kontrak View, memvalidasi input, merakit markup baris tabel `<tr>...</tr>`, menghitung total data, serta menyiapkan data *prefill* untuk form *Update*.

---

## 3. Desain Basis Data (`mvp_db.sql`)

Database `mvp_kandidat_db` memiliki dua tabel utama:
1. **`kandidat`**: `id` (PK, AI), `nama`, `posisi`, `domisili`, `skorTes`, `pengalamanTahun`.
2. **`lowongan`**: `id` (PK, AI), `judulPosisi`, `departemen`, `lokasi`, `kuota`, `status` (`Dibuka` / `Ditutup`).

---

## 4. Alur Program

1. **Inisialisasi (`index.php`)**: Membaca parameter `modul` (`kandidat` sebagai default, atau `lowongan`), lalu menginstansiasi Model, View, dan Presenter yang sesuai.
2. **Alur Read (`GET index.php` / `GET index.php?modul=lowongan`)**:
   - `index.php` memanggil `$presenter->tampilkanKandidat()` / `$presenter->tampilkanLowongan()`.
   - Presenter mengambil daftar objek *entity* dari Model (`getAll...()`), menghitung jumlah data, merakit baris `<tr>...</tr>`, lalu menyerahkan string HTML siap pakai ke View (`renderDaftar(...)`).
3. **Alur Create & Update Form (`GET ?screen=add` atau `GET ?screen=edit&id=...`)**:
   - Presenter memanggil `tampilkanForm...(?int $id)`. Jika `$id` tersedia, Presenter mengambil data lama dari Model untuk *prefill* form, lalu mengirimkannya ke View (`renderForm(...)`).
4. **Alur Create, Update, Delete (`POST index.php`)**:
   - `index.php` membaca `$_POST['action']` (`tambah`, `ubah`, atau `hapus`) dan meneruskannya ke Presenter.
   - Presenter melakukan validasi dasar dan memanggil method Model dengan *prepared statement*, lalu melakukan *redirect* (*Post-Redirect-Get*) kembali ke halaman daftar.

---

## 5. Cara Menjalankan Program

1. Salin isi folder `project/` ke direktori web server lokal (misalnya `C:\xampp\htdocs\MVP_Kandidat` pada XAMPP atau `www/MVP_Kandidat` pada Laragon).
2. Jalankan layanan **Apache** dan **MySQL**.
3. Buka `http://localhost/phpmyadmin`, buat/pilih database, lalu *import* file `mvp_db.sql`.
4. Akses aplikasi melalui browser di `http://localhost/MVP_Kandidat/`.

---

## 6. Dokumentasi Screenrecord

- File video rekaman layar (*screenrecord*) demonstrasi fitur CRUD modul **Kandidat** dan modul **Lowongan** disimpan di dalam folder `dokumentasi/`.
