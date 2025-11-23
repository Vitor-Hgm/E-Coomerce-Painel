<?php
namespace app\Models;

use PDO;

class Usuario
{
    private $conn;
    public function __construct($db) { $this->conn = $db; }

    public function all()
    {
        $sql = "SELECT id, name, email, phone, active, created_at FROM users ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "SELECT id, name, email, phone, active FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO users (name, email, password, phone, active, created_at, updated_at)
                VALUES (:name, :email, :password, :phone, :active, NOW(), NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'name'=>$data['name'],
            'email'=>$data['email'],
            'password'=>$data['password'], // já deve vir hashed
            'phone'=>$data['phone'],
            'active'=>$data['active'] ? 1 : 0
        ]);
    }

    public function update($id, $data)
    {
        // se senha for informada, atualiza; senão mantém
        if (!empty($data['password'])) {
            $sql = "UPDATE users SET name=:name, email=:email, password=:password, phone=:phone, active=:active, updated_at=NOW() WHERE id=:id";
            $params = ['name'=>$data['name'],'email'=>$data['email'],'password'=>$data['password'],'phone'=>$data['phone'],'active'=>$data['active'] ? 1 : 0,'id'=>$id];
        } else {
            $sql = "UPDATE users SET name=:name, email=:email, phone=:phone, active=:active, updated_at=NOW() WHERE id=:id";
            $params = ['name'=>$data['name'],'email'=>$data['email'],'phone'=>$data['phone'],'active'=>$data['active'] ? 1 : 0,'id'=>$id];
        }
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['id'=>$id]);
    }
}
