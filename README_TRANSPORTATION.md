# Transportation CRUD System - Complete Documentation

## 📚 Dokumentasi Lengkap

Sistem CRUD Transportation untuk UI GreenMetric Polban dengan fitur verifikasi dan revision request.

### 📖 Daftar Dokumentasi

1. **[IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)** - Ringkasan implementasi dan fitur
2. **[TRANSPORTATION_FEATURES.md](TRANSPORTATION_FEATURES.md)** - Detail fitur CRUD dasar
3. **[REVIEWER_AND_REVISION_FEATURES.md](REVIEWER_AND_REVISION_FEATURES.md)** - Fitur reviewer dan revision request
4. **[QUICK_START_GUIDE.md](QUICK_START_GUIDE.md)** - Panduan cepat untuk user
5. **[SQL_HELPERS.sql](SQL_HELPERS.sql)** - Query SQL helper untuk maintenance

## 🎯 Fitur Utama

### ✅ Sudah Diimplementasikan

1. **Basic CRUD**
   - Create, Read, Update, Delete data transportation
   - Role-based access control
   - Form validation

2. **Verification Status**
   - Status: Pending, Approved, Rejected
   - Verification workflow
   - Verification notes

3. **File Upload**
   - Upload bukti pendukung
   - Format: PDF, JPG, PNG, XLSX, XLS
   - Max size: 2MB
   - Download functionality

4. **Auto-calculation**
   - Automatic percentage calculation
   - Real-time preview
   - Backend validation

5. **Reviewer Role**
   - Dedicated verification role
   - Separate from admin
   - Access control

6. **Revision Request System**
   - Request revision for approved data
   - Admin/Reviewer review workflow
   - Approval/Rejection with notes
   - Track revision history

## 👥 User Roles

| Role | Create | Edit Pending | Edit Approved | Verify | Review Revision | Delete |
|------|--------|--------------|---------------|--------|-----------------|--------|
| **Admin** | ✅ | ✅ | ✅ | ✅ | ✅ | ✅ |
| **Reviewer** | ❌ | ❌ | ❌ | ✅ | ✅ | ❌ |
| **Kaprodi** | ✅ | ✅ | ❌ | ❌ | ❌ | ❌ |
| **User** | ❌ | ❌ | ❌ | ❌ | ❌ | ❌ |

*Semua role dapat request revision untuk data approved*

## 🗂️ Struktur File

```
app/
├── Controllers/
│   └── TransportationController.php (Updated)
├── Models/
│   ├── TransportationModel.php (Updated)
│   └── TransportationRevisionModel.php (New)
├── Filters/
│   ├── AdminFilter.php (Existing)
│   └── ReviewerFilter.php (New)
├── Views/
│   └── kriteria/
│       └── transportation/
│           ├── index.php (Updated)
│           ├── create.php (New)
│           ├── edit.php (New)
│           ├── verify.php (New)
│           ├── request_revision.php (New)
│           ├── revision_list.php (New)
│           ├── review_revision.php (New)
│           └── my_revisions.php (New)
├── Database/
│   └── Migrations/
│       ├── 2025-11-13-000000_CreateTransportationTable.php
│       └── 2025-11-13-000002_CreateTransportationRevisionsTable.php
└── Config/
    ├── Routes.php (Updated)
    └── Filters.php (Updated)

writable/
└── uploads/
    └── transportation/ (New)
```

## 🚀 Quick Start

### 1. Setup Database
```bash
php spark migrate
```

### 2. Create Reviewer User
```sql
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Reviewer', 'reviewer@polban.ac.id', '$2y$10$...', 'reviewer', NOW());
```

### 3. Set Folder Permissions
```bash
# Windows
icacls writable\uploads\transportation /grant Users:F

# Linux/Mac
chmod -R 777 writable/uploads/transportation
```

### 4. Access System
- URL: `http://localhost/transportation`
- Login dengan user yang sesuai

## 📊 Database Schema

### Table: transportation
```sql
- id (PK)
- tahun (UNIQUE)
- total_perjalanan
- perjalanan_ramah_lingkungan
- capaian_persen (auto-calculated)
- status_verifikasi (pending/approved/rejected)
- bukti_pendukung (file path)
- verified_by (FK users)
- verified_at
- created_by (FK users)
- updated_by (FK users)
- timestamps
```

### Table: transportation_revisions
```sql
- id (PK)
- transportation_id (FK)
- requested_by (FK users)
- alasan_revisi
- data_revisi (JSON snapshot)
- status (pending/approved/rejected)
- reviewed_by (FK users)
- review_notes
- reviewed_at
- timestamps
```

## 🔄 Workflows

### Workflow 1: Create New Data
```
User (Kaprodi) → Create Data → Status: Pending
                                    ↓
Reviewer → Verify → Approve/Reject
                        ↓
                  Status: Approved/Rejected
```

### Workflow 2: Revision Request
```
User → Request Revision (Approved Data)
            ↓
    Status Request: Pending
            ↓
Admin/Reviewer → Review Request
            ↓
    Approve → Data Status: Pending (Can Edit)
    Reject → Data Status: Approved (Cannot Edit)
```

## 🔐 Security Features

1. **Authentication**
   - Session-based authentication
   - Role-based access control

2. **Authorization**
   - Filter-based route protection
   - Controller-level checks
   - View-level conditional rendering

3. **File Upload Security**
   - File type validation
   - File size limitation
   - Random filename generation
   - Secure storage location

4. **Data Validation**
   - Server-side validation
   - Client-side validation
   - Business logic validation

5. **Audit Trail**
   - Created by tracking
   - Updated by tracking
   - Verified by tracking
   - Revision history

## 📈 Monitoring & Maintenance

### Key Metrics to Monitor
1. Pending verifications count
2. Pending revision requests count
3. Average verification time
4. Approval/rejection rate
5. User activity

### Regular Maintenance Tasks
1. Backup database weekly
2. Clean up old rejected data (optional)
3. Review file storage usage
4. Check for orphaned files
5. Monitor user access patterns

### SQL Queries
Lihat [SQL_HELPERS.sql](SQL_HELPERS.sql) untuk query maintenance.

## 🧪 Testing

### Manual Testing Checklist

#### Basic CRUD
- [ ] Create data dengan file upload
- [ ] Edit data pending
- [ ] View data list
- [ ] Download bukti pendukung
- [ ] Delete data (admin only)

#### Verification
- [ ] Verify data as reviewer
- [ ] Approve data
- [ ] Reject data with notes
- [ ] Check status changes

#### Revision Request
- [ ] Request revision on approved data
- [ ] View revision list (admin/reviewer)
- [ ] Review revision request
- [ ] Approve revision request
- [ ] Reject revision request
- [ ] View my revisions

#### Access Control
- [ ] Test admin access
- [ ] Test reviewer access
- [ ] Test kaprodi access
- [ ] Test unauthorized access

## 🐛 Troubleshooting

### Common Issues

1. **File Upload Failed**
   - Check folder permissions
   - Check file size (max 2MB)
   - Check file format

2. **Cannot Edit Approved Data**
   - Use revision request feature
   - Wait for admin/reviewer approval

3. **Percentage Not Calculated**
   - Check total_perjalanan > 0
   - Check perjalanan_ramah_lingkungan ≤ total_perjalanan

4. **Access Denied**
   - Check user role
   - Check session status
   - Logout and login again

## 📞 Support

### Documentation
- Implementation: [IMPLEMENTATION_SUMMARY.md](IMPLEMENTATION_SUMMARY.md)
- Features: [TRANSPORTATION_FEATURES.md](TRANSPORTATION_FEATURES.md)
- Reviewer: [REVIEWER_AND_REVISION_FEATURES.md](REVIEWER_AND_REVISION_FEATURES.md)
- Quick Start: [QUICK_START_GUIDE.md](QUICK_START_GUIDE.md)

### Contact
- Developer Team
- System Administrator
- Project Manager

## 🔮 Future Enhancements

### Planned Features
1. Email notifications
2. Dashboard analytics
3. Export to Excel/PDF
4. Bulk operations
5. Advanced search & filter
6. Revision comparison view
7. Auto-approval rules
8. Mobile responsive improvements

### Nice to Have
1. API endpoints
2. Real-time notifications
3. Activity logs
4. Data visualization
5. Automated reports
6. Integration with other modules

## 📝 Version History

### Version 1.0.0 (2025-11-13)
- ✅ Initial release
- ✅ Basic CRUD operations
- ✅ File upload system
- ✅ Auto-calculation
- ✅ Verification workflow
- ✅ Reviewer role
- ✅ Revision request system

## 📄 License

Internal use only - Politeknik Negeri Bandung

## 👨‍💻 Contributors

- Development Team
- UI GreenMetric Team Polban

---

**Last Updated:** 2025-11-13  
**Version:** 1.0.0  
**Status:** Production Ready
