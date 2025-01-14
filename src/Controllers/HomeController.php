<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\ManhwaService;

class HomeController extends Controller
{
    public function index(): void
    {
        $manhwas = new ManhwaService($this->db());

        $this->view('home', [
            'manhwas' => $manhwas->new(),
        ], 'Главная');
    }
}