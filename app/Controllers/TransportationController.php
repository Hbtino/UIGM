<?php

namespace App\Controllers;

use App\Models\TransportationModel;

class TransportationController extends BaseController
{
    protected $model;
    
    public function __construct()
    {
        $this->model = new TransportationModel();
        helper(['form', 'url']);
    }
    
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Transportation - Data Capaian',
            'page' => 'transportasi',
            'data_tr' => $this->model->orderBy('tahun', 'DESC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role')
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
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
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
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $session->get('user_id')
        ];
        
        if ($this->model->insert($data)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil ditambahkan');
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
        
        $rules = [
            'tahun' => "required|integer|is_unique[transportation.tahun,id,{$id}]",
            'capaian_persen' => 'required|decimal'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'tahun' => $this->request->getPost('tahun'),
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
            'capaian_persen' => $this->request->getPost('capaian_persen'),
            'keterangan' => $this->request->getPost('keterangan'),
            'updated_by' => $session->get('user_id')
        ];
        
        if ($this->model->update($id, $data)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil diupdate');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal mengupdate data');
    }
    
    public function delete($id)
    {
        $session = session();
        if (!$session->get('logged_in') || $session->get('role') != 'admin') {
            return redirect()->to('/transportation')->with('error', 'Hanya admin yang dapat menghapus');
        }
        
        if ($this->model->delete($id)) {
            return redirect()->to('/transportation')->with('success', 'Data berhasil dihapus');
        }
        return redirect()->to('/transportation')->with('error', 'Gagal menghapus data');
    }
}