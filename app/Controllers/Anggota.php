<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use CodeIgniter\Controller;

class Anggota extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new AnggotaModel();
        helper(['form', 'url']);
    }

    private function checkAuth()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'Admin') {
            return redirect()->to('/login');
        }
        return null;
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data['anggota'] = $this->model->findAll();
        return view('anggota/index', $data);
    }

    public function tambah()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        return view('anggota/tambah');
    }

    public function save()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $validation = \Config\Services::validation();
        $rules = [
            'id_anggota'        => 'required|integer|is_unique[anggota.id_anggota]',
            'gelar_depan'       => 'permit_empty|max_length[50]',
            'nama_depan'        => 'required|max_length[100]',
            'nama_belakang'     => 'required|max_length[100]',
            'gelar_belakang'    => 'permit_empty|max_length[50]',
            'jabatan'           => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin, Cerai Hidup, Cerai Mati]',
            'jumlah_anak'       => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[10]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_anggota'        => $this->request->getPost('id_anggota'),
            'gelar_depan'       => $this->request->getPost('gelar_depan'),
            'nama_depan'        => $this->request->getPost('nama_depan'),
            'nama_belakang'     => $this->request->getPost('nama_belakang'),
            'gelar_belakang'    => $this->request->getPost('gelar_belakang'),
            'jabatan'           => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak'       => $this->request->getPost('jumlah_anak') ?: 0,
        ];

        $this->model->insert($data);

        return redirect()->to(site_url('anggota'))->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data['anggota'] = $this->model->find($id);
        if (empty($data['anggota'])) {
            return redirect()->to('/anggota')->with('error', 'Data anggota tidak ditemukan');
        }
        return view('anggota/edit', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'gelar_depan' => 'permit_empty|max_length[50]',
            'nama_depan' => 'required|max_length[100]',
            'nama_belakang' => 'required|max_length[100]',
            'gelar_belakang' => 'permit_empty|max_length[50]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin, Cerai Hidup, Cerai Mati]',
            'jumlah_anak' => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[10]',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'gelar_depan' => $this->request->getPost('gelar_depan'),
            'nama_depan' => $this->request->getPost('nama_depan'),
            'nama_belakang' => $this->request->getPost('nama_belakang'),
            'gelar_belakang' => $this->request->getPost('gelar_belakang'),
            'jabatan' => $this->request->getPost('jabatan'),
            'status_pernikahan' => $this->request->getPost('status_pernikahan'),
            'jumlah_anak' => $this->request->getPost('jumlah_anak') ?? 0,
        ];

        try {
            $this->model->update($id, $data);
            return redirect()->to('/anggota')->with('success', 'Data anggota berhasil diperbarui');
        } catch (\Exception $e) {
            log_message('error', 'Gagal memperbarui data: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat memperbarui data. Cek log untuk detail.']);
        }
    }

    public function delete($id)
    {
        try {
            $this->model->delete($id);
            return redirect()->to('/anggota')->with('success', 'Data anggota berhasil dihapus');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menghapus data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data. Cek log untuk detail.');
        }
    }

}
