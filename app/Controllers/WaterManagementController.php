<?php

namespace App\Controllers;

use App\Models\WaterManagementModel;

class WaterManagementController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new WaterManagementModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Water Management - Data Capaian',
            'page' => 'air',
            'data_wr' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/water_management/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/water-management')->with('error', 'Akses ditolak');
        }
        
        $data = [
            'title' => 'Tambah Data Water Management',
            'page' => 'air',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/water_management/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[water_management.tahun]',
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'program_daur_ulang_air' => $this->request->getPost('program_daur_ulang_air'),
            'peralatan_hemat_air' => $this->request->getPost('peralatan_hemat_air') ?? 0,
            'konsumsi_air_diolah' => $this->request->getPost('konsumsi_air_diolah'),
            'pengendalian_pencemaran' => $this->request->getPost('pengendalian_pencemaran'),
            'volume_air_per_orang' => $this->request->getPost('volume_air_per_orang'),
            'persentase_air_daur_ulang' => $this->request->getPost('persentase_air_daur_ulang'),
            'kualitas_air' => $this->request->getPost('kualitas_air'),
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/water-management')->with('success', 'Data berhasil ditambahkan');
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
            return redirect()->to('/water-management')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Water Management',
            'page' => 'air',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/water_management/edit', $data);
    }
    
    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => "required|integer|is_unique[water_management.tahun,id,{$id}]",
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'program_daur_ulang_air' => $this->request->getPost('program_daur_ulang_air'),
            'peralatan_hemat_air' => $this->request->getPost('peralatan_hemat_air') ?? 0,
            'konsumsi_air_diolah' => $this->request->getPost('konsumsi_air_diolah'),
            'pengendalian_pencemaran' => $this->request->getPost('pengendalian_pencemaran'),
            'volume_air_per_orang' => $this->request->getPost('volume_air_per_orang'),
            'persentase_air_daur_ulang' => $this->request->getPost('persentase_air_daur_ulang'),
            'kualitas_air' => $this->request->getPost('kualitas_air'),
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/water-management')->with('success', 'Data berhasil diupdate');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/water-management')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/water-management')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/water-management')->with('error', 'Gagal menghapus data');
    }
}