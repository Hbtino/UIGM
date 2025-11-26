# Testing Fitur Laporan - Checklist

## Persiapan
- [ ] Database sudah di-migrate: `php spark migrate`
- [ ] Server sudah running: `php spark serve`
- [ ] Browser sudah dibuka: `http://localhost:8080`

## Test 1: Login dan Akses Form
### Sebagai Dosen:
- [ ] Login dengan akun dosen
- [ ] Buka menu "Laporan" atau akses `/laporan`
- [ ] Form laporan muncul dengan lengkap
- [ ] Ada 5 section: Info, Mata Kuliah, Acara, Praktik, Kontribusi

### Sebagai Admin:
- [ ] Login dengan akun admin
- [ ] Buka menu "Laporan" atau akses `/laporan`
- [ ] Ada dropdown untuk memilih dosen
- [ ] Dropdown berisi daftar dosen

## Test 2: Simpan Laporan Lengkap
### Data yang diisi:
```
Info Dosen:
- Jurusan: Teknik Informatika
- Program Studi: D4 Teknik Informatika

Mata Kuliah (Row 1):
- Kode: TI001
- Nama: Sistem Berkelanjutan
- Deskripsi: Materi tentang keberlanjutan
- SKS: 3

Mata Kuliah (Row 2):
- Kode: TI002
- Nama: Ekologi Perkotaan
- Deskripsi: Fokus pada ekologi
- SKS: 2

Acara Ilmiah (Row 1):
- Nama: Seminar Lingkungan
- Tanggal: 2024-01-15
- Peran: Narasumber
- Topik: Pengelolaan Limbah

Acara Ilmiah (Row 2):
- Nama: Workshop Green Campus
- Tanggal: 2024-02-20
- Peran: Peserta
- Topik: Kampus Hijau

Praktik (Row 1):
- Inisiatif: Gerakan Paperless
- Deskripsi: Mengurangi penggunaan kertas
- Kategori: WS

Praktik (Row 2):
- Inisiatif: Manajemen Limbah B3
- Deskripsi: Pemilahan limbah kimia
- Kategori: WS

Praktik (Row 3):
- Inisiatif: Efisiensi Energi Lab
- Deskripsi: Peralatan hemat energi
- Kategori: EC

Kontribusi (Row 1):
- Bentuk: Transportasi Publik
- Deskripsi: Komitmen penggunaan transportasi publik
- Kategori: TR

Kontribusi (Row 2):
- Bentuk: Penghematan Air
- Deskripsi: Poster edukasi penghematan air
- Kategori: WR
```

### Langkah Test:
- [ ] Isi semua data di atas
- [ ] Klik tombol "Simpan Laporan"
- [ ] Muncul alert "Laporan berhasil disimpan!"
- [ ] Halaman reload otomatis
- [ ] Muncul info "Laporan terakhir disimpan: [timestamp]"

## Test 3: Verifikasi Data Tersimpan
- [ ] Buka phpMyAdmin atau database client
- [ ] Cek tabel `laporan_dosen`
- [ ] Ada 1 record baru
- [ ] Field `user_name` terisi dengan benar
- [ ] Field `data_laporan` berisi JSON lengkap
- [ ] JSON berisi: mata_kuliah, acara, praktik, kontribusi

### Contoh Query:
```sql
SELECT * FROM laporan_dosen ORDER BY created_at DESC LIMIT 1;
```

## Test 4: Load Data yang Tersimpan
- [ ] Refresh halaman form laporan
- [ ] Semua data yang tadi diisi muncul kembali
- [ ] Mata kuliah (2 rows) terisi
- [ ] Acara ilmiah (2 rows) terisi
- [ ] Praktik (3 rows) terisi
- [ ] Kontribusi (2 rows) terisi

## Test 5: Simpan Laporan Kedua
- [ ] Ubah beberapa data (misal: jurusan, nama acara)
- [ ] Klik "Simpan Laporan" lagi
- [ ] Muncul alert "Laporan berhasil disimpan!"
- [ ] Cek database: sekarang ada 2 records
- [ ] Record lama TIDAK tertimpa

### Query:
```sql
SELECT id, user_name, jurusan, created_at 
FROM laporan_dosen 
ORDER BY created_at DESC;
```

## Test 6: Lihat Riwayat
- [ ] Klik tombol "Lihat Riwayat" (biru)
- [ ] Halaman riwayat terbuka
- [ ] Muncul 2 card laporan
- [ ] Urutan dari yang terbaru
- [ ] Setiap card menampilkan:
  - Waktu penyimpanan
  - Info dosen
  - Mata kuliah (tabel)
  - Acara ilmiah (tabel)
  - Praktik ramah lingkungan (tabel)
  - Kontribusi kebijakan (tabel)
  - Tombol "Download PDF"

## Test 7: Download PDF
### Laporan Pertama:
- [ ] Klik "Download PDF" pada card pertama
- [ ] PDF ter-download
- [ ] Buka PDF
- [ ] Nama dosen benar
- [ ] Semua section ada: Info, Mata Kuliah, Acara, Praktik, Kontribusi
- [ ] Data sesuai dengan yang disimpan
- [ ] Ada timestamp "Laporan disimpan"
- [ ] Ada timestamp "Tanggal Cetak"
- [ ] Ada "Dicetak oleh"

### Laporan Kedua:
- [ ] Klik "Download PDF" pada card kedua
- [ ] PDF ter-download
- [ ] Data berbeda dengan PDF pertama

## Test 8: Admin Pilih Dosen Lain
### Sebagai Admin:
- [ ] Login sebagai admin
- [ ] Buka form laporan
- [ ] Pilih dosen "Ahmad" dari dropdown
- [ ] Isi data laporan
- [ ] Klik "Simpan Laporan"
- [ ] Cek database:
  - `user_id` = ID dosen Ahmad
  - `user_name` = "Ahmad" (bukan nama admin)

### Verifikasi:
- [ ] Logout admin
- [ ] Login sebagai dosen Ahmad
- [ ] Buka "Lihat Riwayat"
- [ ] Laporan yang dibuat admin muncul
- [ ] Download PDF
- [ ] Nama di PDF = "Ahmad"

## Test 9: Multiple Laporan dari User Berbeda
### User 1 (Dosen A):
- [ ] Login sebagai Dosen A
- [ ] Simpan 2 laporan
- [ ] Lihat riwayat: ada 2 laporan

### User 2 (Dosen B):
- [ ] Login sebagai Dosen B
- [ ] Simpan 1 laporan
- [ ] Lihat riwayat: ada 1 laporan (bukan 3)

### Verifikasi Database:
```sql
-- Total records
SELECT COUNT(*) FROM laporan_dosen;
-- Result: 3

-- Per user
SELECT user_name, COUNT(*) as total 
FROM laporan_dosen 
GROUP BY user_id;
-- Dosen A: 2
-- Dosen B: 1
```

## Test 10: Edge Cases

### Empty Data:
- [ ] Simpan laporan dengan hanya info dosen (section lain kosong)
- [ ] Berhasil tersimpan
- [ ] Riwayat menampilkan hanya section yang terisi
- [ ] PDF tidak error

### Special Characters:
- [ ] Isi data dengan karakter khusus: `<script>alert('test')</script>`
- [ ] Simpan
- [ ] Lihat riwayat: karakter di-escape dengan benar
- [ ] PDF: karakter di-escape dengan benar

### Long Text:
- [ ] Isi deskripsi dengan text panjang (500+ karakter)
- [ ] Simpan
- [ ] Riwayat: text terpotong atau scrollable
- [ ] PDF: text ter-wrap dengan baik

## Test 11: Performance

### Multiple Records:
- [ ] Simpan 10 laporan
- [ ] Buka riwayat
- [ ] Halaman load < 3 detik
- [ ] Semua 10 card muncul
- [ ] Scroll smooth

### Large Data:
- [ ] Isi semua field dengan data maksimal
- [ ] Simpan
- [ ] Berhasil (tidak timeout)
- [ ] PDF generate < 5 detik

## Test 12: Browser Compatibility
- [ ] Chrome: Semua fitur berfungsi
- [ ] Firefox: Semua fitur berfungsi
- [ ] Edge: Semua fitur berfungsi
- [ ] Safari (jika ada): Semua fitur berfungsi

## Test 13: Mobile Responsive
- [ ] Buka di mobile browser atau resize window
- [ ] Form tetap usable
- [ ] Tabel scrollable horizontal
- [ ] Tombol tidak overlap
- [ ] Riwayat card stack vertical

## Troubleshooting

### Jika data tidak tersimpan:
1. Buka Console Browser (F12)
2. Cek tab "Network"
3. Klik "Simpan Laporan"
4. Lihat request ke `/laporan/save-dosen`
5. Cek response: success true/false?
6. Cek tab "Console" untuk error JavaScript

### Jika nama dosen salah:
1. Cek database: `SELECT user_name FROM laporan_dosen`
2. Jika kosong, ada masalah di controller
3. Jika salah, ada masalah di JavaScript (admin select)

### Jika section tidak tersimpan:
1. Buka Console Browser
2. Tambahkan debug di JavaScript:
```javascript
console.log('Mata Kuliah:', mataKuliah);
console.log('Acara:', acara);
console.log('Praktik:', praktik);
console.log('Kontribusi:', kontribusi);
```
3. Cek apakah data ter-capture dengan benar

### Jika PDF error:
1. Cek error log: `writable/logs/log-[date].log`
2. Pastikan Dompdf terinstall: `composer show dompdf/dompdf`
3. Cek permission folder `writable`

## Success Criteria

✅ **Semua test passed** jika:
- Data tersimpan lengkap (semua section)
- Multiple records tidak saling timpa
- Nama dosen konsisten (form, riwayat, PDF)
- Riwayat menampilkan semua laporan
- PDF generate dengan benar
- Tidak ada error di console
- Performance acceptable (< 3 detik)

## Report Issues

Jika ada test yang gagal, catat:
1. Test number yang gagal
2. Error message (jika ada)
3. Screenshot
4. Browser & version
5. Steps to reproduce
