<?php

namespace App\Controllers\Public;

use CodeIgniter\Controller;

class Dashboard extends Controller
{
    public function index()
    {
        return view('public/dashboard');
    }
}