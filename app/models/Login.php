<?php
namespace App\Models;

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
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica a senha criptografada
        if (password_verify($senha, $usuario['password'])) {
            return $usuario;
        }
    }

    return false;
}


}
