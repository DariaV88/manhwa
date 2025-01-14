<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Validator\Validator;
use App\Services\CategoryService;
use App\Services\ManhwaService;

class AdminController extends Controller
{

  public function index(): void
  {
      $categories = new CategoryService($this->db());
      $manhwas = new ManhwaService($this->db());

      $this->view('/admin/index', [
        'categories' => $categories->all(),
        'manhwas' => $manhwas->all(),
    ], 'Админ панель');
  }

}