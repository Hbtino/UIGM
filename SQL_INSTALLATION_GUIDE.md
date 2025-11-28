# SQL Installation Guide - Dashboard Contents

## Situasi 1: Tabel Belum Ada (Fresh Install)

Gunakan file: `CREATE_DASHBOARD_CONTENTS_TABLE.sql`

**Langkah:**

1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab "SQL"
4. Copy-paste seluruh isi file `CREATE_DASHBOARD_CONTENTS_TABLE.sql`
5. Klik "Go"

**Hasil:**

- Tabel `dashboard_contents` akan dibuat
- Data default akan diinsert

---

## Situasi 2: Tabel Sudah Ada (Update Data)

Gunakan file: `UPDATE_DASHBOARD_CONTENTS_DATA.sql`

**Langkah:**

1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab "SQL"
4. Copy-paste seluruh isi file `UPDATE_DASHBOARD_CONTENTS_DATA.sql`
5. Klik "Go"

**Hasil:**

- Data di tabel `dashboard_contents` akan diupdate
- Tidak ada error duplicate entry

---

## Situasi 3: Error "Duplicate Entry"

Jika Anda mendapat error:

```
#1062 - Duplicate entry 'info_box' for key 'section'
```

**Solusi 1: Gunakan UPDATE_DASHBOARD_CONTENTS_DATA.sql**
File ini hanya update data yang sudah ada, tidak insert baru.

**Solusi 2: Hapus Data Lama Dulu**

```sql
-- Hapus semua data lama
DELETE FROM dashboard_contents;

-- Kemudian jalankan CREATE_DASHBOARD_CONTENTS_TABLE.sql
```

**Solusi 3: Drop dan Recreate Table**

```sql
-- Hapus tabel
DROP TABLE IF EXISTS dashboard_contents;

-- Kemudian jalankan CREATE_DASHBOARD_CONTENTS_TABLE.sql
```

---

## Verifikasi Instalasi

Setelah menjalankan SQL, cek apakah data sudah masuk:

```sql
SELECT section, title, value, icon, color, is_active
FROM dashboard_contents
ORDER BY `order` ASC;
```

**Hasil yang diharapkan:**

```
section              | title                                    | value | icon           | color  | is_active
---------------------|------------------------------------------|-------|----------------|--------|----------
info_box             | Tentang Renstra TMKB Polban             | NULL  | fa-info-circle | NULL   | 1
stat_card_1          | Target Skor 2028                        | 80    | fa-chart-line  | blue   | 1
stat_card_2          | Target Ranking Dunia                    | 176   | fa-trophy      | green  | 1
stat_card_3          | Target Ranking Indonesia                | 26    | fa-flag        | orange | 1
stat_card_4          | Kriteria Keberlanjutan                  | 6     | fa-leaf        | purple | 1
chart_title          | Capaian Kriteria Kampus Berkelanjutan...| NULL  | NULL           | NULL   | 1
chart_description    | NULL                                    | NULL  | NULL           | NULL   | 1
top_bar_title        | Dashboard Kampus Berkelanjutan          | NULL  | NULL           | NULL   | 1
top_bar_subtitle     | NULL                                    | NULL  | NULL           | NULL   | 1
```

---

## Troubleshooting

### Error: Table doesn't exist

**Solusi:** Jalankan `CREATE_DASHBOARD_CONTENTS_TABLE.sql`

### Error: Duplicate entry

**Solusi:** Jalankan `UPDATE_DASHBOARD_CONTENTS_DATA.sql` atau hapus data lama dulu

### Error: Unknown column

**Solusi:** Drop table dan recreate dengan `CREATE_DASHBOARD_CONTENTS_TABLE.sql`

### Data tidak muncul di dashboard

**Solusi:**

1. Cek apakah `is_active = 1`
2. Refresh browser (Ctrl+F5)
3. Clear cache browser

---

## File SQL yang Tersedia

| File                                  | Fungsi                     | Kapan Digunakan            |
| ------------------------------------- | -------------------------- | -------------------------- |
| `CREATE_DASHBOARD_CONTENTS_TABLE.sql` | Create table + insert data | Tabel belum ada            |
| `UPDATE_DASHBOARD_CONTENTS_DATA.sql`  | Update data saja           | Tabel sudah ada            |
| `UPDATE_KONTAK_TO_INFORMASI.sql`      | Update landing page        | Ubah kontak jadi informasi |

---

## Quick Command (MySQL CLI)

**Fresh Install:**

```bash
mysql -u username -p database_name < CREATE_DASHBOARD_CONTENTS_TABLE.sql
```

**Update Data:**

```bash
mysql -u username -p database_name < UPDATE_DASHBOARD_CONTENTS_DATA.sql
```

---

## Rekomendasi

✅ **Untuk instalasi pertama kali:** Gunakan `CREATE_DASHBOARD_CONTENTS_TABLE.sql`

✅ **Untuk update data:** Gunakan `UPDATE_DASHBOARD_CONTENTS_DATA.sql`

✅ **Jika ragu:** Backup database dulu sebelum jalankan SQL

✅ **Setelah install:** Test dengan login sebagai admin dan buka menu "Konten Dashboard"
