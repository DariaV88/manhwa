<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Validator\Validator;
use App\Services\CategoryService;
use App\Services\ManhwaService;

class ManhwaController extends Controller
{
  private ManhwaService $service;
  private CategoryService $categoryService;

  private function service(): ManhwaService
  {
      if (! isset($this->service)) {
          $this->service = new ManhwaService($this->db());
      }

      return $this->service;
  }

  private function categoryService(): CategoryService
  {
      if (! isset($this->categoryService)) {
          $this->categoryService = new CategoryService($this->db());
      }

      return $this->categoryService;
  }

  public function create(): void
  {
      $categories = new CategoryService($this->db());

      $this->view('admin/manhwas/add', [
          'categories' => $categories->all(),
      ], 'Добавление манхвы');
  }

    public function store(): void
    {

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category' => ['required'],
            'link' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect('/admin/manhwas/add');
        }

        $this->service()->store(
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('preview'),
            $this->request()->input('category'),
            $this->request()->input('link'),
        );

        $this->redirect('/admin');
    }

    public function delete(): void
    {
        $this->service()->delete($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $categories = new CategoryService($this->db());

        $this->view('admin/manhwas/update', [
            'manhwa' => $this->service()->find($this->request()->input('id')),
            'categories' => $categories->all(),
        ], 'Обновление манхвы');
    }

    public function update()
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'description' => ['required'],
            'category' => ['required'],
            'link' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $field => $errors) {
                $this->session()->set($field, $errors);
            }

            $this->redirect("/admin/manhwas/update?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name'),
            $this->request()->input('description'),
            $this->request()->file('image'),
            $this->request()->input('category'),
            $this->request()->input('link'),
        );

        $this->redirect('/admin');
    }

    public function show(): void
    {
        $categories = new CategoryService($this->db());

        $manhwa = $this->service()->find($this->request()->input('id'));
        
        $categoryId = $manhwa->categoryId();
        $category = $this->categoryService()->find($categoryId);

        $this->view('manhwa', [
            'manhwa' => $manhwa,
            'category' => $category,
        ], "Манхва - {$manhwa->name()}");
    }

    
    public function random(): void
    {
        // $categories = new CategoryService($this->db());

        $sum = $this->service()->sum();

        $id = rand(1, $sum);

        $manhwa = $this->service()->find($id);
        
        $categoryId = $manhwa->categoryId();
        $category = $this->categoryService()->find($categoryId);

        $this->view('manhwa', [
            'manhwa' => $manhwa,
            'category' => $category,
        ], "Манхва - {$manhwa->name()}");
    }

    public function search(): void
    {
        $text = $this->request()->input('search');

        $manhwas = $this->service()->search($text);

        $this->view('search', [
            'manhwas' => $manhwas,
        ], 'Результаты поиска');
    }

    public function category(): void
    {
        $categories = new CategoryService($this->db());

        $id = $this->request()->input('id');

        $manhwas = $this->service()-> categorySearch($id);

        $this->view('all', [
            'categories' => $categories->all(),
            'manhwas' => $manhwas,
        ]);
    }


    public function all(): void
    {
        $categories = new CategoryService($this->db());
        $manhwas = new ManhwaService($this->db());
  
        $this->view('/all', [
          'categories' => $categories->all(),
          'manhwas' => $manhwas->all(),
      ], 'Все тайтлы');
    }

}