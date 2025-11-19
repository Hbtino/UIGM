<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 3px solid #149823ff;
        }
        .header h1 {
            color: #149823ff;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .header p {
            color: #666;
            font-size: 16px;
        }
        .section-title {
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin: 30px 0 20px;
            font-weight: 700;
            font-size: 18px;
        }
        .table {
            margin-bottom: 30px;
        }
        .table thead {
            background: #149823ff;
            color: white;
        }
        .table thead th {
            padding: 15px;
            font-weight: 600;
            border: none;
        }
        .table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        .btn-back {
            background: #6c757d;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background: #5a6268;
            color: white;
        }
        .note-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .note-box strong {
            color: #856404;
        }
        .note-box p {
            margin: 5px 0 0;
            color: #856404;
        }
        .form-input {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
        }
        .file-upload {
            position: relative;
        }
        .file-upload input[type="file"] {
            font-size: 13px;
            padding: 6px;
        }
        .file-upload .file-name {
            font-size: 11px;
            color: #666;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('dashboard') ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        
        <div class="header">
            <h1><i class="fas fa-file-alt"></i> Laporan UI GreenMetric</h1>
            <p>Form Pelaporan Kontribusi Dosen untuk UI GreenMetric World University Ranking</p>
            <p><strong>Periode: <?= $laporan_data['periode'] ?></strong></p>
        </div>

        <!-- Section 1: Info Dosen -->
        <div class="section-title">
            1. Informasi Dosen
        </div>
        <table class="table table-bordered">
            <tr>
                <td width="30%"><strong>Nama Dosen</strong></td>
                <td>
                    <?php if ($user_role === 'admin'): ?>
                        <!-- Admin bisa mengganti nama dosen -->
                        <select class="form-input" name="dosen_id">
                            <option value="">-- Pilih Dosen --</option>
                            <?php if (isset($dosen_list) && is_array($dosen_list)): ?>
                                <?php foreach ($dosen_list as $dosen): ?>
                                    <option value="<?= esc($dosen['id']) ?>" <?= ($dosen['id'] == $user_id) ? 'selected' : '' ?>>
                                        <?= esc($dosen['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <!-- Dosen tidak bisa mengganti (readonly) -->
                        <input type="text" class="form-input" value="<?= esc($user_name) ?>" readonly style="background: #e9ecef; cursor: not-allowed;">
                        <input type="hidden" name="dosen_id" value="<?= esc($user_id) ?>">
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><strong>Jurusan</strong></td>
                <td><input type="text" class="form-input" placeholder="Masukkan jurusan"></td>
            </tr>
            <tr>
                <td><strong>Program Studi</strong></td>
                <td><input type="text" class="form-input" placeholder="Masukkan program studi"></td>
            </tr>
        </table>

        <!-- Section 2: Kursus/Mata Kuliah -->
        <div class="section-title">
            2. Kursus/Mata Kuliah tentang Keberlanjutan (Sustainability Courses)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="10%">Kode MK</th>
                    <th width="20%">Nama Mata Kuliah</th>
                    <th width="35%">Deskripsi Relevansi dengan Isu Lingkungan/SDGs</th>
                    <th width="10%">Jumlah SKS</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="[Kode]"></td>
                    <td><input type="text" class="form-input" placeholder="[Nama MK]"></td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Mencakup 30% materi tentang energi terbarukan"></td>
                    <td><input type="text" class="form-input" placeholder="[SKS]"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="[Kode]"></td>
                    <td><input type="text" class="form-input" placeholder="[Nama MK]"></td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Fokus utama pada ekologi perkotaan"></td>
                    <td><input type="text" class="form-input" placeholder="[SKS]"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 3: Acara Ilmiah -->
        <div class="section-title">
            3. Acara Ilmiah (Seminar/Workshop/Pengabdian Masyarakat)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama Acara</th>
                    <th width="15%">Tanggal Pelaksanaan</th>
                    <th width="15%">Peran (Narasumber/Peserta/Panitia)</th>
                    <th width="25%">Topik</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="[Nama Acara]"></td>
                    <td><input type="date" class="form-input"></td>
                    <td>
                        <select class="form-input">
                            <option>Narasumber</option>
                            <option>Peserta</option>
                            <option>Panitia</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Pengelolaan Air Bersih"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="[Nama Acara]"></td>
                    <td><input type="date" class="form-input"></td>
                    <td>
                        <select class="form-input">
                            <option>Narasumber</option>
                            <option>Peserta</option>
                            <option>Panitia</option>
                        </select>
                    </td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Hari Lingkungan Hidup"></td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 4: Praktik Ramah Lingkungan -->
        <div class="section-title">
            4. Praktik Ramah Lingkungan di Area Kerja/Lab
        </div>
        <p><strong>Kategori WS: Waste (Limbah) & EC: Energy & Climate Change (Energi & Perubahan Iklim)</strong></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Inisiatif/Program</th>
                    <th width="40%">Deskripsi Pelaksanaan</th>
                    <th width="10%">Kategori (WS/EC)</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Gerakan Paperless"></td>
                    <td><input type="text" class="form-input" placeholder="Mengurangi penggunaan kertas di departemen"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Manajemen Limbah B3 Lab"></td>
                    <td><input type="text" class="form-input" placeholder="Implementasi SOP pemilahan limbah kimia"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Efisiensi Energi Lab"></td>
                    <td><input type="text" class="form-input" placeholder="Penggunaan peralatan lab berlabel hemat energi"></td>
                    <td>
                        <select class="form-input">
                            <option>WS</option>
                            <option>EC</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 5: Kontribusi Kebijakan -->
        <div class="section-title">
            5. Kontribusi Kebijakan atau Infrastruktur (Opsional)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Bentuk Kontribusi</th>
                    <th width="40%">Deskripsi Detail</th>
                    <th width="10%">Kategori (WR/TR/SI)</th>
                    <th width="20%">Bukti Dukung (Lampiran)*</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Penggunaan Transportasi Publik"></td>
                    <td><input type="text" class="form-input" placeholder="Komitmen pribadi penggunaan transportasi publik ke kampus"></td>
                    <td>
                        <select class="form-input">
                            <option>TR</option>
                            <option>WR</option>
                            <option>SI</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td><input type="text" class="form-input" placeholder="Contoh: Penghematan Air"></td>
                    <td><input type="text" class="form-input" placeholder="Pemasangan poster edukasi penghematan air di toilet fakultas"></td>
                    <td>
                        <select class="form-input">
                            <option>TR</option>
                            <option>WR</option>
                            <option>SI</option>
                        </select>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Note Box -->
        <div class="note-box">
            <strong>Keterangan:</strong>
            <p>*Bukti Dukung sangat krusial. UI GreenMetric membutuhkan bukti fisik (foto <em>geotagged</em>, dokumen PDF yang ditandatangani, tautan web resmi) untuk memvalidasi setiap klaim data.</p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <button class="btn btn-success btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-save"></i> Simpan Laporan
            </button>
            <button class="btn btn-primary btn-lg ms-2" style="padding: 12px 40px;">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
