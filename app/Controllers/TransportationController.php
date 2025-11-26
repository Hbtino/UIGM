<?php

namespace App\Controllers;

use App\Models\TransportationModel;
use App\Models\TransportationRevisionModel;
use App\Models\UserModel;

class TransportationController extends BaseController
{
    protected $model;
    protected $revisionModel;
    protected $userModel;
    
    public function __construct()
    {
        $this->model = new TransportationModel();
        $this->revisionModel = new TransportationRevisionModel();
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
            'title' => 'Transportation - Data Capaian',
            'page' => 'transportation',
            'breadcrumb' => 'Home / Kriteria SDGs / Transportasi',
            'data_tr' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];
        
        return view('kriteria/transportation/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
        }
        
        $data = [
            'title' => 'Tambah Data Transportation',
            'page' => 'transportasi',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[transportation.tahun]',
            'total_perjalanan' => 'required|integer|greater_than[0]',
            'perjalanan_ramah_lingkungan' => 'required|integer',
            'bukti_pendukung' => 'uploaded[bukti_pendukung]|max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Validate perjalanan ramah lingkungan <= total perjalanan
        $total = $this->request->getPost('total_perjalanan');
        $ramah = $this->request->getPost('perjalanan_ramah_lingkungan');
        
        if ($ramah > $total) {
            return redirect()->back()->withInput()->with('error', 'Perjalanan ramah lingkungan tidak boleh melebihi total perjalanan');
        }
        
        // Handle file upload
        $file = $this->request->getFile('bukti_pendukung');
        $fileName = null;
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/transportation', $fileName);
        }
        
        // Auto-calculate percentage
        $capaianPersen = $total > 0 ? round(($ramah / $total) * 100, 2) : 0;
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'total_perjalanan' => $total,
            'perjalanan_ramah_lingkungan' => $ramah,
            'jumlah_kendaraan' => $this->request->getPost('jumlah_kendaraan') ?? 0,
            'jumlah_populasi' => $this->request->getPost('jumlah_populasi') ?? 0,
            'rasio_kendaraan' => $this->request->getPost('rasio_kendaraan'),
            'layanan_antar_jemput' => $this->request->getPost('layanan_antar_jemput'),
            'kebijakan_zev' => $this->request->getPost('kebijakan_zev'),
            'luas_parkir' => $this->request->getPost('luas_parkir'),
            'program_pembatasan_parkir' => $this->request->getPost('program_pembatasan_parkir'),
            'inisiatif_pengurangan_kendaraan' => $this->request->getPost('inisiatif_pengurangan_kendaraan') ?? 0,
            'jalur_pejalan_kaki' => $this->request->getPost('jalur_pejalan_kaki'),
            'sepeda_kampus' => $this->request->getPost('sepeda_kampus') ?? 0,
            'capaian_persen' => $capaianPersen,
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'status_verifikasi' => 'pending',
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil ditambahkan dan menunggu verifikasi');
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
            return redirect()->to('/transportation')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Transportation',
            'page' => 'transportasi',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/edit', $data);
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
            'tahun' => "required|integer|is_unique[transportation.tahun,id,{$id}]",
            'total_perjalanan' => 'required|integer|greater_than[0]',
            'perjalanan_ramah_lingkungan' => 'required|integer'
        ];
        
        // File upload is optional on update
        if ($this->request->getFile('bukti_pendukung')->isValid()) {
            $rules['bukti_pendukung'] = 'max_size[bukti_pendukung,2048]|ext_in[bukti_pendukung,pdf,jpg,jpeg,png,xlsx,xls]';
        }
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Validate perjalanan ramah lingkungan <= total perjalanan
        $total = $this->request->getPost('total_perjalanan');
        $ramah = $this->request->getPost('perjalanan_ramah_lingkungan');
        
        if ($ramah > $total) {
            return redirect()->back()->withInput()->with('error', 'Perjalanan ramah lingkungan tidak boleh melebihi total perjalanan');
        }
        
        // Handle file upload
        $fileName = $existingData['bukti_pendukung'];
        $file = $this->request->getFile('bukti_pendukung');
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file if exists
            if ($fileName && file_exists(WRITEPATH . 'uploads/transportation/' . $fileName)) {
                unlink(WRITEPATH . 'uploads/transportation/' . $fileName);
            }
            
            $fileName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads/transportation', $fileName);
        }
        
        // Auto-calculate percentage
        $capaianPersen = $total > 0 ? round(($ramah / $total) * 100, 2) : 0;
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'total_perjalanan' => $total,
            'perjalanan_ramah_lingkungan' => $ramah,
            'jumlah_kendaraan' => $this->request->getPost('jumlah_kendaraan') ?? 0,
            'jumlah_populasi' => $this->request->getPost('jumlah_populasi') ?? 0,
            'rasio_kendaraan' => $this->request->getPost('rasio_kendaraan'),
            'layanan_antar_jemput' => $this->request->getPost('layanan_antar_jemput'),
            'kebijakan_zev' => $this->request->getPost('kebijakan_zev'),
            'luas_parkir' => $this->request->getPost('luas_parkir'),
            'program_pembatasan_parkir' => $this->request->getPost('program_pembatasan_parkir'),
            'inisiatif_pengurangan_kendaraan' => $this->request->getPost('inisiatif_pengurangan_kendaraan') ?? 0,
            'jalur_pejalan_kaki' => $this->request->getPost('jalur_pejalan_kaki'),
            'sepeda_kampus' => $this->request->getPost('sepeda_kampus') ?? 0,
            'capaian_persen' => $capaianPersen,
            'keterangan' => $this->request->getPost('keterangan'),
            'bukti_pendukung' => $fileName,
            'status_verifikasi' => 'pending',
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil diupdate dan menunggu verifikasi ulang');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/transportation')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        // Get file to delete
        $data = $this->model->find($id);
        if ($data && $data['bukti_pendukung']) {
            $filePath = WRITEPATH . 'uploads/transportation/' . $data['bukti_pendukung'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/transportation')->with('error', 'Gagal menghapus data');
    }
    
    public function verify($id)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
        }
        
        $dataItem = $this->model->find($id);
        if (!$dataItem) {
            return redirect()->to('/transportation')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Verifikasi Data Transportation',
            'page' => 'transportasi',
            'data_item' => $dataItem,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/verify', $data);
    }
    
    public function processVerification($id)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
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
            return redirect()->to('/transportation')->with('success', $message);
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
        
        $filePath = WRITEPATH . 'uploads/transportation/' . $data['bukti_pendukung'];
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
            return redirect()->to('/transportation')->with('error', 'Data tidak ditemukan');
        }
        
        // Only allow revision request for approved data
        if ($dataItem['status_verifikasi'] != 'approved') {
            return redirect()->to('/transportation')->with('error', 'Hanya data yang sudah disetujui yang dapat diminta revisi');
        }
        
        $data = [
            'title' => 'Request Revisi Data Transportation',
            'page' => 'transportasi',
            'data_item' => $dataItem,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/request_revision', $data);
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
            return redirect()->to('/transportation')->with('error', 'Data tidak valid untuk revisi');
        }
        
        $revisionData = [
            'transportation_id' => $id,
            'revision_type' => 'request',
            'requested_by' => $session->get('user_id'),
            'alasan_revisi' => $this->request->getPost('alasan_revisi'),
            'data_revisi' => json_encode($dataItem), // Save current data
            'status' => 'pending'
        ];
        
        if ($this->revisionModel->insert($revisionData)) {
            return redirect()->to('/transportation')->with('success', 'Permintaan revisi berhasil diajukan dan menunggu persetujuan admin');
        }
        
        return redirect()->back()->withInput()->with('error', 'Gagal mengajukan permintaan revisi');
    }
    
    public function revisionList()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
        }
        
        $revisions = $this->revisionModel->getRevisionsWithUsers();
        
        $data = [
            'title' => 'Daftar Permintaan Revisi',
            'page' => 'transportasi',
            'revisions' => $revisions,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/revision_list', $data);
    }
    
    public function reviewRevision($revisionId)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
        }
        
        $revision = $this->revisionModel->find($revisionId);
        if (!$revision) {
            return redirect()->to('/transportation/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }
        
        $transportationData = $this->model->find($revision['transportation_id']);
        $requester = $this->userModel->find($revision['requested_by']);
        
        $data = [
            'title' => 'Review Permintaan Revisi',
            'page' => 'transportasi',
            'revision' => $revision,
            'transportation_data' => $transportationData,
            'requester' => $requester,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/review_revision', $data);
    }
    
    public function processRevisionReview($revisionId)
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'reviewer'])) {
            return redirect()->to('/transportation')->with('error', 'Akses ditolak');
        }
        
        $action = $this->request->getPost('action');
        $reviewNotes = $this->request->getPost('review_notes');
        
        if (!in_array($action, ['approved', 'rejected'])) {
            return redirect()->back()->with('error', 'Aksi tidak valid');
        }
        
        $revision = $this->revisionModel->find($revisionId);
        if (!$revision) {
            return redirect()->to('/transportation/revisions')->with('error', 'Permintaan revisi tidak ditemukan');
        }
        
        // Update revision status
        $updateData = [
            'status' => $action,
            'reviewed_by' => $session->get('user_id'),
            'review_notes' => $reviewNotes,
            'reviewed_at' => date('Y-m-d H:i:s')
        ];
        
        $this->revisionModel->update($revisionId, $updateData);
        
        // If approved, change transportation status back to pending
        if ($action == 'approved') {
            $this->model->update($revision['transportation_id'], [
                'status_verifikasi' => 'pending',
                'catatan_verifikasi' => 'Revisi disetujui: ' . $reviewNotes
            ]);
            
            $message = 'Permintaan revisi disetujui. Data transportation dikembalikan ke status pending untuk diedit.';
        } else {
            $message = 'Permintaan revisi ditolak.';
        }
        
        return redirect()->to('/transportation/revisions')->with('success', $message);
    }
    
    public function myRevisions()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $revisions = $this->db->table('transportation_revisions')
            ->select('transportation_revisions.*, 
                      transportation.tahun,
                      reviewer.name as reviewer_name')
            ->join('transportation', 'transportation.id = transportation_revisions.transportation_id', 'left')
            ->join('users as reviewer', 'reviewer.id = transportation_revisions.reviewed_by', 'left')
            ->where('transportation_revisions.requested_by', $session->get('user_id'))
            ->orderBy('transportation_revisions.created_at', 'DESC')
            ->get()
            ->getResultArray();
        
        $data = [
            'title' => 'Permintaan Revisi Saya',
            'page' => 'transportasi',
            'revisions' => $revisions,
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/transportation/my_revisions', $data);
    }
}