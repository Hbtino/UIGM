# 🔐 UIGM Permission Matrix - Role-Based Access Control

## 📋 **OVERVIEW**

Sistem hak akses UIGM dengan 4 role utama dan matriks CRUD yang jelas untuk setiap modul.

**Legend:**

- **C** = Create (Buat data baru)
- **R** = Read (Lihat data)
- **U** = Update (Edit data)
- **D** = Delete (Hapus data)
- **A** = Approve/Review (Setujui/Review)
- **F** = Finalize/Lock (Finalisasi/Kunci)

---

## 🔴 **ADMIN PUSAT**

### **Hak Akses Penuh:**

| Modul             | C   | R   | U   | D   | A   | F   |
| ----------------- | --- | --- | --- | --- | --- | --- |
| Tahun UIGM        | ✅  | ✅  | ✅  | ✅  | -   | ✅  |
| Kategori SI       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Kategori EC       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Kategori WR       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Kategori WS       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Kategori TR       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Kategori ED       | ✅  | ✅  | ✅  | ✅  | ✅  | ✅  |
| Manajemen User    | ✅  | ✅  | ✅  | ✅  | -   | -   |
| Statistik & Chart | ✅  | ✅  | ✅  | ✅  | -   | -   |
| Laporan Global    | -   | ✅  | -   | -   | -   | -   |

### **Menu yang Ditampilkan:**

- Dashboard
- Semua Kategori UIGM (SI, EC, WR, WS, TR, ED)
- Manajemen User
- Manajemen Menu
- Tahun UIGM
- Approval Final
- Statistik & Chart
- Laporan Global
- Pengaturan

---

## 🟢 **ADMIN UNIT**

### **Pembagian Unit:**

- **Sarpras**: SI, EC, WR, TR
- **LPPM**: ED
- **Umum**: WS

### **Hak Akses Terbatas:**

| Modul                 | C   | R   | U   | D   | A   | F   |
| --------------------- | --- | --- | --- | --- | --- | --- |
| Kategori Unit Sendiri | ✅  | ✅  | ✅  | ❌  | ❌  | ❌  |
| Upload Bukti          | ✅  | ✅  | ✅  | ✅  | -   | -   |
| Status Data Unit      | -   | ✅  | -   | -   | -   | -   |
| Laporan Unit          | -   | ✅  | -   | -   | -   | -   |

### **Menu yang Ditampilkan:**

- Dashboard
- Kategori sesuai unit (Sarpras: SI,EC,WR,TR | LPPM: ED | Umum: WS)
- Upload Bukti
- Status Data
- Laporan Unit

### **❌ Tidak Boleh Akses:**

- Tahun UIGM
- Kategori di luar unit
- Manajemen User
- Approval Final

---

## 🟦 **KAPRODI**

### **Hak Akses Review:**

| Modul             | C   | R   | U   | D   | A   | F   |
| ----------------- | --- | --- | --- | --- | --- | --- |
| Review Data Dosen | -   | ✅  | -   | -   | ✅  | -   |
| Laporan Prodi     | -   | ✅  | -   | -   | -   | -   |
| Statistik Prodi   | -   | ✅  | -   | -   | -   | -   |

### **Menu yang Ditampilkan:**

- Dashboard
- Review Data Dosen
- Laporan Prodi
- Statistik Prodi

### **❌ Tidak Boleh:**

- Edit data kategori UIGM
- Manajemen User
- Approval final
- Akses kategori SI-TR

---

## 🟨 **DOSEN**

### **Hak Akses Terbatas:**

| Modul                   | C   | R   | U   | D   | A   | F   |
| ----------------------- | --- | --- | --- | --- | --- | --- |
| Data ED (Milik Sendiri) | ✅  | ✅  | ✅  | ❌  | -   | -   |
| Status Pengajuan        | -   | ✅  | -   | -   | -   | -   |
| Riwayat Data            | -   | ✅  | -   | -   | -   | -   |

### **Menu yang Ditampilkan:**

- Dashboard
- Input Pendidikan & Penelitian (ED)
- Status Pengajuan
- Riwayat Data

### **❌ Tidak Boleh:**

- Melihat data dosen lain
- Mengakses kategori selain ED
- Approval/Finalisasi

---

## ⚙️ **ATURAN SISTEM**

### **Status Tahun UIGM:**

- **OPEN**: Input & edit diizinkan
- **REVIEW**: Hanya review & approval
- **LOCKED**: Read-only untuk semua

### **Validasi Akses:**

1. **UI Level**: Menu visibility berdasarkan role
2. **Backend Level**: Authorization di setiap endpoint
3. **Database Level**: Row-level security

### **Data Isolation:**

- Admin Unit hanya akses kategori unitnya
- Dosen hanya akses data milik sendiri
- Kaprodi hanya review data prodi sendiri

---

## 🎯 **IMPLEMENTATION CHECKLIST**

### **Backend Security:**

- [ ] Role-based middleware
- [ ] Permission checking di setiap controller
- [ ] Data filtering berdasarkan role
- [ ] Audit logging

### **Frontend Security:**

- [ ] Menu dinamis berdasarkan role
- [ ] Button/form disable berdasarkan permission
- [ ] Route protection
- [ ] Error handling untuk unauthorized access

### **Database Security:**

- [ ] User role table
- [ ] Permission mapping
- [ ] Data ownership tracking
- [ ] Audit trail

---

_Status: READY FOR IMPLEMENTATION_ 🚀
