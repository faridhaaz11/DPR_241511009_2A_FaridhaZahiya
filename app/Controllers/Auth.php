<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        if (session()->get('logged_in')) {
            if (session()->get('role') == 'Admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/public/dashboard');
            }
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $model = new PenggunaModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id_pengguna' => $user['id_pengguna'],
                'email' => $user['email'],
                'role' => $user['role'],
                'logged_in' => true,
            ]);
            if ($user['role'] == 'Admin') {
                return redirect()->to('/admin/dashboard')->with('success', 'Selamat datang, Admin!');
            } else {
                return redirect()->to('/public/dashboard')->with('success', 'Selamat datang!');
            }
        } else {
            session()->setFlashdata('error', 'Username atau password salah');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}