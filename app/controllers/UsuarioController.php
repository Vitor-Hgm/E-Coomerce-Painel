<?php

namespace app\Controllers;

use app\Core\Auth;
use app\Models\Usuario;

class UsuarioController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Usuario($db);
    }

    // Lista de usuários
    public function index()
    {
        Auth::check();
        Auth::requireAdmin();

        $usuarios = $this->model->all();
        require __DIR__ . '/../Views/usuarios/index.php';
    }

    // Página de criar usuário
    public function create()
    {
        Auth::check();
        Auth::requireAdmin();

        require __DIR__ . '/../Views/usuarios/create.php';
    }

    // Salvar novo usuário
    public function store()
    {
        Auth::check();
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';

            // ❗ Checa se email já existe
            if ($this->model->findByEmail($email)) {
                $_SESSION['error'] = "O e-mail '{$email}' já está cadastrado!";
                header("Location: /E-Coomerce-Painel/public/usuario/create");
                exit;
            }

            $data = [
                'name'          => $_POST['name'] ?? '',
                'email'         => $email,
                'password'      => $_POST['password'], // senha pura, o model vai gerar hash
                'phone'         => $_POST['phone'] ?? null,
                'birth_date'    => $_POST['birth_date'] ?? null,
                'gender'        => $_POST['gender'] ?? null,
                'newsletter'    => isset($_POST['newsletter']) ? 1 : 0,
                'sms_marketing' => isset($_POST['sms_marketing']) ? 1 : 0,
                'active'        => isset($_POST['active']) ? 1 : 0,
                'role'          => $_POST['role'] ?? 'user'
            ];

            $this->model->create($data);

            $_SESSION['success'] = "Usuário criado com sucesso!";
            header("Location: /E-Coomerce-Painel/public/usuario/index");
            exit;
        }
    }

    // Página de edição
    public function edit($id)
    {
        Auth::check();
        Auth::requireAdmin();

        $usuario = $this->model->find($id);
        require __DIR__ . '/../Views/usuarios/edit.php';
    }

    // Atualizar usuário
    public function update($id)
    {
        Auth::check();
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name'          => $_POST['name'] ?? '',
                'email'         => $_POST['email'] ?? '',
                'phone'         => $_POST['phone'] ?? null,
                'birth_date'    => $_POST['birth_date'] ?? null,
                'gender'        => $_POST['gender'] ?? null,
                'newsletter'    => isset($_POST['newsletter']) ? 1 : 0,
                'sms_marketing' => isset($_POST['sms_marketing']) ? 1 : 0,
                'active'        => isset($_POST['active']) ? 1 : 0,
                'role'          => $_POST['role'] ?? 'user'
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password']; // sem hash, o model cuida disso
            }

            $this->model->update($id, $data);

            $_SESSION['success'] = "Usuário atualizado com sucesso!";
            header("Location: /E-Coomerce-Painel/public/usuario/index");
            exit;
        }
    }

    // Excluir usuário
    public function delete($id)
    {
        Auth::check();
        Auth::requireAdmin();

        $this->model->delete($id);

        $_SESSION['success'] = "Usuário excluído com sucesso!";
        header("Location: /E-Coomerce-Painel/public/usuario");
        exit;
    }
}
