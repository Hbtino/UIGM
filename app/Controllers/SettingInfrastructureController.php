<?php

namespace App\Controllers;

use App\Models\SettingInfrastructureModel;
use App\Models\SettingInfrastructureRevisionModel;
use App\Models\UserModel;

class SettingInfrastructureController extends BaseController
{
    protected $model;
    protected $revisionModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->model = new SettingInfrastructureModel();
        $this->revisionModel = new SettingInfrastructureRevisionModel();
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Get user data for profile photo
        $user = $this->userModel->find($session->get('user_id'));
        
        $data = [
            'title' => 'Setting & Infrastructure - Data Capaian',
            'page' => 'setting-infrastructure',
            'breadcrumb' => 'Home / Kriteria SDGs / Pengaturan & Infrastruktur',
            'settingInfrastructure' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];
        
        return view('kriteria/setting_infrastructure/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $data = [
            'title' => 'Tambah Data Setting & Infrastructure',
            'page' => 'pengaturan-infrastruktur',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[setting_infrastructure.tahun]',
            'luas_ruang_terbuka' => 'required|decimal',
            'luas_total' => 'required|decimal|greater_than[0]',
            'bukti_pendukung' => 'uploaded[bukti_pendukung]|max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Validate luas_ruang_terbuka <= luas_total
        $luasRuangTerbuka = $this->request->getPost('luas_ruang_terbuka');
        $luasTotal = $this->request->getPost('luas_total');
        
        if ($luasRuangTerbuka > $luasTotal) {
            return redirect()->back()->withInput()->with('error', 'Luas ruang terbuka tidak boleh melebihi luas total');
        }
        
        // Handle file upload
        $file = $this->request->getFile('bukti_pendukung');
        $fileName = null;
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/setting_infrastructure', $fileName);
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'luas_ruang_terbuka' => $luasRuangTerbuka,
            'luas_total' => $luasTotal,
            'vegetasi_hutan' => $this->request->getPost('vegetasi_hutan') ?? 0,
            'area_tanaman' => $this->request->getPost('area_tanaman') ?? 0,
            'area_resapan' => $this->request->getPost('area_resapan') ?? 0,
            'persentase_anggaran' => $this->request->getPost('persentase_anggaran') ?? 0,
            'persentase_pemeliharaan' => $this->request->getPost('persentase_pemeliharaan') ?? 0,
            'fasilitas_disabilitas' => $this->request->getPost('fasilitas_disabilitas'),
            'fasilitas_energi_terbarukan' => $this->request->getPost('fasilitas_energi_terbarukan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'status_verifikasi' => 'pending',
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil ditambahkan dan menunggu verifikasi');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
    }
    
    public function edit($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $dataItem = $this->model->find($id);
        if (!$dataItem) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Setting & Infrastructure',
            'page' => 'pengaturan-infrastruktur',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/edit', $data);
    }
    
    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        // Check if data is already approved
        $existingData = $this->model->find($id);
        if ($existingData['status_verifikasi'] == 'approved' && $session->get('role') != 'admin') {
            return redirect()->back()->with('error', 'Data yang sudah disetujui tidak dapat diubah. Silakan hubungi admin.');
        }
        
        $rules = [
            'tahun' => "required|integer|is_unique[setting_infrastructure.tahun,id,{$id}]",
            'luas_ruang_terbuka' => 'required|decimal',
            'luas_total' => 'required|decimal|greater_than[0]'
        ];
        
        // File upload is optional on update
        if ($this->request->getFile('bukti_pendukung')->isValid()) {
            $rules['bukti_pendukung'] = 'max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Validate luas_ruang_terbuka <= luas_total
        $luasRuangTerbuka = $this->request->getPost('luas_ruang_terbuka');
        $luasTotal = $this->request->getPost('luas_total');
        
        if ($luasRuangTerbuka > $luasTotal) {
            return redirect()->back()->withInput()->with('error', 'Luas ruang terbuka tidak boleh melebihi luas total');
        }
        
        // Handle file upload
        $fileName = $existingData['bukti_pendukung'];
        $file = $this->request->getFile('bukti_pendukung');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file if exists
            if ($fileName && file_exists(WRITEPATH . 'uploads/setting_infrastructure/' . $fileName)) {
                unlink(WRITEPATH . 'uploads/setting_infrastructure/' . $fileName);
            }
            
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/setting_infrastructure', $fileName);
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'luas_ruang_terbuka' => $luasRuangTerbuka,
            'luas_total' => $luasTotal,
            'vegetasi_hutan' => $this->request->getPost('vegetasi_hutan') ?? 0,
            'area_tanaman' => $this->request->getPost('area_tanaman') ?? 0,
            'area_resapan' => $this->request->getPost('area_resapan') ?? 0,
            'persentase_anggaran' => $this->request->getPost('persentase_anggaran') ?? 0,
            'persentase_pemeliharaan' => $this->request->getPost('persentase_pemeliharaan') ?? 0,
            'fasilitas_disabilitas' => $this->request->getPost('fasilitas_disabilitas'),
            'fasilitas_energi_terbarukan' => $this->request->getPost('fasilitas_energi_terbarukan'),
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'status_verifikasi' => 'pending',
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil diupdate dan menunggu verifikasi ulang');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/setting-infrastructure')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        // Get file to delete
        $data = $this->model->find($id);
        if ($data && $data['bukti_pendukung']) {
            $filePath = WRITEPATH . 'uploads/setting_infrastructure/' . $data['bukti_pendukung'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/setting-infrastructure')->with('error', 'Gagal menghapus data');
    }
    
    public function verify($id)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $dataItem = $this->model->find($id);
        if (!$dataItem) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Verifikasi Data Setting & Infrastructure',
            'page' => 'pengaturan-infrastruktur',
            'data_item' => $dataItem,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/verify', $data);
    }
    
    public function processVerification($id)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $status = $this->request->getPost('status_verifikasi');
        $catatan = $this->request->getPost('catatan_verifikasi');
        
        if (!in_array($status, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Status verifikasi tidak valid');
        }
        
        $data = [
            'status_verifikasi' => $status,
            'catatan_verifikasi' => $catatan,
            'verified_by' => $session->get('user_id'),
            'verified_at' => date('Y-m-d H:i:s')
        ];
        
        if ($this->model->update($id, $data)) {
            $message = $status == 'approved' ? 'Data berhasil disetujui' : 'Data ditolak';
            return redirect()->to('/setting-infrastructure')->with('success', $message);
        }
        return redirect()->back()->with('error', 'Gagal memproses verifikasi');
    }
    
    public function download($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = $this->model->find($id);
        if (!$data || !$data['bukti_pendukung']) {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
        
        $filePath = WRITEPATH . 'uploads/setting_infrastructure/' . $data['bukti_pendukung'];
        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan di server');
        }
        
        return $this->response->download($filePath, null);
    }
    
    // ========================================
    // REVISION REQUEST METHODS
    // ========================================
    
    public function requestRevision($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $dataItem = $this->model->find($id);
        if (!$dataItem) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Data tidak ditemukan');
        }
        
        if ($dataItem['status_verifikasi'] != 'approved') {
            return redirect()->to('/setting-infrastructure')->with('error', 'Hanya data yang sudah disetujui yang dapat diminta revisi');
        }
        
        $data = [
            'title' => 'Request Revisi Data Setting & Infrastructure',
            'page' => 'pengaturan-infrastruktur',
            'data_item' => $dataItem,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/request_revision', $data);
    }
    
    public function submitRevisionRequest($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'alasan_revisi' => 'required|min_length[10]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $dataItem = $this->model->find($id);
        if (!$dataItem || $dataItem['status_verifikasi'] != 'approved') {
            return redirect()->to('/setting-infrastructure')->with('error', 'Data tidak valid untuk revisi');
        }
        
        $revisionData = [
            'setting_infrastructure_id' => $id,
            'revision_type' => 'request',
            'requested_by' => $session->get('user_id'),
            'alasan_revisi' => $this->request->getPost('alasan_revisi'),
            'data_revisi' => json_encode($dataItem),
            'status' => 'pending'
        ];
        
        if ($this->revisionModel->insert($revisionData)) {
            return redirect()->to('/setting-infrastructure')->with('success', 'Permintaan revisi berhasil diajukan dan menunggu persetujuan admin');
        }
        
        return redirect()->back()->withInput()->with('error', 'Gagal mengajukan permintaan revisi');
    }
    
    public function revisionList()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $revisions = $this->revisionModel->getRevisionsWithUsers();
        
        $data = [
            'title' => 'Daftar Permintaan Revisi',
            'page' => 'pengaturan-infrastruktur',
            'revisions' => $revisions,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/revision_list', $data);
    }
    
    public function reviewRevision($revisionId)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $revision = $this->revisionModel->find($revisionId);
        if (!$revision) {
            return redirect()->to('/setting-infrastructure/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }
        
        $settingInfrastructureData = $this->model->find($revision['setting_infrastructure_id']);
        $requester = $this->userModel->find($revision['requested_by']);
        
        $data = [
            'title' => 'Review Permintaan Revisi',
            'page' => 'pengaturan-infrastruktur',
            'revision' => $revision,
            'setting_infrastructure_data' => $settingInfrastructureData,
            'requester' => $requester,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/review_revision', $data);
    }
    
    public function processRevisionReview($revisionId)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/setting-infrastructure')->with('error', 'Akses ditolak');
        }
        
        $action = $this->request->getPost('action');
        $reviewNotes = $this->request->getPost('review_notes');
        
        if (!in_array($action, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Aksi tidak valid');
        }
        
        $revision = $this->revisionModel->find($revisionId);
        if (!$revision) {
            return redirect()->to('/setting-infrastructure/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }
        
        // Update revision status
        $updateData = [
            'status' => $action,
            'reviewed_by' => $session->get('user_id'),
            'review_notes' => $reviewNotes,
            'reviewed_at' => date('Y-m-d H:i:s')
        ];
        
        $this->revisionModel->update($revisionId, $updateData);
        
        // If approved, change setting_infrastructure status back to pending
        if ($action == 'approved') {
            $this->model->update($revision['setting_infrastructure_id'], [
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => 'Revisi disetujui: ' . $reviewNotes
            ]);
            
            $message = 'Permintaan revisi disetujui. Data setting infrastructure dikembalikan ke status pending untuk diedit.';
        } else {
            $message = 'Permintaan revisi ditolak.';
        }
        
        return redirect()->to('/setting-infrastructure/revisions')->with('success', $message);
    }
    
    public function myRevisions()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $revisions = $this->db->table('setting_infrastructure_revisions')
            ->select('setting_infrastructure_revisions.*, 
                      setting_infrastructure.tahun,
                      reviewer.name as reviewer_name')
            ->join('setting_infrastructure', 'setting_infrastructure.id = setting_infrastructure_revisions.setting_infrastructure_id', 'left')
            ->join('users as reviewer', 'reviewer.id = setting_infrastructure_revisions.reviewed_by', 'left')
            ->where('setting_infrastructure_revisions.requested_by', $session->get('user_id'))
            ->orderBy('setting_infrastructure_revisions.created_at', 'DESC')
            ->get()
            ->getResultArray();
        
        $data = [
            'title' => 'Permintaan Revisi Saya',
            'page' => 'pengaturan-infrastruktur',
            'revisions' => $revisions,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/setting_infrastructure/my_revisions', $data);
    }
}
