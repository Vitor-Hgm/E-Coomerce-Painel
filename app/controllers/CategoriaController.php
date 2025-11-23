<?php

namespace app\Controllers;

use app\Models\Categoria;

class CategoriaController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Categoria($db);
    }

    public function index()
    {
        $categorias = $this->model->all();
        require __DIR__ . '/../Views/categorias/index.php';
    }

    public function create()
    {
        require __DIR__ . '/../Views/categorias/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0,
                'active' => isset($_POST['active']) ? 1 : 0  // <-- Corrigido
            ];
            $this->model->create($data);
            header("Location: /E-Coomerce-Painel/public/categoria");
            exit;
        }
    }


    public function edit($id)
    {
        $categoria = $this->model->find($id);
        require __DIR__ . '/../Views/categorias/edit.php';
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'description' => $_POST['description'] ?? '',
                'sort_order' => $_POST['sort_order'] ?? 0,
                'active' => isset($_POST['active']) ? 1 : 0  // <-- Corrigido
            ];
            $this->model->update($id, $data);
            header("Location: /E-Coomerce-Painel/public/categoria");
            exit;
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);
        // Redireciona para a listagem de categorias correta
        header("Location: /E-Coomerce-Painel/public/categoria");
        exit;
    }
}
