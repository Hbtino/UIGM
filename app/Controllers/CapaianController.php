<?php

namespace App\Controllers;

use App\Models\CapaianModel;

class CapaianController extends BaseController
{
    public function index()
    {
        $model = new CapaianModel();
        $data['capaian'] = $model->where('user_id', session()->get('user_id'))->findAll();
        return view('capaian/index', $data);
    }

    public function create()
    {
        return view('capaian/create');
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
        $data['capaian'] = $model->find($id);
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
