<?php
namespace app\Controllers;

use app\Models\Produto;
use app\Models\Categoria;

class ProdutoController
{
    private $db;
    private $model;
    private $categoriaModel;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new Produto($db);
        $this->categoriaModel = new Categoria($db);
    }

    public function index()
    {
        $produtos = $this->model->all();
        require __DIR__ . "/../Views/produtos/index.php";
    }

    public function create()
    {
        $categorias = $this->categoriaModel->all();
        require __DIR__ . "/../Views/produtos/create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nome' => trim($_POST['nome'] ?? ''),
                'descricao' => trim($_POST['descricao'] ?? ''),
                'preco' => floatval(str_replace(',', '.', $_POST['preco'] ?? 0)),
                'categoria_id' => $_POST['categoria_id'] ?? null
            ];
            $this->model->create($data);
        }
        header("Location: /E-Coomerce-Painel/public/?param=produto/index");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: /E-Coomerce-Painel/public/?param=produto/index"); exit; }
        $produto = $this->model->find($id);
        $categorias = $this->categoriaModel->all();
        require __DIR__ . "/../Views/produtos/edit.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'nome' => trim($_POST['nome'] ?? ''),
                'descricao' => trim($_POST['descricao'] ?? ''),
                'preco' => floatval(str_replace(',', '.', $_POST['preco'] ?? 0)),
                'categoria_id' => $_POST['categoria_id'] ?? null
            ];
            if ($id) $this->model->update($id, $data);
        }
        header("Location: /E-Coomerce-Painel/public/?param=produto/index");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) $this->model->delete($id);
        header("Location: /E-Coomerce-Painel/public/?param=produto/index");
        exit;
    }
}
