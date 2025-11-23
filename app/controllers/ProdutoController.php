<?php
namespace app\Controllers;

use app\Models\Produto;
use app\Models\Categoria;

class ProdutoController
{
    private $model;
    private $categoriaModel;

    public function __construct($db)
    {
        $this->model = new Produto($db);
        $this->categoriaModel = new Categoria($db);
    }

    public function index()
    {
        $produtos = $this->model->all();
        require __DIR__ . '/../Views/produtos/index.php';
    }

    public function create()
    {
        $categorias = $this->categoriaModel->all();
        require __DIR__ . '/../Views/produtos/create.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Upload da imagem
            $imageName = null;
            if (!empty($_FILES['image']['name'])) {
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($imageTmp, __DIR__ . '/../../public/uploads/' . $imageName);
            }

            $data = [
                'name' => $_POST['name'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'category_id' => $_POST['category_id'] ?? null,
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'stock_quantity' => $_POST['stock_quantity'] ?? 0,
                'featured' => isset($_POST['featured']) ? 1 : 0,
                'active' => isset($_POST['active']) ? 1 : 0,
                'image' => $imageName
            ];

            $this->model->create($data);
            header("Location: /E-Coomerce-Painel/public/produto");
            exit;
        }
    }

    public function edit($id)
    {
        $produto = $this->model->find($id);
        $categorias = $this->categoriaModel->all();
        require __DIR__ . '/../Views/produtos/edit.php';
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $produto = $this->model->find($id);

            $imageName = $produto['image'] ?? null;
            if (!empty($_FILES['image']['name'])) {
                $imageTmp = $_FILES['image']['tmp_name'];
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                move_uploaded_file($imageTmp, __DIR__ . '/../../public/uploads/' . $imageName);
            }

            $data = [
                'name' => $_POST['name'] ?? '',
                'slug' => $_POST['slug'] ?? '',
                'category_id' => $_POST['category_id'] ?? null,
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? 0,
                'stock_quantity' => $_POST['stock_quantity'] ?? 0,
                'featured' => isset($_POST['featured']) ? 1 : 0,
                'active' => isset($_POST['active']) ? 1 : 0,
                'image' => $imageName
            ];

            $this->model->update($id, $data);
            header("Location: /E-Coomerce-Painel/public/produto");
            exit;
        }
    }

    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: /E-Coomerce-Painel/public/produto");
        exit;
    }
}
