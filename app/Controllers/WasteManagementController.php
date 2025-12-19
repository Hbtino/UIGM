<?php

namespace App\Controllers;

use App\Models\WasteManagementModel;
use App\Models\WasteManagementRevisionModel;

class WasteManagementController extends BaseController
{
    protected $model;
    protected $revisionModel;
    protected $session;

    public function __construct()
    {
        $this->model = new WasteManagementModel();
        $this->revisionModel = new WasteManagementRevisionModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    /**
     * Display overview page for Waste Management criteria
     */
    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($this->session->get('user_id'));

        // Get related statistics for Waste Management
        $relatedStats = $this->getRelatedStats();

        $data = [
            // Required data for sidebar layout
            'title' => 'Waste Management (WS)',
            'page' => 'waste-management',
            'breadcrumb' => 'Home / Kriteria SDGs / Pengelolaan Limbah',
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null,

            // Page specific data
            'relatedStats' => $relatedStats,
            'criteriaInfo' => [
                'name' => 'Waste Management (WS)',
                'description' => 'Pengelolaan limbah berkelanjutan melalui program reduce, reuse, recycle, pengolahan limbah organik dan anorganik, serta penerapan zero waste campus.',
                'icon' => 'fas fa-recycle',
                'color' => '#149823ff'
            ]
        ];

        return view('criteria/waste_management', $data);
    }

    /**
     * Display data management page for Waste Management
     */
    public function dataManagement()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($this->session->get('user_id'));

        $data = [
            'title' => 'Waste Management - Data Capaian',
            'page' => 'waste-management',
            'breadcrumb' => 'Home / Kriteria SDGs / Pengelolaan Limbah',
            'WasteManagement' => $this->model->getAllWithUsers(),
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('kriteria/waste_management/index', $data);
    }

    /**
     * Get related statistics for Waste Management
     */
    private function getRelatedStats()
    {
        // Get latest waste management data from database
        $latestData = $this->model->orderBy('tahun', 'DESC')->first();

        if ($latestData) {
            // Calculate total sampah from database
            $totalSampah = $latestData['total_sampah_anorganik_bersih'] +
                $latestData['total_sampah_anorganik_kotor'] +
                $latestData['total_sampah_organik'] +
                ($latestData['total_limbah_air'] * 0.001) + // Convert L to kg
                $latestData['total_limbah_b3'];

            return [
                'total_sampah' => number_format($totalSampah, 0) . ' kg',
                'total_progress' => min(100, ($totalSampah / 5000) * 100), // Assuming 5000kg target
                'categories' => [
                    [
                        'label' => 'Sampah Anorganik Bersih',
                        'value' => number_format($latestData['total_sampah_anorganik_bersih'], 0) . ' kg',
                        'icon' => 'fas fa-recycle',
                        'progress' => min(100, ($latestData['total_sampah_anorganik_bersih'] / 1500) * 100),
                        'color' => 'primary'
                    ],
                    [
                        'label' => 'Sampah Anorganik Kotor',
                        'value' => number_format($latestData['total_sampah_anorganik_kotor'], 0) . ' kg',
                        'icon' => 'fas fa-trash',
                        'progress' => min(100, ($latestData['total_sampah_anorganik_kotor'] / 1000) * 100),
                        'color' => 'warning'
                    ],
                    [
                        'label' => 'Sampah Organik',
                        'value' => number_format($latestData['total_sampah_organik'], 0) . ' kg',
                        'icon' => 'fas fa-leaf',
                        'progress' => min(100, ($latestData['total_sampah_organik'] / 1500) * 100),
                        'color' => 'success'
                    ],
                    [
                        'label' => 'Limbah Air',
                        'value' => number_format($latestData['total_limbah_air'], 0) . ' L',
                        'icon' => 'fas fa-tint',
                        'progress' => min(100, ($latestData['total_limbah_air'] / 3000) * 100),
                        'color' => 'info'
                    ],
                    [
                        'label' => 'Limbah Berbahaya (B3)',
                        'value' => number_format($latestData['total_limbah_b3'], 0) . ' kg',
                        'icon' => 'fas fa-exclamation-triangle',
                        'progress' => min(100, ($latestData['total_limbah_b3'] / 200) * 100),
                        'color' => 'danger'
                    ]
                ]
            ];
        } else {
            // Default values if no data exists
            return [
                'total_sampah' => '4,425 kg',
                'total_progress' => 65,
                'categories' => [
                    [
                        'label' => 'Sampah Anorganik Bersih',
                        'value' => '1,200 kg',
                        'icon' => 'fas fa-recycle',
                        'progress' => 75,
                        'color' => 'primary'
                    ],
                    [
                        'label' => 'Sampah Anorganik Kotor',
                        'value' => '850 kg',
                        'icon' => 'fas fa-trash',
                        'progress' => 60,
                        'color' => 'warning'
                    ],
                    [
                        'label' => 'Sampah Organik',
                        'value' => '1,250 kg',
                        'icon' => 'fas fa-leaf',
                        'progress' => 80,
                        'color' => 'success'
                    ],
                    [
                        'label' => 'Limbah Air',
                        'value' => '2,500 L',
                        'icon' => 'fas fa-tint',
                        'progress' => 45,
                        'color' => 'info'
                    ],
                    [
                        'label' => 'Limbah Berbahaya (B3)',
                        'value' => '125 kg',
                        'icon' => 'fas fa-exclamation-triangle',
                        'progress' => 30,
                        'color' => 'danger'
                    ]
                ]
            ];
        }
    }

    /**
     * Show create form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Data Energy & Climate Change',
            'validation' => \Config\Services::validation(),
        ];

        return view('kriteria/waste_management/create', $data);
    }

    /**
     * Store new waste management data
     */
    public function store()
    {
        // Validation rules for waste management
        $rules = [
            'tahun' => 'required|integer|is_unique[waste_management.tahun]',
            'jenis_sampah' => 'required|in_list[sampah_anorganik_bersih,sampah_anorganik_kotor,sampah_organik,limbah_air,limbah_b3]',
            'total_sampah_anorganik_bersih' => 'required|decimal|greater_than_equal_to[0]',
            'total_sampah_anorganik_kotor' => 'required|decimal|greater_than_equal_to[0]',
            'total_sampah_organik' => 'required|decimal|greater_than_equal_to[0]',
            'total_limbah_air' => 'required|decimal|greater_than_equal_to[0]',
            'total_limbah_b3' => 'required|decimal|greater_than_equal_to[0]',
            'program_reduce' => 'required|integer|greater_than_equal_to[0]',
            'program_reuse' => 'required|integer|greater_than_equal_to[0]',
            'program_recycle' => 'required|integer|greater_than_equal_to[0]',
            'tempat_sampah_terpilah' => 'required|integer|greater_than_equal_to[0]',
            'kompos_organik' => 'required|decimal|greater_than_equal_to[0]',
            'daur_ulang_persentase' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
            'zero_waste_program' => 'required|in_list[0,1]',
            'bank_sampah' => 'required|in_list[0,1]',
            'capaian_persen' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
            'bukti_pendukung' => 'uploaded[bukti_pendukung]|max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle file upload
        $file = $this->request->getFile('bukti_pendukung');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/waste_management', $fileName);
        }

        // Calculate total sampah keseluruhan
        $anorganikBersih = floatval($this->request->getPost('total_sampah_anorganik_bersih'));
        $anorganikKotor = floatval($this->request->getPost('total_sampah_anorganik_kotor'));
        $organik = floatval($this->request->getPost('total_sampah_organik'));
        $limbahAir = floatval($this->request->getPost('total_limbah_air'));
        $limbahB3 = floatval($this->request->getPost('total_limbah_b3'));

        // Convert liter to kg for limbah air (assuming 1 liter = 0.001 kg for calculation)
        $totalSampah = $anorganikBersih + $anorganikKotor + $organik + ($limbahAir * 0.001) + $limbahB3;

        // Prepare data
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'jenis_sampah' => $this->request->getPost('jenis_sampah'),
            'total_sampah_anorganik_bersih' => $anorganikBersih,
            'total_sampah_anorganik_kotor' => $anorganikKotor,
            'total_sampah_organik' => $organik,
            'total_limbah_air' => $limbahAir,
            'total_limbah_b3' => $limbahB3,
            'total_sampah_keseluruhan' => $totalSampah,
            'program_reduce' => $this->request->getPost('program_reduce'),
            'program_reuse' => $this->request->getPost('program_reuse'),
            'program_recycle' => $this->request->getPost('program_recycle'),
            'tempat_sampah_terpilah' => $this->request->getPost('tempat_sampah_terpilah'),
            'kompos_organik' => $this->request->getPost('kompos_organik'),
            'daur_ulang_persentase' => $this->request->getPost('daur_ulang_persentase'),
            'zero_waste_program' => $this->request->getPost('zero_waste_program'),
            'bank_sampah' => $this->request->getPost('bank_sampah'),
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'status_verifikasi' => 'pending',
            'created_by' => $this->session->get('user_id'),
        ];

        // Calculate capaian_persen
        $persentase = $data['persentase_energi_terbarukan'];
        $program_emisi = $data['program_pengurangan_emisi'];
        $program_inovatif = $data['program_inovatif_energi'];
        $program_iklim = $data['program_dampak_iklim'];

        $data['capaian_persen'] = round(
            ($persentase * 0.5) +
                ($program_emisi ? 20 : 0) +
                ($program_inovatif ? 15 : 0) +
                ($program_iklim ? 15 : 0),
            2
        );

        if ($this->model->insert($data)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        // Check permission
        $userRole = $this->session->get('role');
        $userId = $this->session->get('user_id');

        if ($WasteManagement['status_verifikasi'] === 'approved' && $userRole !== 'admin') {
            return redirect()->to('/waste-management')->with('error', 'Data yang sudah diverifikasi hanya dapat diedit oleh admin');
        }

        if (
            $WasteManagement['status_verifikasi'] === 'pending' &&
            $userRole !== 'admin' &&
            $WasteManagement['created_by'] != $userId
        ) {
            return redirect()->to('/waste-management')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini');
        }

        $data = [
            'title' => 'Edit Data Energy & Climate Change',
            'WasteManagement' => $WasteManagement,
            'validation' => \Config\Services::validation(),
        ];

        return view('kriteria/waste_management/edit', $data);
    }

    /**
     * Update data
     */
    public function update($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        // Validation rules
        $rules = [
            'tahun' => "required|integer|is_unique[waste_management.tahun,id,{$id}]",
            'total_konsumsi_listrik' => 'required|decimal|greater_than[0]',
            'konsumsi_energi_terbarukan' => 'required|decimal',
            'peralatan_hemat_energi' => 'required|integer',
            'bangunan_cerdas' => 'required|integer',
            'jumlah_energi_terbarukan' => 'required|integer',
            'total_listrik_per_orang' => 'required|decimal',
            'bangunan_ramah_lingkungan' => 'required|integer',
            'jejak_karbon_per_orang' => 'required|decimal',
        ];

        // Add file validation only if file is uploaded
        $file = $this->request->getFile('bukti_pendukung');
        if ($file && $file->isValid()) {
            $rules['bukti_pendukung'] = 'max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Validate: konsumsi_energi_terbarukan <= total_konsumsi_listrik
        $total = $this->request->getPost('total_konsumsi_listrik');
        $terbarukan = $this->request->getPost('konsumsi_energi_terbarukan');

        if ($terbarukan > $total) {
            return redirect()->back()->withInput()->with('error', 'Konsumsi energi terbarukan tidak boleh lebih besar dari total konsumsi listrik');
        }

        // Handle file upload
        $fileName = $WasteManagement['bukti_pendukung'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file
            if ($fileName && file_exists(WRITEPATH . 'uploads/waste_management/' . $fileName)) {
                unlink(WRITEPATH . 'uploads/waste_management/' . $fileName);
            }

            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/waste_management', $fileName);
        }

        // Prepare data
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'total_konsumsi_listrik' => $this->request->getPost('total_konsumsi_listrik'),
            'konsumsi_energi_terbarukan' => $this->request->getPost('konsumsi_energi_terbarukan'),
            'peralatan_hemat_energi' => $this->request->getPost('peralatan_hemat_energi'),
            'bangunan_cerdas' => $this->request->getPost('bangunan_cerdas'),
            'jumlah_energi_terbarukan' => $this->request->getPost('jumlah_energi_terbarukan'),
            'total_listrik_per_orang' => $this->request->getPost('total_listrik_per_orang'),
            'bangunan_ramah_lingkungan' => $this->request->getPost('bangunan_ramah_lingkungan'),
            'program_pengurangan_emisi' => $this->request->getPost('program_pengurangan_emisi') ? 1 : 0,
            'jejak_karbon_per_orang' => $this->request->getPost('jejak_karbon_per_orang'),
            'program_inovatif_energi' => $this->request->getPost('program_inovatif_energi') ? 1 : 0,
            'program_dampak_iklim' => $this->request->getPost('program_dampak_iklim') ? 1 : 0,
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'updated_by' => $this->session->get('user_id'),
        ];

        // If data was approved, reset to pending
        if ($WasteManagement['status_verifikasi'] === 'approved') {
            $data['status_verifikasi'] = 'pending';
            $data['verified_by'] = null;
            $data['verified_at'] = null;
            $data['catatan_verifikasi'] = null;
        }

        // Auto-calculate percentages
        $total_listrik = floatval($data['total_konsumsi_listrik']);
        $energi_terbarukan = floatval($data['konsumsi_energi_terbarukan']);

        if ($total_listrik > 0) {
            $data['persentase_energi_terbarukan'] = round(($energi_terbarukan / $total_listrik) * 100, 2);
        } else {
            $data['persentase_energi_terbarukan'] = 0;
        }

        // Calculate capaian_persen
        $persentase = $data['persentase_energi_terbarukan'];
        $program_emisi = $data['program_pengurangan_emisi'];
        $program_inovatif = $data['program_inovatif_energi'];
        $program_iklim = $data['program_dampak_iklim'];

        $data['capaian_persen'] = round(
            ($persentase * 0.5) +
                ($program_emisi ? 20 : 0) +
                ($program_inovatif ? 15 : 0) +
                ($program_iklim ? 15 : 0),
            2
        );

        if ($this->model->update($id, $data)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
        }
    }

    /**
     * Delete data
     */
    public function delete($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        // Delete file
        if (
            $WasteManagement['bukti_pendukung'] &&
            file_exists(WRITEPATH . 'uploads/waste_management/' . $WasteManagement['bukti_pendukung'])
        ) {
            unlink(WRITEPATH . 'uploads/waste_management/' . $WasteManagement['bukti_pendukung']);
        }

        if ($this->model->delete($id)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('/waste-management')->with('error', 'Gagal menghapus data');
        }
    }

    /**
     * Show verification page
     */
    public function verify($id)
    {
        $WasteManagement = $this->model->getWithUsers($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Verifikasi Data Energy & Climate Change',
            'WasteManagement' => $WasteManagement,
        ];

        return view('kriteria/waste_management/verify', $data);
    }

    /**
     * Process verification
     */
    public function processVerification($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        $action = $this->request->getPost('action');
        $catatan = $this->request->getPost('catatan_verifikasi');

        $data = [
            'status_verifikasi' => $action === 'approve' ? 'approved' : 'rejected',
            'catatan_verifikasi' => $catatan,
            'verified_by' => $this->session->get('user_id'),
            'verified_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->model->update($id, $data)) {
            $message = $action === 'approve' ? 'Data berhasil disetujui' : 'Data ditolak';
            return redirect()->to('/waste-management')->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Gagal memproses verifikasi');
        }
    }

    /**
     * Download file
     */
    public function download($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement || !$WasteManagement['bukti_pendukung']) {
            return redirect()->to('/waste-management')->with('error', 'File tidak ditemukan');
        }

        $filePath = WRITEPATH . 'uploads/waste_management/' . $WasteManagement['bukti_pendukung'];

        if (!file_exists($filePath)) {
            return redirect()->to('/waste-management')->with('error', 'File tidak ditemukan');
        }

        return $this->response->download($filePath, null);
    }

    /**
     * Show request revision form
     */
    public function requestRevision($id)
    {
        $WasteManagement = $this->model->getWithUsers($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        if ($WasteManagement['status_verifikasi'] !== 'approved') {
            return redirect()->to('/waste-management')->with('error', 'Hanya data yang sudah diverifikasi yang dapat diminta revisi');
        }

        $data = [
            'title' => 'Request Revisi - Energy & Climate Change',
            'WasteManagement' => $WasteManagement,
        ];

        return view('kriteria/waste_management/request_revision', $data);
    }

    /**
     * Submit revision request
     */
    public function submitRevisionRequest($id)
    {
        $WasteManagement = $this->model->find($id);

        if (!$WasteManagement) {
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'alasan_revisi' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $revisionData = [
            'waste_management_id' => $id,
            'revision_type' => 'request',
            'requested_by' => $this->session->get('user_id'),
            'alasan_revisi' => $this->request->getPost('alasan_revisi'),
            'data_revisi' => json_encode($WasteManagement),
            'status' => 'pending',
        ];

        if ($this->revisionModel->insert($revisionData)) {
            return redirect()->to('/waste-management')->with('success', 'Permintaan revisi berhasil diajukan');
        } else {
            return redirect()->back()->with('error', 'Gagal mengajukan permintaan revisi');
        }
    }

    /**
     * Show revision list
     */
    public function revisionList()
    {
        $data = [
            'title' => 'Daftar Permintaan Revisi - Energy & Climate Change',
            'revisions' => $this->revisionModel->getAllWithUsers(),
        ];

        return view('kriteria/waste_management/revision_list', $data);
    }

    /**
     * Show review revision page
     */
    public function reviewRevision($revisionId)
    {
        $revision = $this->revisionModel->getWithUsers($revisionId);

        if (!$revision) {
            return redirect()->to('/waste-management/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }

        $WasteManagement = $this->model->find($revision['waste_management_id']);

        $data = [
            'title' => 'Review Permintaan Revisi - Energy & Climate Change',
            'revision' => $revision,
            'WasteManagement' => $WasteManagement,
        ];

        return view('kriteria/waste_management/review_revision', $data);
    }

    /**
     * Process revision review
     */
    public function processRevisionReview($revisionId)
    {
        $revision = $this->revisionModel->find($revisionId);

        if (!$revision) {
            return redirect()->to('/waste-management/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }

        $action = $this->request->getPost('action');
        $reviewNotes = $this->request->getPost('review_notes');

        $revisionUpdate = [
            'status' => $action === 'approve' ? 'approved' : 'rejected',
            'reviewed_by' => $this->session->get('user_id'),
            'review_notes' => $reviewNotes,
            'reviewed_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->revisionModel->update($revisionId, $revisionUpdate)) {
            // If approved, change waste_management status to pending
            if ($action === 'approve') {
                $this->model->update($revision['waste_management_id'], [
                    'status_verifikasi' => 'pending',
                    'verified_by' => null,
                    'verified_at' => null,
                    'catatan_verifikasi' => null,
                ]);
            }

            $message = $action === 'approve' ? 'Permintaan revisi disetujui' : 'Permintaan revisi ditolak';
            return redirect()->to('/waste-management/revisions')->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Gagal memproses review');
        }
    }

    /**
     * Show user's revision requests
     */
    public function myRevisions()
    {
        $userId = $this->session->get('user_id');

        $data = [
            'title' => 'Revisi Saya - Energy & Climate Change',
            'revisions' => $this->revisionModel->getByUserId($userId),
        ];

        return view('kriteria/waste_management/my_revisions', $data);
    }
}
