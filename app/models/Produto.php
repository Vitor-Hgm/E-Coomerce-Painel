<?php
namespace app\Models;

use PDO;

class Produto
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query(
            "SELECT p.*, c.name AS category_name 
             FROM products p 
             LEFT JOIN categories c ON p.category_id = c.id 
             ORDER BY p.id DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Gera slug automático se não tiver
        if (empty($data['slug'])) {
            $data['slug'] = $this->gerarSlug($data['name']);
        }

        $stmt = $this->db->prepare(
            "INSERT INTO products 
             (category_id, name, slug, description, price, stock_quantity, featured, active, image)
             VALUES 
             (:category_id, :name, :slug, :description, :price, :stock_quantity, :featured, :active, :image)"
        );
        $stmt->execute([
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'featured' => $data['featured'] ?? 0,
            'active' => $data['active'] ?? 1,
            'image' => $data['image'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = $this->gerarSlug($data['name']);
        }

        $stmt = $this->db->prepare(
            "UPDATE products SET 
            category_id = :category_id,
            name = :name,
            slug = :slug,
            description = :description,
            price = :price,
            stock_quantity = :stock_quantity,
            featured = :featured,
            active = :active,
            image = :image
            WHERE id = :id"
        );
        $stmt->execute([
            'id' => $id,
            'category_id' => $data['category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock_quantity' => $data['stock_quantity'],
            'featured' => $data['featured'] ?? 0,
            'active' => $data['active'] ?? 1,
            'image' => $data['image'] ?? null
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
    }

    private function gerarSlug($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return $slug;
    }
}
