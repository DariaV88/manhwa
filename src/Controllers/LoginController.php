<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller {

    public function index(): void
    {
        $this->view('login', [], 'Логин');
    }

    public function login()
    {
      $email = $this->request()->input('email');
      $password = $this->request()->input('password');
     

      if($this->auth()->attempt($email, $password)) {
        return $this->redirect("/");
      }

      $this->session()->set('error', 'Неверный логин или пароль');
      return $this->redirect("/login");

    }

    public function logout()
    {
      $this->auth()->logout();

      return $this->redirect("/login");
    }
}