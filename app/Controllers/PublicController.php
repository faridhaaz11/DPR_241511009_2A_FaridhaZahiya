<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\KomponenGajiModel;
use App\Models\PenggajianModel;
use CodeIgniter\Controller;

class PublicController extends Controller
{
    protected $anggotaModel;
    protected $komponenGajiModel;
    protected $penggajianModel;
    protected $db;

    public function __construct()
    {
        $this->anggotaModel = model(AnggotaModel::class);
        $this->komponenGajiModel = model(KomponenGajiModel::class);
        $this->penggajianModel = model(PenggajianModel::class);
        $this->db = \Config\Database::connect(); // Tambahkan inisialisasi $db
    }

    public function anggota()
    {
        $data['anggota'] = $this->anggotaModel->findAll();
        return view('public/anggota', $data);
    }

    public function lihatPenggajianPublic()
    {
        $builder = $this->db->table('penggajian')
                            ->join('anggota', 'anggota.id_anggota = penggajian.id_anggota')
                            ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
                            ->select('penggajian.id_anggota, anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang, anggota.jabatan, komponen_gaji.nominal')
                            ->groupBy('penggajian.id_anggota, anggota.gelar_depan, anggota.nama_depan, anggota.nama_belakang, anggota.gelar_belakang, anggota.jabatan');

        $data['penggajian'] = $builder->get()->getResultArray();

        // Take Home Pay 
        foreach ($data['penggajian'] as &$row) {
            $totalNominal = $this->db->table('penggajian')
                                   ->join('komponen_gaji', 'komponen_gaji.id_komponen_gaji = penggajian.id_komponen_gaji')
                                   ->where('penggajian.id_anggota', $row['id_anggota'])
                                   ->selectSum('komponen_gaji.nominal')
                                   ->get()
                                   ->getRow()
                                   ->nominal;
            $row['take_home_pay'] = $totalNominal ?? 0;
        }

        return view('public/penggajian', $data);
    }
}