# 🌱 UI GreenMetric CRUD System

## Sistem Manajemen Data Kriteria SDGs - Politeknik Negeri Bandung

[![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/your-repo)
[![PHP](https://img.shields.io/badge/PHP-8.1+-purple.svg)](https://php.net)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4.x-red.svg)](https://codeigniter.com)
[![License](https://img.shields.io/badge/license-Internal-green.svg)](LICENSE)

---

## 📋 Tentang Sistem

Sistem UI GreenMetric CRUD adalah aplikasi web untuk mengelola data kriteria Sustainable Development Goals (SDGs) Politeknik Negeri Bandung dalam rangka penilaian **UI GreenMetric World University Rankings**.

### 🎯 Tujuan

Memfasilitasi pengumpulan, verifikasi, dan pengelolaan data kriteria keberlanjutan kampus secara terstruktur dan efisien.

### ✨ Fitur Utama

- ✅ **CRUD Operations** - Create, Read, Update, Delete data
- 📤 **File Upload** - Upload dokumen pendukung
- 🔢 **Auto-calculation** - Perhitungan otomatis persentase capaian
- ✅ **Verification System** - Workflow verifikasi data
- 👥 **Role-based Access** - Admin, Reviewer, Kaprodi, User
- 🔄 **Revision Request** - Request revisi data yang sudah approved
- 📊 **Dashboard** - Overview data dan statistik
- 🔐 **Security** - Authentication & authorization

---

## 🗂️ 6 Modul Kriteria

| No | Modul | URL | Status |
|----|-------|-----|--------|
| 1 | 🚗 Transportation | `/transportation` | ✅ Complete |
| 2 | 🏢 Setting & Infrastructure | `/setting-infrastructure` | ✅ Complete |
| 3 | ⚡ Energy & Climate Change | `/energy-climate` | ✅ Complete |
| 4 | 💧 Water Management | `/water-management` | ✅ Complete |
| 5 | ♻️ Waste Management | `/waste-management` | ✅ Complete |
| 6 | 🎓 Education & Research | `/education-research` | ✅ Complete |

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.1 atau lebih tinggi
- MySQL 5.7+ atau MariaDB 10.3+
- Composer
- Apache/Nginx web server

### Installation

```bash
# 1. Clone repository
git clone https://github.com/your-repo/greenmetric.git
cd greenmetric

# 2. Install dependencies
composer install

# 3. Setup environment
cp env .env
# Edit .env dengan database credentials

# 4. Create database
mysql -u root -p
CREATE DATABASE capaian_kinerja;
exit;

# 5. Run migrations
php spark migrate

# 6. Start development server
php spark serve
```

Akses: `http://localhost:8080`

**Default Login:**
- Email: `admin@polban.ac.id`
- Password: `password` (change immediately!)

---

## 📚 Dokumentasi

### 🎯 Mulai Dari Sini

| Dokumen | Untuk Siapa | Waktu Baca |
|---------|-------------|------------|
| [📖 Documentation Index](DOCUMENTATION_INDEX.md) | Semua | 5 min |
| [⚡ Quick Reference](QUICK_REFERENCE_GUIDE.md) | Semua | 10 min |
| [📘 User Guide](USER_GUIDE.md) | End Users | 30 min |
| [🚀 Deployment Guide](DEPLOYMENT_AND_MAINTENANCE.md) | Admins | 45 min |

### 📖 Dokumentasi Lengkap

#### Getting Started
- [Quick Reference Guide](QUICK_REFERENCE_GUIDE.md) - Panduan cepat
- [User Guide](USER_GUIDE.md) - Panduan lengkap pengguna
- [START_HERE.md](START_HERE.md) - Panduan untuk developer

#### System Documentation
- [Complete System Documentation](COMPLETE_SYSTEM_DOCUMENTATION.md) - Dokumentasi sistem lengkap
- [Module Specifications](MODULE_SPECIFICATIONS.md) - Spesifikasi setiap modul
- [Database Schema](DATABASE_SCHEMA_DOCUMENTATION.md) - Struktur database
- [API Endpoints](API_ENDPOINTS_DOCUMENTATION.md) - Dokumentasi API

#### Implementation & Deployment
- [Implementation Roadmap](IMPLEMENTATION_ROADMAP.md) - Roadmap implementasi
- [Implementation Summary](IMPLEMENTATION_SUMMARY.md) - Ringkasan implementasi
- [Deployment & Maintenance](DEPLOYMENT_AND_MAINTENANCE.md) - Panduan deployment

#### Features
- [Reviewer & Revision Features](REVIEWER_AND_REVISION_FEATURES.md) - Fitur reviewer
- [User Approval System](USER_APPROVAL_SYSTEM.md) - Sistem approval user

**📋 [Lihat Semua Dokumentasi](DOCUMENTATION_INDEX.md)**

---

## 🏗️ Teknologi

### Backend
- **Framework:** CodeIgniter 4.x
- **Language:** PHP 8.1+
- **Database:** MySQL/MariaDB

### Frontend
- **CSS Framework:** Bootstrap 5
- **Icons:** Font Awesome
- **JavaScript:** jQuery

### Tools
- **Package Manager:** Composer
- **Version Control:** Git

---

## 👥 Role & Akses

| Role | Akses |
|------|-------|
| **Admin** | Full access - semua fitur |
| **Reviewer** | Verifikasi dan review revisi |
| **Kaprodi** | Input dan edit data sendiri |
| **User** | View data saja |

---

## 📊 Struktur Project

```
greenmetric/
├── app/
│   ├── Controllers/      # Business logic
│   ├── Models/          # Data access layer
│   ├── Views/           # Presentation layer
│   ├── Database/        # Migrations & seeds
│   ├── Filters/         # Auth & authorization
│   └── Config/          # Configuration
├── public/              # Public assets
│   ├── css/
│   ├── js/
│   └── uploads/
├── writable/            # Logs, cache, uploads
│   ├── logs/
│   ├── cache/
│   └── uploads/
├── vendor/              # Composer dependencies
├── .env                 # Environment config
├── composer.json        # Dependencies
└── README.md           # This file
```

---

## 🔐 Security

### Features
- ✅ Password hashing (bcrypt)
- ✅ CSRF protection
- ✅ SQL injection prevention
- ✅ XSS protection
- ✅ File upload validation
- ✅ Session management
- ✅ Role-based access control

### Best Practices
- Change default passwords
- Use HTTPS in production
- Regular security updates
- Strong password policy
- Regular backups

---

## 🧪 Testing

```bash
# Run all tests
php spark test

# Run specific test
php spark test --group database

# Run with coverage
php spark test --coverage
```

---

## 📈 Roadmap

### ✅ Phase 1 - Core Features (Complete)
- [x] 6 modul CRUD lengkap
- [x] Verification system
- [x] Revision workflow
- [x] File upload
- [x] Auto-calculation
- [x] Role-based access

### 🚧 Phase 2 - Enhancements (In Progress)
- [ ] Email notifications
- [ ] Data export (Excel/PDF)
- [ ] Advanced search & filter
- [ ] Dashboard charts

### 📅 Phase 3 - Advanced Features (Planned)
- [ ] REST API
- [ ] Mobile app
- [ ] Real-time notifications
- [ ] Bulk operations
- [ ] Advanced reporting

---

## 🤝 Contributing

Sistem ini dikembangkan dan dimaintain oleh Tim UI GreenMetric Polban.

### Development Workflow
1. Create feature branch
2. Make changes
3. Test thoroughly
4. Submit for review
5. Merge to main

### Code Standards
- Follow PSR-12 coding standards
- Write meaningful comments
- Use descriptive variable names
- Test before commit

---

## 📞 Support

### Technical Support
- **Email:** support@polban.ac.id
- **Phone:** +62-22-1234567
- **Hours:** Mon-Fri, 08:00-16:00 WIB

### Project Team
- **Email:** greenmetric@polban.ac.id
- **Website:** https://polban.ac.id

### Documentation Issues
Jika menemukan error atau informasi yang kurang jelas dalam dokumentasi, silakan hubungi support.

---

## 📄 License

Copyright © 2025 Politeknik Negeri Bandung  
Internal use only - All rights reserved

---

## 🙏 Acknowledgments

### UI GreenMetric Team Polban
Terima kasih kepada seluruh tim yang telah berkontribusi dalam pengembangan sistem ini.

### UI GreenMetric World University Rankings
Sistem ini dikembangkan untuk mendukung partisipasi Polban dalam UI GreenMetric Rankings.

### Open Source Community
Terima kasih kepada komunitas open source untuk tools dan libraries yang digunakan:
- CodeIgniter Framework
- Bootstrap
- Font Awesome
- jQuery
- Dan banyak lagi...

---

## 📊 Statistics

- **Total Modules:** 6
- **Total Features:** 36+
- **Total Endpoints:** 90+
- **Total Database Tables:** 15
- **Lines of Code:** ~15,000+
- **Documentation Pages:** 250+

---

## 🔗 Links

### Internal
- [Documentation Index](DOCUMENTATION_INDEX.md)
- [User Guide](USER_GUIDE.md)
- [API Documentation](API_ENDPOINTS_DOCUMENTATION.md)

### External
- [UI GreenMetric Official](https://greenmetric.ui.ac.id)
- [Polban Website](https://polban.ac.id)
- [CodeIgniter 4](https://codeigniter.com)
- [SDGs Information](https://sdgs.un.org)

---

## 📸 Screenshots

### Dashboard
![Dashboard](docs/screenshots/dashboard.png)

### Data List
![Data List](docs/screenshots/data-list.png)

### Create Form
![Create Form](docs/screenshots/create-form.png)

### Verification
![Verification](docs/screenshots/verification.png)

*(Screenshots coming soon)*

---

## 🎓 Training

### Available Training
- **Basic User Training** (4 hours)
- **Admin Training** (8 hours)
- **Developer Training** (16 hours)
- **System Admin Training** (8 hours)

### Schedule Training
Contact: greenmetric@polban.ac.id

---

## 📝 Changelog

### Version 1.0.0 (2025-11-14)
- ✅ Initial release
- ✅ 6 modules complete
- ✅ Full CRUD functionality
- ✅ Verification system
- ✅ Revision workflow
- ✅ Complete documentation

[View Full Changelog](CHANGELOG.md)

---

## ⭐ Features Highlight

### 🔢 Auto-calculation
Sistem otomatis menghitung persentase capaian berdasarkan input data.

### ✅ Smart Verification
Workflow verifikasi yang efisien dengan catatan dan tracking.

### 🔄 Flexible Revision
Request revisi untuk data yang sudah approved dengan approval workflow.

### 📤 Secure Upload
Upload file dengan validasi tipe dan ukuran untuk keamanan.

### 👥 Role Management
Granular access control berdasarkan role pengguna.

### 📊 Real-time Preview
Preview perhitungan secara real-time saat input data.

---

## 🎯 Goals & Objectives

### Short Term
- ✅ Complete all 6 modules
- ✅ Implement verification system
- ✅ Deploy to production
- [ ] Train all users

### Medium Term
- [ ] Add email notifications
- [ ] Implement data export
- [ ] Add advanced reporting
- [ ] Mobile responsive improvements

### Long Term
- [ ] Develop mobile app
- [ ] API for integrations
- [ ] AI-powered validation
- [ ] Multi-language support

---

## 💡 Tips

### For Users
- Backup files before upload
- Use descriptive filenames
- Check calculations before submit
- Read verification notes carefully

### For Admins
- Regular database backups
- Monitor error logs
- Keep system updated
- Document configuration changes

### For Developers
- Follow coding standards
- Write tests
- Document code
- Use version control

---

## 🏆 Best Practices

1. **Data Entry**
   - Double-check data accuracy
   - Use official sources
   - Add clear descriptions
   - Upload quality files

2. **Verification**
   - Review thoroughly
   - Provide constructive feedback
   - Be consistent
   - Document decisions

3. **System Maintenance**
   - Regular backups
   - Monitor performance
   - Update regularly
   - Security audits

---

## 📞 Emergency Contacts

### System Down
- **Admin:** admin@polban.ac.id
- **Phone:** +62-22-1234567 (ext. 123)

### Data Issues
- **Support:** support@polban.ac.id
- **Response:** 4 hours

### Security Issues
- **Security:** security@polban.ac.id
- **Response:** Immediate

---

## 🌟 Success Stories

*Coming soon - Share your success stories using this system!*

---

## 📢 Announcements

### Latest Updates
- **2025-11-14:** System v1.0.0 released! 🎉
- **2025-11-14:** Complete documentation available
- **2025-11-14:** All 6 modules operational

### Upcoming
- Training sessions scheduled
- Video tutorials in production
- Mobile app development starting

---

## 🎉 Thank You!

Terima kasih telah menggunakan Sistem UI GreenMetric CRUD!

Untuk pertanyaan, saran, atau feedback, jangan ragu untuk menghubungi kami.

**Mari bersama-sama berkontribusi untuk kampus yang lebih berkelanjutan! 🌱**

---

**Last Updated:** 2025-11-14  
**Version:** 1.0.0  
**Status:** Production Ready ✅

---

*Developed with ❤️ by UI GreenMetric Team Polban*
