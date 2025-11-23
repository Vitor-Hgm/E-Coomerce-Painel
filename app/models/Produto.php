<?php

namespace app\Models;

use PDO;

class Produto
{
    private $conn;
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function all()
    {
        $sql = "
        SELECT p.*, c.name AS category_name
        FROM products p
        LEFT JOIN categories c ON c.id = p.category_id
        ORDER BY p.created_at DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function find($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO products (nome, descricao, preco, categoria_id, created_at, updated_at)
                VALUES (:nome, :descricao, :preco, :categoria_id, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'categoria_id' => $data['categoria_id'] ?: null
        ]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE products SET nome=:nome, descricao=:descricao, preco=:preco, categoria_id=:categoria_id, updated_at=NOW() WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'],
            'preco' => $data['preco'],
            'categoria_id' => $data['categoria_id'] ?: null,
            'id' => $id
        ]);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
