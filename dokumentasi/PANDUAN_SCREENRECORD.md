# Panduan Screenrecord Demonstrasi Program

[Video demo CRUD](demo-crud.mp4) sudah tersedia. Gunakan skenario berikut jika perlu merekam ulang.

## Skenario yang Direkomendasikan untuk Direkam
1. **Menampilkan Database (`phpMyAdmin`)**: Tunjukkan database `mvp_kandidat_db` beserta tabel `kandidat` dan `lowongan`.
2. **CRUD Modul Kandidat**:
   - **Read**: Menampilkan daftar kandidat terurut berdasarkan `skorTes`.
   - **Create**: Klik `+ Tambah Kandidat`, isi form, simpan, dan tunjukkan data baru muncul di tabel.
   - **Update**: Klik `Edit` pada salah satu kandidat, ubah data, simpan, dan tunjukkan perubahan.
   - **Delete**: Klik `Hapus` pada salah satu kandidat, konfirmasi, dan tunjukkan data terhapus.
3. **CRUD Modul Lowongan**:
   - Berpindah ke tab **Data Lowongan** (`index.php?modul=lowongan`).
   - Lakukan **Read**, **Create** (`+ Tambah Lowongan`), **Update** (`Edit` dengan data *prefill*), dan **Delete** (`Hapus`).
4. **Verifikasi Perubahan di Database**: Refresh tabel `kandidat` dan `lowongan` di `phpMyAdmin` untuk membuktikan data tersimpan secara persisten.
