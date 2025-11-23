<?php
namespace app\Controllers;

use app\Models\Usuario;

class UsuarioController
{
    private $db;
    private $model;

    public function __construct($db)
    {
        $this->db = $db;
        $this->model = new Usuario($db);
    }

    public function index()
    {
        $usuarios = $this->model->all();
        require __DIR__ . "/../Views/usuarios/index.php";
    }

    public function create()
    {
        require __DIR__ . "/../Views/usuarios/create.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $active = isset($_POST['active']) ? 1 : 0;
            $passwordPlain = $_POST['password'] ?? '';
            $password = password_hash($passwordPlain, PASSWORD_DEFAULT);

            $this->model->create([
                'name'=>$name,'email'=>$email,'password'=>$password,'phone'=>$phone,'active'=>$active
            ]);
        }
        header("Location: /E-Coomerce-Painel/public/?param=usuario/index");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) { header("Location: /E-Coomerce-Painel/public/?param=usuario/index"); exit; }
        $usuario = $this->model->find($id);
        require __DIR__ . "/../Views/usuarios/edit.php";
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'name'=>trim($_POST['name'] ?? ''),
                'email'=>trim($_POST['email'] ?? ''),
                'phone'=>trim($_POST['phone'] ?? ''),
                'active'=>isset($_POST['active']) ? 1 : 0
            ];
            if (!empty($_POST['password'])) {
                $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            }
            if ($id) $this->model->update($id, $data);
        }
        header("Location: /E-Coomerce-Painel/public/?param=usuario/index");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) $this->model->delete($id);
        header("Location: /E-Coomerce-Painel/public/?param=usuario/index");
        exit;
    }
}
