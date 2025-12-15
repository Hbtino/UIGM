<?php

namespace App\Controllers;

use App\Models\CapaianModel;

class CapaianController extends BaseController
{
    public function index()
    {
        $model = new CapaianModel();

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

        $data = [
            'capaian' => $model->where('user_id', session()->get('user_id'))->findAll(),
            'title' => 'Capaian - Kampus Berkelanjutan',
            'page' => 'capaian',
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('capaian/index', $data);
    }

    public function create()
    {
        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

        $data = [
            'title' => 'Tambah Capaian - Kampus Berkelanjutan',
            'page' => 'capaian',
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('capaian/create', $data);
    }

    public function store()
    {
        $model = new CapaianModel();
        $model->insert([
            'user_id' => session()->get('user_id'),
            'judul'   => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal' => $this->request->getVar('tanggal'),
            'status'  => 'draft'
        ]);

        return redirect()->to('/capaian')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $model = new CapaianModel();

        // Get user data for profile photo
        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('user_id'));

        $data = [
            'capaian' => $model->find($id),
            'title' => 'Edit Capaian - Kampus Berkelanjutan',
            'page' => 'capaian',
            'user_name' => session()->get('name'),
            'user_role' => session()->get('role'),
            'profile_photo' => $user['profile_photo'] ?? null
        ];

        return view('capaian/edit', $data);
    }

    public function update($id)
    {
        $model = new CapaianModel();
        $model->update($id, [
            'judul' => $this->request->getVar('judul'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tanggal' => $this->request->getVar('tanggal'),
        ]);
        return redirect()->to('/capaian')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $model = new CapaianModel();
        $model->delete($id);
        return redirect()->to('/capaian')->with('success', 'Data berhasil dihapus');
    }
}
