<?php

namespace App\Controllers;

use App\Models\SettingInfrastructureModel;

class SettingInfrastructureController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new SettingInfrastructureModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title'     => 'Data Pengaturan & Infrastruktur',
            'page'      => 'pengaturan-infrastruktur',
            'data_si'   => $this->model->orderBy('tahun', 'ASC')->findAll(),
            'user_name' => $session->get('name'),
            'user_role' => $session->get('role'),
        ];

        return view('kriteria/setting_infrastructure/index', $data);
    }

    public function create()
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Tambah Pengaturan & Infrastruktur',
            'page'  => 'pengaturan-infrastruktur',
        ];

        return view('kriteria/setting_infrastructure/create', $data);
    }

    public function store()
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Validation rules (sesuai dengan field yang Anda miliki)
        $rules = [
            'tahun' => 'required|integer|min_length[4]|max_length[4]',
            'luas_ruang_terbuka' => 'required|decimal',
            'luas_total' => 'required|decimal',
            'vegetasi_hutan' => 'required|decimal',
            'area_tanaman' => 'required|decimal',
            'area_resapan' => 'required|decimal',
            'persentase_anggaran' => 'required|decimal',
            'persentase_pemeliharaan' => 'required|decimal',
            'fasilitas_disabilitas' => 'required|in_list[Ada,Tidak Ada]',
            'fasilitas_energi_terbarukan' => 'required|in_list[Ada,Tidak Ada]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'luas_ruang_terbuka' => $this->request->getPost('luas_ruang_terbuka'),
            'luas_total' => $this->request->getPost('luas_total'),
            'vegetasi_hutan' => $this->request->getPost('vegetasi_hutan'),
            'area_tanaman' => $this->request->getPost('area_tanaman'),
            'area_resapan' => $this->request->getPost('area_resapan'),
            'persentase_anggaran' => $this->request->getPost('persentase_anggaran'),
            'persentase_pemeliharaan' => $this->request->getPost('persentase_pemeliharaan'),
            'fasilitas_disabilitas' => $this->request->getPost('fasilitas_disabilitas'),
            'fasilitas_energi_terbarukan' => $this->request->getPost('fasilitas_energi_terbarukan'),
        ];

        $this->model->insert($data);

        return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id = null)
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $item = $this->model->find($id);
        if (! $item) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => 'Edit Pengaturan & Infrastruktur',
            'page'  => 'pengaturan-infrastruktur',
            'item'  => $item,
        ];

        return view('kriteria/setting_infrastructure/edit', $data);
    }

    public function update($id = null)
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $rules = [
            'tahun' => 'required|integer|min_length[4]|max_length[4]',
            // tambahkan rule lain bila perlu
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'tahun' => $this->request->getPost('tahun'),
            'luas_ruang_terbuka' => $this->request->getPost('luas_ruang_terbuka'),
            'luas_total' => $this->request->getPost('luas_total'),
            'vegetasi_hutan' => $this->request->getPost('vegetasi_hutan'),
            'area_tanaman' => $this->request->getPost('area_tanaman'),
            'area_resapan' => $this->request->getPost('area_resapan'),
            'persentase_anggaran' => $this->request->getPost('persentase_anggaran'),
            'persentase_pemeliharaan' => $this->request->getPost('persentase_pemeliharaan'),
            'fasilitas_disabilitas' => $this->request->getPost('fasilitas_disabilitas'),
            'fasilitas_energi_terbarukan' => $this->request->getPost('fasilitas_energi_terbarukan'),
        ];

        $this->model->update($id, $data);

        return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil diupdate.');
    }

    public function delete($id = null)
    {
        $session = session();
        if (! $session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (! $id) {
            return redirect()->back()->with('error', 'ID tidak ditemukan.');
        }

        $this->model->delete($id);

        return redirect()->to('/setting-infrastructure')->with('success', 'Data berhasil dihapus.');
    }
}
