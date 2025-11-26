<?php

namespace App\Controllers;

use App\Models\EnergyClimateModel;
use App\Models\EnergyClimateRevisionModel;

class EnergyClimateController extends BaseController
{
    protected $model;
    protected $revisionModel;
    protected $session;

    public function __construct()
    {
        $this->model = new EnergyClimateModel();
        $this->revisionModel = new EnergyClimateRevisionModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    /**
     * Display list of all energy climate data
     */
    public function index()
    {
        if (!$this->session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($this->session->get('user_id'));
        
        $data = [
            'title' => 'Energy & Climate Change - Data Capaian',
            'page' => 'energy-climate',
            'breadcrumb' => 'Home / Kriteria SDGs / Energi & Perubahan Iklim',
            'energyClimate' => $this->model->getAllWithUsers(),
            'user_name' => $this->session->get('name'),
            'user_role' => $this->session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('kriteria/energy_climate/index', $data);
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

        return view('kriteria/energy_climate/create', $data);
    }

    /**
     * Store new data
     */
    public function store()
    {
        // Validation rules
        $rules = [
            'tahun' => 'required|integer|is_unique[energy_climate.tahun]',
            'total_konsumsi_listrik' => 'required|decimal|greater_than[0]',
            'konsumsi_energi_terbarukan' => 'required|decimal',
            'peralatan_hemat_energi' => 'required|integer',
            'bangunan_cerdas' => 'required|integer',
            'jumlah_energi_terbarukan' => 'required|integer',
            'total_listrik_per_orang' => 'required|decimal',
            'bangunan_ramah_lingkungan' => 'required|integer',
            'jejak_karbon_per_orang' => 'required|decimal',
            'bukti_pendukung' => 'uploaded[bukti_pendukung]|max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]',
        ];

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
        $file = $this->request->getFile('bukti_pendukung');
        $fileName = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/energy_climate', $fileName);
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
            'status_verifikasi' => 'pending',
            'created_by' => $this->session->get('user_id'),
        ];

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

        if ($this->model->insert($data)) {
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data');
        }
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        // Check permission
        $userRole = $this->session->get('role');
        $userId = $this->session->get('user_id');

        if ($energyClimate['status_verifikasi'] === 'approved' && $userRole !== 'admin') {
            return redirect()->to('/energy-climate')->with('error', 'Data yang sudah diverifikasi hanya dapat diedit oleh admin');
        }

        if ($energyClimate['status_verifikasi'] === 'pending' && 
            $userRole !== 'admin' && 
            $energyClimate['created_by'] != $userId) {
            return redirect()->to('/energy-climate')->with('error', 'Anda tidak memiliki akses untuk mengedit data ini');
        }

        $data = [
            'title' => 'Edit Data Energy & Climate Change',
            'energyClimate' => $energyClimate,
            'validation' => \Config\Services::validation(),
        ];

        return view('kriteria/energy_climate/edit', $data);
    }

    /**
     * Update data
     */
    public function update($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        // Validation rules
        $rules = [
            'tahun' => "required|integer|is_unique[energy_climate.tahun,id,{$id}]",
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
        $fileName = $energyClimate['bukti_pendukung'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file
            if ($fileName && file_exists(WRITEPATH . 'uploads/energy_climate/' . $fileName)) {
                unlink(WRITEPATH . 'uploads/energy_climate/' . $fileName);
            }

            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/energy_climate', $fileName);
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
        if ($energyClimate['status_verifikasi'] === 'approved') {
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
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
        }
    }

    /**
     * Delete data
     */
    public function delete($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        // Delete file
        if ($energyClimate['bukti_pendukung'] && 
            file_exists(WRITEPATH . 'uploads/energy_climate/' . $energyClimate['bukti_pendukung'])) {
            unlink(WRITEPATH . 'uploads/energy_climate/' . $energyClimate['bukti_pendukung']);
        }

        if ($this->model->delete($id)) {
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('/energy-climate')->with('error', 'Gagal menghapus data');
        }
    }

    /**
     * Show verification page
     */
    public function verify($id)
    {
        $energyClimate = $this->model->getWithUsers($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'title' => 'Verifikasi Data Energy & Climate Change',
            'energyClimate' => $energyClimate,
        ];

        return view('kriteria/energy_climate/verify', $data);
    }

    /**
     * Process verification
     */
    public function processVerification($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
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
            return redirect()->to('/energy-climate')->with('success', $message);
        } else {
            return redirect()->back()->with('error', 'Gagal memproses verifikasi');
        }
    }

    /**
     * Download file
     */
    public function download($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate || !$energyClimate['bukti_pendukung']) {
            return redirect()->to('/energy-climate')->with('error', 'File tidak ditemukan');
        }

        $filePath = WRITEPATH . 'uploads/energy_climate/' . $energyClimate['bukti_pendukung'];

        if (!file_exists($filePath)) {
            return redirect()->to('/energy-climate')->with('error', 'File tidak ditemukan');
        }

        return $this->response->download($filePath, null);
    }

    /**
     * Show request revision form
     */
    public function requestRevision($id)
    {
        $energyClimate = $this->model->getWithUsers($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        if ($energyClimate['status_verifikasi'] !== 'approved') {
            return redirect()->to('/energy-climate')->with('error', 'Hanya data yang sudah diverifikasi yang dapat diminta revisi');
        }

        $data = [
            'title' => 'Request Revisi - Energy & Climate Change',
            'energyClimate' => $energyClimate,
        ];

        return view('kriteria/energy_climate/request_revision', $data);
    }

    /**
     * Submit revision request
     */
    public function submitRevisionRequest($id)
    {
        $energyClimate = $this->model->find($id);

        if (!$energyClimate) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }

        $rules = [
            'alasan_revisi' => 'required|min_length[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $revisionData = [
            'energy_climate_id' => $id,
            'revision_type' => 'request',
            'requested_by' => $this->session->get('user_id'),
            'alasan_revisi' => $this->request->getPost('alasan_revisi'),
            'data_revisi' => json_encode($energyClimate),
            'status' => 'pending',
        ];

        if ($this->revisionModel->insert($revisionData)) {
            return redirect()->to('/energy-climate')->with('success', 'Permintaan revisi berhasil diajukan');
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

        return view('kriteria/energy_climate/revision_list', $data);
    }

    /**
     * Show review revision page
     */
    public function reviewRevision($revisionId)
    {
        $revision = $this->revisionModel->getWithUsers($revisionId);

        if (!$revision) {
            return redirect()->to('/energy-climate/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }

        $energyClimate = $this->model->find($revision['energy_climate_id']);

        $data = [
            'title' => 'Review Permintaan Revisi - Energy & Climate Change',
            'revision' => $revision,
            'energyClimate' => $energyClimate,
        ];

        return view('kriteria/energy_climate/review_revision', $data);
    }

    /**
     * Process revision review
     */
    public function processRevisionReview($revisionId)
    {
        $revision = $this->revisionModel->find($revisionId);

        if (!$revision) {
            return redirect()->to('/energy-climate/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
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
            // If approved, change energy_climate status to pending
            if ($action === 'approve') {
                $this->model->update($revision['energy_climate_id'], [
                    'status_verifikasi' => 'pending',
                    'verified_by' => null,
                    'verified_at' => null,
                    'catatan_verifikasi' => null,
                ]);
            }

            $message = $action === 'approve' ? 'Permintaan revisi disetujui' : 'Permintaan revisi ditolak';
            return redirect()->to('/energy-climate/revisions')->with('success', $message);
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

        return view('kriteria/energy_climate/my_revisions', $data);
    }
}
