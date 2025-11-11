<?php

namespace App\Controllers;

use App\Models\WasteManagementModel;

class WasteManagementController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new WasteManagementModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Waste Management - Data Capaian',
            'page' => 'limbah',
            'data_ws' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/waste_management/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in') || !in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/waste-management')->with('error', 'Akses ditolak');
        }
        
        $data = [
            'title' => 'Tambah Data Waste Management',
            'page' => 'limbah',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/waste_management/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[waste_management.tahun]',
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'program_3r' => $this->request->getPost('program_3r'),
            'pengurangan_kertas_plastik' => $this->request->getPost('pengurangan_kertas_plastik'),
            'pengolahan_organik' => $this->request->getPost('pengolahan_organik'),
            'pengolahan_anorganik' => $this->request->getPost('pengolahan_anorganik'),
            'pengolahan_beracun' => $this->request->getPost('pengolahan_beracun'),
            'sistem_pembuangan' => $this->request->getPost('sistem_pembuangan'),
            'volume_limbah_per_orang' => $this->request->getPost('volume_limbah_per_orang'),
            'persentase_daur_ulang' => $this->request->getPost('persentase_daur_ulang'),
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil ditambahkan');
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
            return redirect()->to('/waste-management')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Waste Management',
            'page' => 'limbah',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/waste_management/edit', $data);
    }
    
    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => "required|integer|is_unique[waste_management.tahun,id,{$id}]",
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'program_3r' => $this->request->getPost('program_3r'),
            'pengurangan_kertas_plastik' => $this->request->getPost('pengurangan_kertas_plastik'),
            'pengolahan_organik' => $this->request->getPost('pengolahan_organik'),
            'pengolahan_anorganik' => $this->request->getPost('pengolahan_anorganik'),
            'pengolahan_beracun' => $this->request->getPost('pengolahan_beracun'),
            'sistem_pembuangan' => $this->request->getPost('sistem_pembuangan'),
            'volume_limbah_per_orang' => $this->request->getPost('volume_limbah_per_orang'),
            'persentase_daur_ulang' => $this->request->getPost('persentase_daur_ulang'),
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil diupdate');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/waste-management')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/waste-management')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/waste-management')->with('error', 'Gagal menghapus data');
    }
}