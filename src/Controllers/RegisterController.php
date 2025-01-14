<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller {

    public function index(): void
    {
        $this->view('register', [], 'Регистрация');
    }

    public function register(): void
    {
        $validation = $this->request()->validate([
            "name" => ["required", "max:255"],
            "email" => ["required", "email"],
            "password" => ["required", "min:8", "confirmed"],
            "password_confirmation" => ["required", "min:8"],
        ]);

        if(! $validation) {
          foreach ($this->request()->errors() as $field => $errors) {
            $this->session()->set($field, $errors);
          }
         $this->redirect('/register');
        }

        $id = $this->db()->insert('users', [
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT),
          ]);

          $this->redirect('/');
    }
}