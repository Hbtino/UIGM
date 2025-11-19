# ⚡ Quick Reference Guide

## 🎯 Panduan Cepat Sistem UI GreenMetric CRUD

---

## 🔐 Login

```
URL: http://yourdomain.com/login
Email: user@polban.ac.id
Password: ********
```

---

## 👥 Role & Akses

| Role | Create | Edit | Delete | Verify | Review |
|------|--------|------|--------|--------|--------|
| Admin | ✅ | ✅ All | ✅ | ✅ | ✅ |
| Reviewer | ❌ | ❌ | ❌ | ✅ | ✅ |
| Kaprodi | ✅ | ✅ Own | ❌ | ❌ | ❌ |
| User | ❌ | ❌ | ❌ | ❌ | ❌ |

---

## 📋 6 Modul Sistem

1. 🚗 **Transportation** - `/transportation`
2. 🏢 **Setting & Infrastructure** - `/setting-infrastructure`
3. ⚡ **Energy & Climate Change** - `/energy-climate`
4. 💧 **Water Management** - `/water-management`
5. ♻️ **Waste Management** - `/waste-management`
6. 🎓 **Education & Research** - `/education-research`

---

## ✅ Status Data

| Status | Icon | Arti |
|--------|------|------|
| Pending | 🟡 | Menunggu verifikasi |
| Approved | 🟢 | Disetujui |
| Rejected | 🔴 | Ditolak |

---

## 📝 Workflow Cepat

### Input Data Baru
```
1. Klik "Tambah Data"
2. Isi form + upload file
3. Klik "Simpan"
4. Status: Pending
```

### Verifikasi Data
```
1. Klik "Verifikasi"
2. Review data + file
3. Pilih Approve/Reject
4. Isi catatan
5. Klik "Simpan"
```

### Request Revisi
```
1. Klik "Request Revisi"
2. Isi alasan
3. Submit
4. Tunggu review
```

### Review Revisi
```
1. Buka "Daftar Request"
2. Klik "Review"
3. Approve/Reject
4. Isi catatan
5. Submit
```

---

## 📤 File Upload

**Format:** PDF, JPG, PNG, XLSX, XLS  
**Max Size:** 2MB  
**Required:** Ya (saat create)

---

## 🔢 Auto-calculation

### Transportation
```
capaian = (ramah_lingkungan / total) × 100
```

### Setting Infrastructure
```
area_hijau = (ruang_terbuka / luas_total) × 100
capaian = weighted average
```

### Energy Climate
```
energi_terbarukan = (terbarukan / total) × 100
capaian = weighted + programs
```

### Water Management
```
daur_ulang = (air_daur / total) × 100
capaian = weighted + programs
```

### Waste Management
```
daur_ulang = (sampah_daur / total) × 100
capaian = weighted + programs
```

### Education Research
```
rasio_mk = (mk_berkelanjutan / total_mk) × 100
rasio_dana = (dana_berkelanjutan / total_dana) × 100
capaian = weighted + programs
```

---

## 🎯 Common Tasks

### Lihat Data
```
Menu → Pilih Modul → View List
```

### Tambah Data
```
Menu → Modul → Tambah Data → Isi Form → Simpan
```

### Edit Data
```
List → Edit → Ubah Data → Update
```

### Download File
```
List → Download → File Terdownload
```

### Verifikasi
```
List → Verifikasi → Review → Approve/Reject → Simpan
```

### Request Revisi
```
List → Request Revisi → Isi Alasan → Submit
```

### Cek Status Revisi
```
Menu → Revisi Saya → View Status
```

---

## 🔍 Validation Rules

### Tahun
- Required
- 4 digits
- Unique per module

### Decimal Fields
- Required
- Format: 999999999999.99
- Must be ≥ 0

### Percentage Fields
- Auto-calculated
- Range: 0-100
- 2 decimal places

### Boolean Fields
- Optional
- Values: 0 (No) or 1 (Yes)

### File Upload
- Required on create
- Optional on update
- Max 2MB
- Allowed: PDF, JPG, PNG, XLSX, XLS

---

## ⚠️ Common Errors

### "Tahun sudah ada"
**Solusi:** Gunakan tahun yang berbeda atau edit data existing

### "File terlalu besar"
**Solusi:** Kompres file hingga < 2MB

### "Format file tidak didukung"
**Solusi:** Gunakan PDF, JPG, PNG, XLSX, atau XLS

### "Tidak ada data untuk diupdate"
**Solusi:** Pastikan ada perubahan data sebelum update

### "Anda tidak memiliki akses"
**Solusi:** Cek role dan permission Anda

### "Data tidak dapat diedit"
**Solusi:** Request revisi jika data sudah approved

---

## 🔑 Keyboard Shortcuts

| Key | Action |
|-----|--------|
| `Ctrl + S` | Save form (if supported) |
| `Esc` | Close modal |
| `Tab` | Next field |
| `Shift + Tab` | Previous field |

---

## 📊 Dashboard Widgets

### Data Summary
- Total data per module
- Pending count
- Approved count
- Rejected count

### Recent Activities
- Latest data entries
- Recent verifications
- Recent revisions

### Quick Actions
- Add new data
- View pending verifications
- Check revision requests

---

## 🔔 Notifications

### Email Notifications (Future)
- Data verified
- Revision request approved/rejected
- New data needs verification

### In-app Notifications (Future)
- Real-time status updates
- Mention notifications
- System announcements

---

## 📱 Mobile Access

**Responsive Design:** ✅ Yes  
**Mobile App:** ❌ Not yet  
**Browser Support:**
- Chrome (recommended)
- Firefox
- Safari
- Edge

---

## 🛠️ Troubleshooting Quick Fixes

### Can't Login
```
1. Check email/password
2. Clear browser cache
3. Try different browser
4. Contact admin
```

### Page Not Loading
```
1. Refresh page (F5)
2. Clear cache (Ctrl + Shift + Del)
3. Check internet connection
4. Try incognito mode
```

### Form Not Submitting
```
1. Check all required fields
2. Check file size
3. Check internet connection
4. Try again
```

### File Not Downloading
```
1. Check popup blocker
2. Try different browser
3. Check download folder
4. Contact support
```

---

## 📞 Quick Contact

**Technical Support:**
- Email: support@polban.ac.id
- Phone: +62-22-1234567
- Hours: Mon-Fri, 08:00-16:00 WIB

**Emergency Contact:**
- Admin: admin@polban.ac.id

---

## 🔗 Quick Links

### Documentation
- [Complete Documentation](COMPLETE_SYSTEM_DOCUMENTATION.md)
- [Module Specifications](MODULE_SPECIFICATIONS.md)
- [User Guide](USER_GUIDE.md)
- [API Documentation](API_ENDPOINTS_DOCUMENTATION.md)
- [Database Schema](DATABASE_SCHEMA_DOCUMENTATION.md)

### External Links
- [UI GreenMetric](https://greenmetric.ui.ac.id)
- [Polban](https://polban.ac.id)
- [SDGs](https://sdgs.un.org)

---

## 💡 Pro Tips

1. **Save Often** - Jangan tunggu sampai selesai semua
2. **Backup Files** - Simpan copy file sebelum upload
3. **Use Chrome** - Browser yang paling compatible
4. **Check Status** - Selalu cek status data setelah submit
5. **Read Feedback** - Baca catatan verifikasi dengan teliti
6. **Ask Questions** - Jangan ragu tanya jika bingung
7. **Keep Updated** - Cek announcement untuk update sistem

---

## 📈 Performance Tips

### For Users
- Use latest browser version
- Clear cache regularly
- Compress files before upload
- Use stable internet connection

### For Admins
- Regular database maintenance
- Monitor system logs
- Backup data regularly
- Update system regularly

---

## 🎓 Training Resources

### Video Tutorials (Coming Soon)
1. System Overview (5 min)
2. Data Entry (10 min)
3. Verification Process (8 min)
4. Revision Workflow (7 min)

### Documentation
- User Guide (detailed)
- Quick Reference (this doc)
- FAQ (coming soon)

---

## ✅ Daily Checklist

### For Kaprodi
- [ ] Check pending data
- [ ] Review rejected data
- [ ] Submit new data if any
- [ ] Check revision status

### For Reviewer
- [ ] Review pending verifications
- [ ] Process revision requests
- [ ] Provide feedback
- [ ] Update verification notes

### For Admin
- [ ] Monitor system health
- [ ] Review user requests
- [ ] Process approvals
- [ ] Check error logs

---

## 🔄 Update History

### v1.0.0 (2025-11-14)
- Initial release
- 6 modules complete
- Full CRUD functionality
- Verification system
- Revision workflow

---

## 📝 Notes

- Sistem ini masih dalam pengembangan aktif
- Fitur baru akan ditambahkan secara berkala
- Feedback dan saran sangat diterima
- Lapor bug ke support@polban.ac.id

---

**Print this page for quick reference!**

**Last Updated:** 2025-11-14  
**Version:** 1.0.0
