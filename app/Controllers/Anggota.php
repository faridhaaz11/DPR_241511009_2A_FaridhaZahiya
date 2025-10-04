<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\GajiAnggotaModel;
use App\Models\PenggajianModel;
use CodeIgniter\Controller;

class Anggota extends Controller
{
    protected $anggotaModel;
    protected $komponenGajiModel;
    protected $gajiAnggotaModel;
    protected $penggajianModel;

    public function __construct()
    {
        $this->anggotaModel = new AnggotaModel();
        $this->komponenGajiModel = new KomponenGajiModel();
        $this->gajiAnggotaModel = new GajiAnggotaModel();
        $this->penggajianModel = new PenggajianModel();
        $this->db = \Config\Database::connect();
        helper(['form', 'url']);

        if (!$this->checkAuth()) {
            return redirect()->to('/login');
        }
    }

    private function checkAuth(): bool
    {
        return session()->get('logged_in') && session()->get('role') === 'Admin';
    }

    public function index()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        return view('anggota/index', $data);
    }

    public function tambah()
    {
        return view('anggota/tambah');
    }

    public function save()
    {

        $validation = \Config\Services::validation();
        $rules = [
            'id_anggota'        => 'required|integer|is_unique[anggota.id_anggota]',
            'gelar_depan'       => 'permit_empty|max_length[50]',
            'nama_depan'        => 'required|max_length[100]',
            'nama_belakang'     => 'required|max_length[100]',
            'gelar_belakang'    => 'permit_empty|max_length[50]',
            'jabatan'           => 'required|in_list[Ketua,Wakil Ketua,Anggota]',
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
            'jumlah_anak'       => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[10]',
        ];

        if (!$validation->setRules($rules)->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
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

        try {
            $this->anggotaModel->insert($data);
            return redirect()->to('/anggota')->with('success', 'Data anggota berhasil ditambahkan');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan data: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat menyimpan data. Cek log untuk detail.']);
        }
    
    }

    public function edit($id)
    {
        $data['anggota'] = $this->anggotaModel->find($id);
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
            'status_pernikahan' => 'required|in_list[Kawin,Belum Kawin,Cerai Hidup,Cerai Mati]',
            'jumlah_anak' => 'permit_empty|integer|greater_than_equal_to[0]|less_than_equal_to[10]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
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
            $this->anggotaModel->update($id, $data);
            return redirect()->to('/anggota')->with('success', 'Data anggota berhasil diperbarui');
        } catch (\Exception $e) {
            log_message('error', 'Gagal memperbarui data: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat memperbarui data. Cek log untuk detail.']);
        }
    }

    public function delete($id)
    {
        try {
            $this->anggotaModel->delete($id);
            return redirect()->to('/anggota')->with('success', 'Data anggota berhasil dihapus');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menghapus data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data. Cek log untuk detail.');
        }
    }

    public function tambahKomponenGaji()
    {
        return view('anggota/tambah_komponen_gaji');
    }

    public function saveKomponenGaji()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_komponen_gaji' => 'required|integer|is_unique[komponen_gaji.id_komponen_gaji]',
            'nama_komponen'    => 'required|max_length[100]',
            'kategori'         => 'required|in_list[Gaji Pokok,Tunjangan Melekat,Tunjangan Lain]',
            'jabatan'          => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal'          => 'required|numeric|greater_than[0]',
            'satuan'           => 'required|in_list[Bulan,Hari,Periode]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'id_komponen_gaji' => $this->request->getPost('id_komponen_gaji'),
            'nama_komponen'    => $this->request->getPost('nama_komponen'),
            'kategori'         => $this->request->getPost('kategori'),
            'jabatan'          => $this->request->getPost('jabatan'),
            'nominal'          => $this->request->getPost('nominal'),
            'satuan'           => $this->request->getPost('satuan'),
        ];

        try {
            $this->komponenGajiModel->insert($data);
            return redirect()->to('/anggota/lihatKomponenGaji')->with('success', 'Komponen gaji berhasil ditambahkan');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan komponen gaji: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat menyimpan data. Cek log untuk detail.']);
        }
    }

    public function lihatKomponenGaji()
    {
        $data['komponen'] = $this->komponenGajiModel->findAll();
        return view('anggota/lihat_komponen_gaji', $data);
    }

    public function editKomponenGaji($id)
    {
        $data['komponen'] = $this->komponenGajiModel->find($id);
        if (empty($data['komponen'])) {
            return redirect()->to('/anggota/lihatKomponenGaji')->with('error', 'Komponen gaji tidak ditemukan');
        }
        return view('anggota/edit_komponen_gaji', $data);
    }

    public function updateKomponenGaji($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_komponen' => 'required|max_length[100]',
            'kategori' => 'required|max_length[50]',
            'jabatan' => 'required|in_list[Ketua,Wakil Ketua,Anggota,Semua]',
            'nominal' => 'required|decimal|greater_than[0]',
            'satuan' => 'required|max_length[20]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama_komponen' => $this->request->getPost('nama_komponen'),
            'kategori' => $this->request->getPost('kategori'),
            'jabatan' => $this->request->getPost('jabatan'),
            'nominal' => $this->request->getPost('nominal'),
            'satuan' => $this->request->getPost('satuan'),
        ];

        try {
            $this->komponenGajiModel->update($id, $data);
            return redirect()->to('/anggota/lihatKomponenGaji')->with('success', 'Komponen gaji berhasil diperbarui');
        } catch (\Exception $e) {
            log_message('error', 'Gagal memperbarui komponen gaji: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat memperbarui data. Cek log untuk detail.']);
        }
    }

    public function deleteKomponenGaji($id)
    {
        try {
            $this->komponenGajiModel->delete($id);
            return redirect()->to('/anggota/lihatKomponenGaji')->with('success', 'Komponen gaji berhasil dihapus');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menghapus komponen gaji: ' . $e->getMessage());
            return redirect()->to('/anggota/lihatKomponenGaji')->with('error', 'Terjadi kesalahan saat menghapus data. Cek log untuk detail.');
        }
    }

    public function tambahPenggajian()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        $data['komponen'] = $this->komponenGajiModel->findAll();
        return view('anggota/tambah_penggajian', $data);
    }

    public function savePenggajian()
    {
        $validation = \Config\Services::validation();
        $idAnggota = $this->request->getPost('id_anggota');
        $idKomponenGaji = $this->request->getPost('id_komponen_gaji');

        // Ambil jabatan anggota
        $anggota = $this->anggotaModel->find($idAnggota);
        if (empty($anggota)) {
            return redirect()->back()->withInput()->with('errors', ['id_anggota' => 'Anggota tidak ditemukan']);
        }
        $jabatanAnggota = $anggota['jabatan'];

        // Validasi komponen sesuai jabatan
        $komponen = $this->komponenGajiModel->find($idKomponenGaji);
        if (empty($komponen)) {
            return redirect()->back()->withInput()->with('errors', ['id_komponen_gaji' => 'Komponen gaji tidak ditemukan']);
        }
        $jabatanKomponen = $komponen['jabatan'];
        if ($jabatanKomponen !== 'Semua' && $jabatanKomponen !== $jabatanAnggota) {
            return redirect()->back()->withInput()->with('errors', [
                'id_komponen_gaji' => "Komponen gaji untuk jabatan {$jabatanKomponen} tidak bisa diberikan ke anggota dengan jabatan {$jabatanAnggota}"
            ]);
        }

        // Validasi tidak boleh duplikat
        $existing = $this->penggajianModel->where('id_anggota', $idAnggota)
                                        ->where('id_komponen_gaji', $idKomponenGaji)
                                        ->first();
        if (!empty($existing)) {
            return redirect()->back()->withInput()->with('errors', ['id_komponen_gaji' => 'Komponen gaji ini sudah ditambahkan untuk anggota ini']);
        }

        $data = [
            'id_anggota' => $idAnggota,
            'id_komponen_gaji' => $idKomponenGaji,
        ];

        try {
            $this->penggajianModel->insert($data);
            return redirect()->to('/anggota/lihatPenggajian')->with('success', 'Data penggajian berhasil ditambahkan');
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan data penggajian: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat menyimpan data. Cek log untuk detail.']);
        }
    }

    public function lihatPenggajian()
    {
        $builder = $this->db->table('penggajian')
                            ->join('anggota', 'anggota.id_anggota = penggajian.id_anggota')
                            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
                            ->select('penggajian.id_anggota, penggajian.id_komponen_gaji, anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang, anggota.jabatan, komponen_gaji.nominal');

        $data['penggajian'] = $builder->get()->getResultArray();

        // Kelompokkan dan hitung Take Home Pay per anggota
        $groupedPenggajian = [];
        foreach ($data['penggajian'] as $row) {
            $idAnggota = $row['id_anggota'];
            if (!isset($groupedPenggajian[$idAnggota])) {
                $groupedPenggajian[$idAnggota] = $row;
                $groupedPenggajian[$idAnggota]['take_home_pay'] = 0;
            }
            $totalNominal = $this->db->table('penggajian')
                                ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
                                ->where('penggajian.id_anggota', $idAnggota)
                                ->selectSum('komponen_gaji.nominal')
                                ->get()
                                ->getRow()
                                ->nominal;
            $groupedPenggajian[$idAnggota]['take_home_pay'] = $totalNominal ?? 0;
        }
        $data['penggajian'] = array_values($groupedPenggajian);

        return view('anggota/lihat_penggajian', $data);
    }

    public function editPenggajian($idAnggota, $idKomponenGaji)
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        $data['komponen'] = $this->komponenGajiModel->findAll();
        $data['penggajian'] = $this->penggajianModel->where('id_anggota', $idAnggota)
                                                ->where('id_komponen_gaji', $idKomponenGaji)
                                                ->first();
        if (empty($data['penggajian'])) {
            return redirect()->to('/anggota/lihatPenggajian')->with('error', 'Data penggajian tidak ditemukan');
        }
        return view('anggota/edit_penggajian', $data);
    }

    public function updatePenggajian($idAnggota, $idKomponenGaji)
    {
        $validation = \Config\Services::validation();

        // Ambil data anggota untuk validasi jabatan
        $anggota = $this->anggotaModel->find($idAnggota);
        if (empty($anggota)) {
            return redirect()->back()->withInput()->with('errors', ['id_anggota' => 'Anggota tidak ditemukan']);
        }
        $jabatanAnggota = $anggota['jabatan'];

        // Ambil data komponen yang akan diubah
        $komponenBaru = $this->request->getPost('id_komponen_gaji');
        $komponen = $this->komponenGajiModel->find($komponenBaru);
        if (empty($komponen)) {
            return redirect()->back()->withInput()->with('errors', ['id_komponen_gaji' => 'Komponen gaji tidak ditemukan']);
        }
        $jabatanKomponen = $komponen['jabatan'];
        if ($jabatanKomponen !== 'Semua' && $jabatanKomponen !== $jabatanAnggota) {
            return redirect()->back()->withInput()->with('errors', ['id_komponen_gaji' => 'Komponen gaji tidak sesuai dengan jabatan anggota']);
        }

        // Validasi tidak boleh duplikat (kecuali data asli)
        $existing = $this->penggajianModel->where('id_anggota', $idAnggota)
                                        ->where('id_komponen_gaji', $komponenBaru)
                                        ->first();
        if (!empty($existing) && ($existing['id_komponen_gaji'] != $idKomponenGaji || $existing['id_anggota'] != $idAnggota)) {
            return redirect()->back()->withInput()->with('errors', ['id_komponen_gaji' => 'Komponen gaji ini sudah ditambahkan untuk anggota ini']);
        }

        $data = [
            'id_anggota' => $idAnggota,
            'id_komponen_gaji' => $komponenBaru,
        ];

        try {
            $this->penggajianModel->where('id_anggota', $idAnggota)
                                ->where('id_komponen_gaji', $idKomponenGaji)
                                ->delete();
            $this->penggajianModel->insert($data);
            return redirect()->to('/anggota/lihatPenggajian')->with('success', 'Data penggajian berhasil diperbarui');
        } catch (\Exception $e) {
            log_message('error', 'Gagal memperbarui data penggajian: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('errors', ['system' => 'Terjadi kesalahan saat memperbarui data. Cek log untuk detail.']);
        }
    }


}
