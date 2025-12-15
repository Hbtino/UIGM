# Daftar Akun Users dari Database

File SQL: `capaian_kinerja (4).sql`

## Total: 11 Akun

| No  | Nama                    | Email                 | Role             | Jurusan                                 | Status   |
| --- | ----------------------- | --------------------- | ---------------- | --------------------------------------- | -------- |
| 1   | nabil muhammad          | sayang@gmail.com      | **admin**        | -                                       | approved |
| 2   | Habib                   | habibtino83@gmail.com | **admin**        | -                                       | approved |
| 3   | Dosen                   | dosen@gmail.com       | **dosen**        | -                                       | approved |
| 4   | Kaprodi                 | kaprodi@gmail.com     | **kaprodi**      | Jurusan Teknik Mesin                    | approved |
| 5   | SMK TI Garuda Nusantara | Sekola@gmail.com      | **admin**        | -                                       | approved |
| 6   | yani                    | polban@gmail.com      | **admin**        | -                                       | approved |
| 7   | Lutungkasarung          | Mabarepep@gmail.com   | **mahasiswa** ⚠️ | Jurusan Teknik Sipil                    | approved |
| 8   | Ahmad Hidayat           | Madsky@gmail.com      | **dosen**        | Jurusan Teknik Elektro                  | approved |
| 9   | Grace                   | grace@gmail.com       | **mahasiswa** ⚠️ | Jurusan Teknik Komputer dan Informatika | approved |
| 10  | kiranti                 | kiran@gmail.com       | **mahasiswa** ⚠️ | -                                       | approved |
| 11  | mobil brem brem         | mobil@gmail.com       | **mahasiswa** ⚠️ | -                                       | approved |
| 12  | payung jepang           | jepang@gmail.com      | **dosen**        | Jurusan Teknik Komputer dan Informatika | approved |

---

## Ringkasan Role:

- **Admin**: 4 akun

  - nabil muhammad (sayang@gmail.com)
  - Habib (habibtino83@gmail.com)
  - SMK TI Garuda Nusantara (Sekola@gmail.com)
  - yani (polban@gmail.com)

- **Dosen**: 3 akun

  - Dosen (dosen@gmail.com)
  - Ahmad Hidayat (Madsky@gmail.com)
  - payung jepang (jepang@gmail.com)

- **Kaprodi**: 1 akun

  - Kaprodi (kaprodi@gmail.com)

- **Mahasiswa**: 4 akun ⚠️
  - Lutungkasarung (Mabarepep@gmail.com)
  - Grace (grace@gmail.com)
  - kiranti (kiran@gmail.com)
  - mobil brem brem (mobil@gmail.com)

---

## ⚠️ Catatan Penting:

**Ada 4 akun dengan role "mahasiswa"** yang masih bisa login dan akses dashboard.

Karena role mahasiswa sudah dihapus dari sistem, akun-akun ini akan tetap bisa login dengan role mahasiswa yang lama sampai role mereka diubah di database.

### Opsi untuk Handle Akun Mahasiswa:

1. **Update manual** - Ubah role mereka jadi "user" atau "dosen" lewat admin panel
2. **Update via SQL** - Jalankan query untuk update semua role mahasiswa jadi "user"
3. **Biarkan** - Akun mahasiswa yang ada tetap bisa login, tapi tidak bisa buat akun mahasiswa baru

### SQL untuk Update Semua Mahasiswa jadi User:

```sql
UPDATE users
SET role = 'user'
WHERE role = 'mahasiswa';
```
