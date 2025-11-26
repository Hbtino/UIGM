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
            max-width: 1400px;
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
        .section-subtitle {
            background: #f8f9fa;
            padding: 10px 15px;
            border-left: 4px solid #149823ff;
            margin: 20px 0 15px;
            font-weight: 600;
            color: #333;
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
            vertical-align: middle;
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
        .intro-box {
            background: #e7f3ff;
            border-left: 4px solid #0d6efd;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .intro-box p {
            margin: 8px 0;
            color: #084298;
            line-height: 1.6;
        }
        .form-input {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
        }
        .form-textarea {
            background: #f8f9fa;
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            width: 100%;
            min-height: 80px;
            resize: vertical;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="<?= base_url('dashboard') ?>" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>
        
        <div class="header">
            <h1><i class="fas fa-file-alt"></i> Laporan Program Studi - UI GreenMetric</h1>
            <p>Form Pelaporan Kontribusi Program Studi untuk UI GreenMetric World University Ranking</p>
            <p><strong>Periode: <?= $laporan_data['periode'] ?></strong></p>
            <?php if (isset($last_saved) && $last_saved): ?>
                <div class="alert alert-info mt-3" style="font-size: 14px;">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Laporan terakhir disimpan:</strong> 
                    <?php
                        $date = new DateTime($last_saved);
                        echo $date->format('d F Y, H:i:s');
                    ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Section 0: Pendahuluan -->
        <div class="intro-box">
            <h5 style="color: #084298; font-weight: 700; margin-bottom: 15px;">1.0 Pendahuluan</h5>
            <p>Laporan ini merinci kontribusi Program Studi terhadap inisiatif UI GreenMetric. Ini adalah komitmen kami untuk mengintegrasikan prinsip-prinsip pembangunan berkelanjutan dalam pendidikan, penelitian, dan operasional harian, sejalan dengan visi universitas.</p>
        </div>

        <!-- Section 1: Info Program Studi -->
        <div class="section-title">
            Informasi Program Studi
        </div>
        <table class="table table-bordered">
            <tr>
                <td width="30%"><strong>Nama Program Studi</strong></td>
                <td>
                    <?php if ($user_role === 'admin'): ?>
                        <select class="form-input" name="prodi_id">
                            <option value="">-- Pilih Program Studi --</option>
                            <?php if (isset($prodi_list) && is_array($prodi_list)): ?>
                                <?php foreach ($prodi_list as $prodi): ?>
                                    <option value="<?= esc($prodi['id']) ?>" <?= ($prodi['id'] == $user_prodi_id) ? 'selected' : '' ?>>
                                        <?= esc($prodi['nama']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    <?php else: ?>
                        <input type="text" class="form-input" value="<?= esc($prodi_name) ?>" readonly style="background: #e9ecef; cursor: not-allowed;">
                        <input type="hidden" name="prodi_id" value="<?= esc($user_prodi_id) ?>">
                    <?php endif; ?>
                </td>
            </tr>
            <?php if ($user_role === 'admin'): ?>
            <tr>
                <td><strong>Pilih Kaprodi (Admin)</strong></td>
                <td>
                    <select class="form-input" name="kaprodi_id" id="kaprodi_select">
                        <option value="">-- Pilih Kaprodi --</option>
                        <?php if (isset($prodi_list) && is_array($prodi_list)): ?>
                            <?php 
                            // Get list of kaprodi users
                            $userModel = new \App\Models\UserModel();
                            $kaprodiUsers = $userModel->where('role', 'kaprodi')->findAll();
                            foreach ($kaprodiUsers as $kaprodi): 
                            ?>
                                <option value="<?= esc($kaprodi['id']) ?>" <?= ($kaprodi['id'] == $user_id) ? 'selected' : '' ?>>
                                    <?= esc($kaprodi['name']) ?> (<?= esc($kaprodi['email']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <small style="color: #666; display: block; margin-top: 5px;">
                        <i class="fas fa-info-circle"></i> Admin dapat membuat laporan atas nama kaprodi yang dipilih
                    </small>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <td><strong>Nama Lengkap Kaprodi dan Gelar</strong></td>
                <td><input type="text" id="kaprodi_name" class="form-input" placeholder="Contoh: Dr. Ahmad Budiman, S.T., M.T." value="<?= isset($saved_data['kaprodi_name']) ? esc($saved_data['kaprodi_name']) : '' ?>"></td>
            </tr>
            <tr>
                <td><strong>Jurusan</strong></td>
                <td><input type="text" id="jurusan" class="form-input" placeholder="Masukkan jurusan" value="<?= isset($saved_data['jurusan']) ? esc($saved_data['jurusan']) : '' ?>"></td>
            </tr>
            <tr>
                <td><strong>Tanggal Laporan</strong></td>
                <td><input type="date" id="tanggal_laporan" class="form-input" value="<?= isset($saved_data['tanggal_laporan']) ? esc($saved_data['tanggal_laporan']) : date('Y-m-d') ?>"></td>
            </tr>
        </table>

        <!-- Section 2: Kontribusi Berdasarkan Kriteria -->
        <div class="section-title">
            2.0 Kontribusi Berdasarkan Kriteria UI GreenMetric
        </div>

        <div class="note-box">
            <strong>Panduan Pengisian:</strong>
            <p>• Kolom "Kegiatan/Inisiatif" diisi dengan deskripsi singkat tentang apa yang telah Anda lakukan.</p>
            <p>• Kolom "Data Kuantitatif/Kualitatif (Bukti)" adalah bagian terpenting. Tim penilai UI GreenMetric sangat membutuhkan bukti konkret (data, foto, dokumen) untuk memvalidasi klaim Anda. Pastikan setiap klaim didukung oleh lampiran yang jelas.</p>
        </div>

        <!-- SI: Setting and Infrastructure -->
        <div class="section-subtitle">
            <i class="fas fa-building"></i> SI (Setting and Infrastructure)
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Penggunaan ruang efisien:</strong><br>
                        <small>Memaksimalkan penggunaan ruang kelas dan laboratorium bersama.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Jadwal penggunaan ruang kelas yang terkoordinasi.&#10;- Denah tata ruang prodi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Area hijau:</strong><br>
                        <small>Menata taman atau area hijau di sekitar gedung prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto-foto area hijau.&#10;- Deskripsi jenis tanaman/penghijauan yang dilakukan."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Fasilitas bagi pejalan kaki/difabel:</strong><br>
                        <small>Memastikan akses yang mudah dan aman di lingkungan prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto jalur pejalan kaki/rambu-rambu/jalur difabel."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- EC: Energy and Climate Change -->
        <div class="section-subtitle">
            <i class="fas fa-bolt"></i> EC (Energy and Climate Change)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Kebijakan penghematan energi:</strong><br>
                        <small>Menerapkan SOP pemadaman listrik/AC saat tidak digunakan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Salinan SOP atau pengumuman tertulis.&#10;- Foto stiker/tanda pengingat penghematan energi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Peralatan hemat energi:</strong><br>
                        <small>Menggunakan lampu LED, komputer bersertifikasi energy star, dll.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Data inventarisasi peralatan (jumlah unit lampu LED, AC inverter, dll).&#10;- Foto peralatan (lampu LED, komputer/monitor, dll)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Pengukuran emisi karbon:</strong><br>
                        <small>Jika ada inisiatif penghitungan emisi dari kegiatan prodi.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Hasil perhitungan emisi (jika tersedia) atau deskripsi singkat kebijakan pengurangan perjalanan dinas."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- WS: Waste -->
        <div class="section-subtitle">
            <i class="fas fa-recycle"></i> WS (Waste)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Pemilahan sampah:</strong><br>
                        <small>Menyediakan tempat sampah terpisah (organik, anorganik, B3).</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto tempat sampah terpisah.&#10;- Jumlah titik tempat pemilahan sampah di area prodi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Pengurangan penggunaan kertas & plastik:</strong><br>
                        <small>Menerapkan sistem administrasi digital, mengurangi print out.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Kebijakan administrasi digital.&#10;- Foto dispenser air minum untuk mengurangi botol plastik."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Pengelolaan limbah B3 (jika ada lab):</strong><br>
                        <small>Pengelolaan limbah bahan berbahaya dan beracun sesuai standar.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Dokumen MOU dengan pengelola limbah B3 tersertifikasi (misal: untuk limbah lab kimia)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- WR: Water -->
        <div class="section-subtitle">
            <i class="fas fa-tint"></i> WR (Water)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Konservasi air:</strong><br>
                        <small>Pemasangan poster edukasi, perbaikan kebocoran.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto poster edukasi hemat air.&#10;- Laporan perbaikan sistem perairan (misal: perbaikan keran bocor)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Penggunaan kembali air:</strong><br>
                        <small>Jika prodi memiliki sistem daur ulang air (misal: untuk siram tanaman).</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Deskripsi sistem daur ulang air (jika ada)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- TR: Transportation -->
        <div class="section-subtitle">
            <i class="fas fa-bus"></i> TR (Transportation)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Sosialisasi transportasi hijau:</strong><br>
                        <small>Mendorong penggunaan transportasi umum atau sepeda.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Salinan email/pengumuman/poster sosialisasi."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Aksesibilitas:</strong><br>
                        <small>Memastikan kemudahan akses dari halte bus atau stasiun terdekat.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Deskripsi jarak prodi ke halte terdekat."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- ER: Education and Research -->
        <div class="section-subtitle">
            <i class="fas fa-graduation-cap"></i> ER (Education and Research)
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Kegiatan/Inisiatif Program Studi</th>
                    <th width="40%">Data Kuantitatif/Kualitatif (Bukti)</th>
                    <th width="20%">Lampiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <strong>Integrasi kurikulum:</strong><br>
                        <small>Memasukkan aspek keberlanjutan dalam mata kuliah.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Daftar mata kuliah yang mencakup topik keberlanjutan (beserta credit point dan deskripsi singkat topik yang diajarkan).&#10;- Salinan silabus/RPS (Rencana Pembelajaran Semester)."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <strong>Penelitian/Publikasi:</strong><br>
                        <small>Penelitian dosen dan mahasiswa tentang isu lingkungan/keberlanjutan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Daftar judul skripsi/tesis/penelitian dosen (minimal 5-10 judul) dalam 3 tahun terakhir yang relevan.&#10;- Daftar publikasi ilmiah (jurnal/prosiding) terkait."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <strong>Kegiatan/Seminar:</strong><br>
                        <small>Menyelenggarakan kegiatan ilmiah bertema keberlanjutan.</small>
                        <textarea class="form-textarea" placeholder="Deskripsi detail kegiatan..."></textarea>
                    </td>
                    <td>
                        <textarea class="form-textarea" placeholder="- Foto kegiatan (seminar/webinar/lokakarya).&#10;- Pamflet atau rundown acara."></textarea>
                    </td>
                    <td><input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"></td>
                </tr>
            </tbody>
        </table>

        <!-- Section 3: Penutup -->
        <div class="section-title">
            3.0 Penutup
        </div>
        <div class="intro-box">
            <p>Program Studi <strong>[Nama Program Studi]</strong> akan terus berkomitmen untuk mengimplementasikan kebijakan dan program yang mendukung keberlanjutan lingkungan. Kami berharap laporan ini dapat memberikan kontribusi positif terhadap pemeringkatan UI GreenMetric Universitas <strong>[Nama Universitas Anda]</strong>.</p>
            <br>
            <p><strong>[Tempat], [Tanggal]</strong></p>
            <p>Hormat kami,</p>
            <br>
            <p><strong>(Tanda tangan Kaprodi)</strong></p>
            <br>
            <p><strong>[Nama Lengkap Kaprodi dan Gelar]</strong><br>
            Ketua Program Studi <strong>[Nama Program Studi]</strong></p>
        </div>

        <!-- Note Box -->
        <div class="note-box">
            <strong>Catatan Penting:</strong>
            <p>*Bukti Dukung sangat krusial. UI GreenMetric membutuhkan bukti fisik (foto geotagged, dokumen PDF yang ditandatangani, tautan web resmi) untuk memvalidasi setiap klaim data. Pastikan semua lampiran jelas dan terorganisir dengan baik.</p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mt-4">
            <a href="<?= base_url('laporan/riwayat-kaprodi') ?>" class="btn btn-info btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-history"></i> Lihat Riwayat
            </a>
            <button id="btnSave" class="btn btn-success btn-lg" style="padding: 12px 40px;">
                <i class="fas fa-save"></i> Simpan Laporan
            </button>
            <a href="<?= base_url('laporan/export-kaprodi-pdf') ?>" class="btn btn-primary btn-lg ms-2" style="padding: 12px 40px;">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Load saved data when page loads
        window.addEventListener('DOMContentLoaded', function() {
            <?php if (isset($saved_data) && $saved_data): ?>
                const savedData = <?= json_encode($saved_data) ?>;
                
                // Load SI data
                if (savedData.si) {
                    const siData = JSON.parse(savedData.si);
                    let siIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('SI (Setting')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (siData[siIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = siData[siIndex].kegiatan || '';
                                        textareas[1].value = siData[siIndex].bukti || '';
                                    }
                                    siIndex++;
                                }
                            });
                        }
                    });
                }
                
                // Load EC data
                if (savedData.ec) {
                    const ecData = JSON.parse(savedData.ec);
                    let ecIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('EC (Energy')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (ecData[ecIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = ecData[ecIndex].kegiatan || '';
                                        textareas[1].value = ecData[ecIndex].bukti || '';
                                    }
                                    ecIndex++;
                                }
                            });
                        }
                    });
                }
                
                // Load WS data
                if (savedData.ws) {
                    const wsData = JSON.parse(savedData.ws);
                    let wsIndex = 0;
                    document.querySelectorAll('table').forEach(table => {
                        const subtitle = table.previousElementSibling;
                        if (subtitle && subtitle.textContent.includes('WS (Waste')) {
                            table.querySelectorAll('tbody tr').forEach(row => {
                                if (wsData[wsIndex]) {
                                    const textareas = row.querySelectorAll('textarea');
                                    if (textareas.length >= 2) {
                                        textareas[0].value = wsData[wsIndex].kegiatan || '';
                                        textareas[1].value = wsData[wsIndex].bukti || '';
                                    }
                                    wsIndex++;
                                }
                            });
                        }
                    });
                }
            <?php endif; ?>
        });
        
        document.getElementById('btnSave').addEventListener('click', function() {
            const formData = new FormData();
            
            // Info Prodi
            formData.append('user_id', <?= $user_id ?>);
            formData.append('user_name', '<?= esc($user_name) ?>');
            
            // Check if admin selected different kaprodi
            const kaprodiSelect = document.getElementById('kaprodi_select');
            if (kaprodiSelect && kaprodiSelect.value) {
                formData.append('selected_kaprodi_id', kaprodiSelect.value);
                // Get selected kaprodi name
                const selectedOption = kaprodiSelect.options[kaprodiSelect.selectedIndex];
                formData.append('user_name', selectedOption.text.split(' (')[0]); // Get name without email
            }
            
            formData.append('prodi_id', <?= $user_prodi_id ?>);
            formData.append('prodi_name', document.querySelector('input[value="<?= esc($prodi_name) ?>"]')?.value || '<?= esc($prodi_name) ?>');
            formData.append('kaprodi_name', document.getElementById('kaprodi_name').value);
            formData.append('jurusan', document.getElementById('jurusan').value);
            formData.append('tanggal_laporan', document.getElementById('tanggal_laporan').value);
            
            // SI Data
            const siData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('SI (Setting')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            siData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('si', JSON.stringify(siData));
            
            // EC Data
            const ecData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('EC (Energy')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            ecData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('ec', JSON.stringify(ecData));
            
            // WS Data
            const wsData = [];
            document.querySelectorAll('table').forEach(table => {
                const subtitle = table.previousElementSibling;
                if (subtitle && subtitle.textContent.includes('WS (Waste')) {
                    table.querySelectorAll('tbody tr').forEach(row => {
                        const textareas = row.querySelectorAll('textarea');
                        if (textareas.length >= 2) {
                            wsData.push({
                                kegiatan: textareas[0].value,
                                bukti: textareas[1].value
                            });
                        }
                    });
                }
            });
            formData.append('ws', JSON.stringify(wsData));
            
            // Send data
            fetch('<?= base_url('laporan/save-kaprodi') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Laporan berhasil disimpan!');
                    // Reload page to show updated timestamp
                    window.location.reload();
                } else {
                    alert('Gagal menyimpan laporan: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan laporan');
            });
        });
    </script>
</body>
</html>
