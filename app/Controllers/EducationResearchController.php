<?php

namespace App\Controllers;

use App\Models\EducationResearchModel;

class EducationResearchController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new EducationResearchModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Education & Research - Data Capaian',
            'page' => 'pendidikan-penelitian',
            'data_ed' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/education_research/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/education-research')->with('error', 'Akses ditolak');
        }
        
        $data = [
            'title' => 'Tambah Data Education & Research',
            'page' => 'pendidikan-penelitian',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/education_research/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[education_research.tahun]',
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'jumlah_mk_keberlanjutan' => $this->request->getPost('jumlah_mk_keberlanjutan') ?? 0,
            'total_mk' => $this->request->getPost('total_mk') ?? 0,
            'rasio_mk_keberlanjutan' => $this->request->getPost('rasio_mk_keberlanjutan'),
            'pendanaan_penelitian_berkelanjutan' => $this->request->getPost('pendanaan_penelitian_berkelanjutan'),
            'total_pendanaan_penelitian' => $this->request->getPost('total_pendanaan_penelitian'),
            'rasio_pendanaan' => $this->request->getPost('rasio_pendanaan'),
            'jumlah_publikasi' => $this->request->getPost('jumlah_publikasi') ?? 0,
            'jumlah_kegiatan_berkelanjutan' => $this->request->getPost('jumlah_kegiatan_berkelanjutan') ?? 0,
            'kegiatan_mahasiswa' => $this->request->getPost('kegiatan_mahasiswa') ?? 0,
            'website_berkelanjutan' => $this->request->getPost('website_berkelanjutan'),
            'laporan_berkelanjutan' => $this->request->getPost('laporan_berkelanjutan'),
            'kegiatan_budaya' => $this->request->getPost('kegiatan_budaya') ?? 0,
            'kerjasama_internasional' => $this->request->getPost('kerjasama_internasional') ?? 0,
            'pengabdian_masyarakat' => $this->request->getPost('pengabdian_masyarakat') ?? 0,
            'startup_berkelanjutan' => $this->request->getPost('startup_berkelanjutan') ?? 0,
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/education-research')->with('success', 'Data berhasil ditambahkan');
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
            return redirect()->to('/education-research')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Education & Research',
            'page' => 'pendidikan-penelitian',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/education_research/edit', $data);
    }
    
    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => "required|integer|is_unique[education_research.tahun,id,{$id}]",
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'jumlah_mk_keberlanjutan' => $this->request->getPost('jumlah_mk_keberlanjutan') ?? 0,
            'total_mk' => $this->request->getPost('total_mk') ?? 0,
            'rasio_mk_keberlanjutan' => $this->request->getPost('rasio_mk_keberlanjutan'),
            'pendanaan_penelitian_berkelanjutan' => $this->request->getPost('pendanaan_penelitian_berkelanjutan'),
            'total_pendanaan_penelitian' => $this->request->getPost('total_pendanaan_penelitian'),
            'rasio_pendanaan' => $this->request->getPost('rasio_pendanaan'),
            'jumlah_publikasi' => $this->request->getPost('jumlah_publikasi') ?? 0,
            'jumlah_kegiatan_berkelanjutan' => $this->request->getPost('jumlah_kegiatan_berkelanjutan') ?? 0,
            'kegiatan_mahasiswa' => $this->request->getPost('kegiatan_mahasiswa') ?? 0,
            'website_berkelanjutan' => $this->request->getPost('website_berkelanjutan'),
            'laporan_berkelanjutan' => $this->request->getPost('laporan_berkelanjutan'),
            'kegiatan_budaya' => $this->request->getPost('kegiatan_budaya') ?? 0,
            'kerjasama_internasional' => $this->request->getPost('kerjasama_internasional') ?? 0,
            'pengabdian_masyarakat' => $this->request->getPost('pengabdian_masyarakat') ?? 0,
            'startup_berkelanjutan' => $this->request->getPost('startup_berkelanjutan') ?? 0,
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/education-research')->with('success', 'Data berhasil diupdate');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/education-research')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/education-research')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/education-research')->with('error', 'Gagal menghapus data');
    }
}