<?php
namespace app\Models;

use PDO;

class Categoria
{
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function all()
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nome)
    {
        $sql = "INSERT INTO categories (nome, created_at, updated_at) VALUES (:nome, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['nome' => $nome]);
    }

    public function update($id, $nome)
    {
        $sql = "UPDATE categories SET nome = :nome, updated_at = NOW() WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['nome' => $nome, 'id' => $id]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
