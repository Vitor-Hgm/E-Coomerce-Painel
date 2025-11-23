<?php
namespace app\Controllers;

use app\Models\Categoria;

class CategoriaController
{
    private $db;
    private $model;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new Categoria($db);
    }

    public function index()
    {
        // pega todas
        $categorias = $this->model->all();
        require __DIR__ . "/../Views/categorias/index.php";
    }

    public function create()
    {
        require __DIR__ . "/../Views/categorias/create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            if ($nome === '') {
                $_SESSION['flash_error'] = "O nome da categoria é obrigatório.";
                header("Location: /E-Coomerce-Painel/public/?param=categoria/create");
                exit;
            }
            $this->model->create($nome);
        }
        header("Location: /E-Coomerce-Painel/public/?param=categoria/index");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: /E-Coomerce-Painel/public/?param=categoria/index"); exit; }
        $categoria = $this->model->find($id);
        require __DIR__ . "/../Views/categorias/edit.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $nome = trim($_POST['nome'] ?? '');
            if ($id && $nome !== '') {
                $this->model->update($id, $nome);
            }
        }
        header("Location: /E-Coomerce-Painel/public/?param=categoria/index");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) $this->model->delete($id);
        header("Location: /E-Coomerce-Painel/public/?param=categoria/index");
        exit;
    }
}
                    