<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use CodeIgniter\Controller;

class PublicController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new AnggotaModel();
    }

    public function anggota()
    {
        $data['anggota'] = $this->model->findAll();
        return view('public/anggota', $data);
    }
}