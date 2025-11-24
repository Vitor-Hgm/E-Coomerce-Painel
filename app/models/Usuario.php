<?php

namespace app\Models;

use PDO;

class Usuario
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Lista todos os usuários
    public function all()
    {
        $sql = "SELECT id, name, email, phone, gender, newsletter, sms_marketing, active, role, created_at
                FROM users 
                ORDER BY id DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca um usuário pelo ID
    public function find($id)
    {
        $sql = "SELECT 
                    id, name, email, phone, birth_date, gender,
                    newsletter, sms_marketing, active, role
                FROM users 
                WHERE id = :id 
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria usuário
    public function create($data)
    {
        $sql = "INSERT INTO users 
                (name, email, password, phone, birth_date, gender, newsletter, sms_marketing, active, role, created_at, updated_at)
                VALUES
                (:name, :email, :password, :phone, :birth_date, :gender, :newsletter, :sms_marketing, :active, :role, NOW(), NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => password_hash($data['password'], PASSWORD_BCRYPT), // ✔ CORRIGIDO
            'phone'         => $data['phone'] ?? null,
            'birth_date'    => $data['birth_date'] ?? null,
            'gender'        => $data['gender'] ?? null,
            'newsletter'    => !empty($data['newsletter']) ? 1 : 0,
            'sms_marketing' => !empty($data['sms_marketing']) ? 1 : 0,
            'active'        => !empty($data['active']) ? 1 : 0,
            'role'          => $data['role'] ?? 'user'
        ]);
    }

    public function findByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar usuário
    public function update($id, $data)
    {
        $data['birth_date']    = $data['birth_date'] ?? null;
        $data['gender']        = $data['gender'] ?? null;
        $data['newsletter']    = !empty($data['newsletter']) ? 1 : 0;
        $data['sms_marketing'] = !empty($data['sms_marketing']) ? 1 : 0;
        $data['active']        = !empty($data['active']) ? 1 : 0;
        $data['role']          = $data['role'] ?? 'user';

        $fields = "
            name = :name,
            email = :email,
            phone = :phone,
            birth_date = :birth_date,
            gender = :gender,
            newsletter = :newsletter,
            sms_marketing = :sms_marketing,
            active = :active,
            role = :role,
            updated_at = NOW()";

        if (!empty($data['password'])) {
            $fields .= ", password = :password";
        }

        $sql = "UPDATE users SET $fields WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        $params = [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'birth_date'    => $data['birth_date'],
            'gender'        => $data['gender'],
            'newsletter'    => $data['newsletter'],
            'sms_marketing' => $data['sms_marketing'],
            'active'        => $data['active'],
            'role'          => $data['role'],
            'id'            => $id
        ];

        if (!empty($data['password'])) {
            $params['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        return $stmt->execute($params);
    }

    // Deletar usuário
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(['id' => $id]);
    }
}
