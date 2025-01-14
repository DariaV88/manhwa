<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{

    private CategoryService $service;

    private function service(): CategoryService
    {
        if (! isset($this->service)) {
            $this->service = new CategoryService($this->db());
        }

        return $this->service;
    }


    public function add() :void
    {
        $this->view('/admin/categories/add', [], 'Добавление категории');
    }

    public function store() 
    {

      $validation = $this->request()->validate(['name' => ['required', 'min:3', 'max:100']]);

      if(! $validation) {
        foreach ($this->request()->errors() as $field => $errors) {
          $this->session()->set($field, $errors);
        }
       $this->redirect('/admin/categories/add');
      }

      $this->service()->store($this->request()->input('name'));

      $this->redirect('/admin');
    }

    public function delete(): void
    {
      $this->service()->delete($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $category = $this->service()->find($this->request()->input('id'));

        $this->view('admin/categories/update', [
            'category' => $category,
        ], 'Изменение категории');
    }

    public function update()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/categories/update?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name')
        );

        $this->redirect('/admin');
    }
}