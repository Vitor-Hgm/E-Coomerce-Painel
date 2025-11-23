<?php
namespace app\Models;

use PDO;

class Login 
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
public function autenticar($email, $senha)
{
    // Buscar usuário pelo e-mail
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        return false; // email não encontrado
    }

    
    // 🔐 Verifica a senha criptografada
    if (password_verify($senha, $usuario['password'])) {
        return $usuario; // OK, senha válida
    }

    return false; // Senha incorreta
}


}
