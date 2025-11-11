<?php

namespace App\Controllers;

use App\Models\EnergyClimateModel;

class EnergyClimateController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new EnergyClimateModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Energy & Climate Change - Data Capaian',
            'page' => 'energi-iklim',
            'data_ec' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/energy_climate/index', $data);
    }
    
    public function create()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        if (!in_array($session->get('role'), ['admin', 'kaprodi'])) {
            return redirect()->to('/energy-climate')->with('error', 'Anda tidak memiliki akses');
        }
        
        $data = [
            'title' => 'Tambah Data Energy & Climate Change',
            'page' => 'energi-iklim',
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/energy_climate/create', $data);
    }
    
    public function store()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => 'required|integer|is_unique[energy_climate.tahun]',
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'peralatan_hemat_energi' => $this->request->getPost('peralatan_hemat_energi') ?? 0,
            'bangunan_cerdas' => $this->request->getPost('bangunan_cerdas') ?? 0,
            'jumlah_energi_terbarukan' => $this->request->getPost('jumlah_energi_terbarukan') ?? 0,
            'total_listrik_per_orang' => $this->request->getPost('total_listrik_per_orang'),
            'rasio_energi_terbarukan' => $this->request->getPost('rasio_energi_terbarukan'),
            'bangunan_ramah_lingkungan' => $this->request->getPost('bangunan_ramah_lingkungan') ?? 0,
            'program_pengurangan_emisi' => $this->request->getPost('program_pengurangan_emisi') ?? 0,
            'jejak_karbon_per_orang' => $this->request->getPost('jejak_karbon_per_orang'),
            'program_inovatif_energi' => $this->request->getPost('program_inovatif_energi') ?? 0,
            'program_dampak_iklim' => $this->request->getPost('program_dampak_iklim') ?? 0,
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data');
        }
    }
    
    public function edit($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        if (!in_array($session->get('role'), ['admin', 'kaprodi', 'dosen'])) {
            return redirect()->to('/energy-climate')->with('error', 'Anda tidak memiliki akses');
        }
        
        $dataItem = $this->model->find($id);
        
        if (!$dataItem) {
            return redirect()->to('/energy-climate')->with('error', 'Data tidak ditemukan');
        }
        
        $data = [
            'title' => 'Edit Data Energy & Climate Change',
            'page' => 'energi-iklim',
            'data_item' => $dataItem,
            'validation' => \Config\Services::validation(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
        ];
        
        return view('kriteria/energy_climate/edit', $data);
    }
    
    public function update($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $rules = [
            'tahun' => "required|integer|is_unique[energy_climate.tahun,id,{$id}]",
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'peralatan_hemat_energi' => $this->request->getPost('peralatan_hemat_energi') ?? 0,
            'bangunan_cerdas' => $this->request->getPost('bangunan_cerdas') ?? 0,
            'jumlah_energi_terbarukan' => $this->request->getPost('jumlah_energi_terbarukan') ?? 0,
            'total_listrik_per_orang' => $this->request->getPost('total_listrik_per_orang'),
            'rasio_energi_terbarukan' => $this->request->getPost('rasio_energi_terbarukan'),
            'bangunan_ramah_lingkungan' => $this->request->getPost('bangunan_ramah_lingkungan') ?? 0,
            'program_pengurangan_emisi' => $this->request->getPost('program_pengurangan_emisi') ?? 0,
            'jejak_karbon_per_orang' => $this->request->getPost('jejak_karbon_per_orang'),
            'program_inovatif_energi' => $this->request->getPost('program_inovatif_energi') ?? 0,
            'program_dampak_iklim' => $this->request->getPost('program_dampak_iklim') ?? 0,
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
        }
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        if ($session->get('role') != 'admin') {
            return redirect()->to('/energy-climate')->with('error', 'Hanya admin yang dapat menghapus data');
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/energy-climate')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect()->to('/energy-climate')->with('error', 'Gagal menghapus data');
        }
    }
}