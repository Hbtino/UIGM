# System Architecture - Transportation CRUD

## 🏗️ Architecture Overview

```
┌─────────────────────────────────────────────────────────────┐
│                        USER INTERFACE                        │
│  (Views: index, create, edit, verify, revision_list, etc.)  │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                    ROUTING LAYER                             │
│              (Routes.php + Filters)                          │
│  - Authentication Check                                      │
│  - Role-based Authorization                                  │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                  CONTROLLER LAYER                            │
│          (TransportationController.php)                      │
│  - Request Handling                                          │
│  - Business Logic                                            │
│  - File Upload Management                                    │
│  - Response Generation                                       │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                    MODEL LAYER                               │
│  - TransportationModel                                       │
│  - TransportationRevisionModel                               │
│  - UserModel                                                 │
│  - Data Validation                                           │
│  - Auto-calculation                                          │
└────────────────────────┬────────────────────────────────────┘
                         │
                         ▼
┌─────────────────────────────────────────────────────────────┐
│                   DATABASE LAYER                             │
│  - transportation table                                      │
│  - transportation_revisions table                            │
│  - users table                                               │
└─────────────────────────────────────────────────────────────┘
```

## 🔄 Data Flow Diagrams

### 1. Create Data Flow

```
┌──────────┐
│   User   │
│(Kaprodi) │
└────┬─────┘
     │
     │ 1. Fill Form + Upload File
     ▼
┌─────────────────┐
│  Create View    │
└────┬────────────┘
     │
     │ 2. POST /transportation/store
     ▼
┌──────────────────────┐
│  Controller::store() │
│  - Validate Input    │
│  - Upload File       │
│  - Calculate %       │
└────┬─────────────────┘
     │
     │ 3. Insert Data
     ▼
┌──────────────────────┐
│ TransportationModel  │
│  - Save to DB        │
│  - Status: Pending   │
└────┬─────────────────┘
     │
     │ 4. Redirect
     ▼
┌──────────────────┐
│   Index View     │
│ (Success Message)│
└──────────────────┘
```

### 2. Verification Flow

```
┌──────────┐
│ Reviewer │
└────┬─────┘
     │
     │ 1. Click Verify
     ▼
┌─────────────────┐
│  Verify View    │
│ - Show Data     │
│ - Show Evidence │
└────┬────────────┘
     │
     │ 2. POST /transportation/process-verification
     ▼
┌────────────────────────────┐
│ Controller::               │
│ processVerification()      │
│ - Validate Decision        │
│ - Update Status            │
│ - Save Verifier Info       │
└────┬───────────────────────┘
     │
     │ 3. Update Data
     ▼
┌──────────────────────┐
│ TransportationModel  │
│ - Status: Approved/  │
│   Rejected           │
│ - verified_by        │
│ - verified_at        │
└────┬─────────────────┘
     │
     │ 4. Redirect
     ▼
┌──────────────────┐
│   Index View     │
│ (Success Message)│
└──────────────────┘
```

### 3. Revision Request Flow

```
┌──────────┐
│   User   │
└────┬─────┘
     │
     │ 1. Request Revision (Approved Data)
     ▼
┌─────────────────────┐
│ Request Revision    │
│ View                │
│ - Show Current Data │
│ - Form Alasan       │
└────┬────────────────┘
     │
     │ 2. POST /transportation/submit-revision-request
     ▼
┌────────────────────────────┐
│ Controller::               │
│ submitRevisionRequest()    │
│ - Validate Alasan          │
│ - Save Snapshot            │
└────┬───────────────────────┘
     │
     │ 3. Insert Revision Request
     ▼
┌──────────────────────────────┐
│ TransportationRevisionModel  │
│ - Status: Pending            │
│ - Save Data Snapshot (JSON)  │
└────┬─────────────────────────┘
     │
     │ 4. Redirect
     ▼
┌──────────────────┐
│   Index View     │
│ (Success Message)│
└──────────────────┘
     │
     │ 5. Admin/Reviewer Reviews
     ▼
┌─────────────────────┐
│ Review Revision     │
│ View                │
└────┬────────────────┘
     │
     │ 6. Approve/Reject
     ▼
┌────────────────────────────┐
│ Controller::               │
│ processRevisionReview()    │
└────┬───────────────────────┘
     │
     ├─── If Approved ────┐
     │                    ▼
     │         ┌──────────────────────┐
     │         │ Update Transportation│
     │         │ Status: Pending      │
     │         │ (Can be edited)      │
     │         └──────────────────────┘
     │
     └─── If Rejected ───┐
                         ▼
              ┌──────────────────────┐
              │ Transportation       │
              │ Status: Approved     │
              │ (Cannot be edited)   │
              └──────────────────────┘
```

## 🗄️ Database Schema Diagram

```
┌─────────────────────────────────────────┐
│              users                       │
├─────────────────────────────────────────┤
│ id (PK)                                  │
│ name                                     │
│ email                                    │
│ password                                 │
│ role (admin/reviewer/kaprodi/user)      │
│ created_at                               │
│ updated_at                               │
└──────────────┬──────────────────────────┘
               │
               │ created_by, updated_by,
               │ verified_by
               ▼
┌─────────────────────────────────────────┐
│         transportation                   │
├─────────────────────────────────────────┤
│ id (PK)                                  │
│ tahun (UNIQUE)                           │
│ total_perjalanan                         │
│ perjalanan_ramah_lingkungan              │
│ jumlah_kendaraan                         │
│ jumlah_populasi                          │
│ rasio_kendaraan                          │
│ layanan_antar_jemput                     │
│ kebijakan_zev                            │
│ luas_parkir                              │
│ program_pembatasan_parkir                │
│ inisiatif_pengurangan_kendaraan          │
│ jalur_pejalan_kaki                       │
│ sepeda_kampus                            │
│ capaian_persen (calculated)              │
│ keterangan                               │
│ status_verifikasi                        │
│ catatan_verifikasi                       │
│ bukti_pendukung (file path)              │
│ verified_by (FK → users.id)              │
│ verified_at                              │
│ created_by (FK → users.id)               │
│ updated_by (FK → users.id)               │
│ created_at                               │
│ updated_at                               │
└──────────────┬──────────────────────────┘
               │
               │ transportation_id
               ▼
┌─────────────────────────────────────────┐
│    transportation_revisions              │
├─────────────────────────────────────────┤
│ id (PK)                                  │
│ transportation_id (FK)                   │
│ revision_type                            │
│ requested_by (FK → users.id)             │
│ alasan_revisi                            │
│ data_revisi (JSON snapshot)              │
│ status (pending/approved/rejected)       │
│ reviewed_by (FK → users.id)              │
│ review_notes                             │
│ reviewed_at                              │
│ created_at                               │
│ updated_at                               │
└─────────────────────────────────────────┘
```

## 🔐 Security Architecture

```
┌─────────────────────────────────────────┐
│         Request from User                │
└────────────────┬────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────┐
│      Authentication Filter               │
│  - Check session logged_in               │
│  - Redirect to /login if not             │
└────────────────┬────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────┐
│      Authorization Filter                │
│  - AdminFilter (admin only)              │
│  - ReviewerFilter (admin + reviewer)     │
│  - Check user role                       │
└────────────────┬────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────┐
│      Controller Level Check              │
│  - Verify user permissions               │
│  - Check data ownership                  │
│  - Validate business rules               │
└────────────────┬────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────┐
│      Model Level Validation              │
│  - Data type validation                  │
│  - Business logic validation             │
│  - Database constraints                  │
└────────────────┬────────────────────────┘
                 │
                 ▼
┌─────────────────────────────────────────┐
│      View Level Protection               │
│  - Conditional rendering                 │
│  - CSRF protection                       │
│  - XSS prevention                        │
└─────────────────────────────────────────┘
```

## 📁 File Upload Architecture

```
┌──────────────┐
│  User Upload │
│     File     │
└──────┬───────┘
       │
       ▼
┌─────────────────────────────────────┐
│  Validation                          │
│  - File type (PDF, JPG, PNG, XLSX)  │
│  - File size (max 2MB)               │
│  - File validity                     │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  Processing                          │
│  - Generate random filename          │
│  - Move to secure location           │
│  - Save path to database             │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  Storage                             │
│  writable/uploads/transportation/    │
│  - [random_name].pdf                 │
│  - [random_name].jpg                 │
│  - [random_name].xlsx                │
└──────┬──────────────────────────────┘
       │
       ▼
┌─────────────────────────────────────┐
│  Download                            │
│  - Verify user authentication        │
│  - Check file exists                 │
│  - Stream file to user               │
└─────────────────────────────────────┘
```

## 🎭 Role-Based Access Control

```
                    ┌─────────────┐
                    │   Request   │
                    └──────┬──────┘
                           │
                           ▼
                    ┌─────────────┐
                    │ Get User    │
                    │ Role        │
                    └──────┬──────┘
                           │
        ┌──────────────────┼──────────────────┐
        │                  │                  │
        ▼                  ▼                  ▼
┌──────────────┐  ┌──────────────┐  ┌──────────────┐
│    Admin     │  │   Reviewer   │  │   Kaprodi    │
├──────────────┤  ├──────────────┤  ├──────────────┤
│ - Full CRUD  │  │ - Read       │  │ - Create     │
│ - Verify     │  │ - Verify     │  │ - Edit       │
│ - Review Rev │  │ - Review Rev │  │   (Pending)  │
│ - Delete     │  │              │  │ - Request    │
│              │  │              │  │   Revision   │
└──────────────┘  └──────────────┘  └──────────────┘
```

## 🔄 State Machine - Data Status

```
                    ┌─────────┐
                    │  START  │
                    └────┬────┘
                         │
                         │ Create Data
                         ▼
                  ┌─────────────┐
            ┌────▶│   PENDING   │◀────┐
            │     └──────┬──────┘     │
            │            │             │
            │            │ Verify      │
            │            ▼             │
            │     ┌─────────────┐     │
            │     │  APPROVED   │     │
            │     └──────┬──────┘     │
            │            │             │
            │            │ Request     │
            │            │ Revision    │
            │            │ (Approved)  │
            │            └─────────────┘
            │
            │ Verify (Reject)
            │
            │     ┌─────────────┐
            └─────│  REJECTED   │
                  └─────────────┘
```

## 📊 Component Interaction

```
┌────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                   │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │  Index   │  │  Create  │  │  Edit    │             │
│  │  View    │  │  View    │  │  View    │             │
│  └──────────┘  └──────────┘  └──────────┘             │
│  ┌──────────┐  ┌──────────┐  ┌──────────┐             │
│  │  Verify  │  │ Revision │  │  Review  │             │
│  │  View    │  │  List    │  │ Revision │             │
│  └──────────┘  └──────────┘  └──────────┘             │
└────────────────────┬───────────────────────────────────┘
                     │
                     ▼
┌────────────────────────────────────────────────────────┐
│                   BUSINESS LOGIC LAYER                  │
│  ┌─────────────────────────────────────────────────┐   │
│  │      TransportationController                   │   │
│  │  - index()                                      │   │
│  │  - create() / store()                           │   │
│  │  - edit() / update()                            │   │
│  │  - delete()                                     │   │
│  │  - verify() / processVerification()             │   │
│  │  - requestRevision() / submitRevisionRequest()  │   │
│  │  - revisionList() / reviewRevision()            │   │
│  │  - processRevisionReview()                      │   │
│  │  - myRevisions()                                │   │
│  │  - download()                                   │   │
│  └─────────────────────────────────────────────────┘   │
└────────────────────┬───────────────────────────────────┘
                     │
                     ▼
┌────────────────────────────────────────────────────────┐
│                    DATA ACCESS LAYER                    │
│  ┌──────────────────────┐  ┌──────────────────────┐    │
│  │ TransportationModel  │  │ TransportationRev... │    │
│  │ - CRUD Operations    │  │ - Revision CRUD      │    │
│  │ - Validation         │  │ - Get with Users     │    │
│  │ - Auto-calculation   │  │ - Pending Count      │    │
│  └──────────────────────┘  └──────────────────────┘    │
│  ┌──────────────────────┐                              │
│  │     UserModel        │                              │
│  │ - User Management    │                              │
│  └──────────────────────┘                              │
└────────────────────┬───────────────────────────────────┘
                     │
                     ▼
┌────────────────────────────────────────────────────────┐
│                    DATABASE LAYER                       │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐ │
│  │transportation│  │transportation│  │    users     │ │
│  │    table     │  │  _revisions  │  │    table     │ │
│  └──────────────┘  └──────────────┘  └──────────────┘ │
└────────────────────────────────────────────────────────┘
```

---

**Note:** Diagram ini memberikan gambaran visual tentang arsitektur sistem. Untuk detail implementasi, lihat dokumentasi lainnya.
