<?php
namespace app\Models;

use PDO;

class Categoria
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        // Gera slug automático se não tiver
        if (empty($data['slug'])) {
            $data['slug'] = $this->gerarSlug($data['name']);
        }

        // Garante que o slug seja único
        $data['slug'] = $this->gerarSlugUnico($data['slug']);

        $stmt = $this->db->prepare("INSERT INTO categories (name, slug, active) VALUES (:name, :slug, :active)");
        $stmt->execute([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'active' => $data['active'] ?? 1
        ]);
    }

    public function update($id, $data)
    {
        // Gera slug automático se não tiver
        if (empty($data['slug'])) {
            $data['slug'] = $this->gerarSlug($data['name']);
        }

        // Garante que o slug seja único, ignorando o próprio ID
        $data['slug'] = $this->gerarSlugUnico($data['slug'], $id);

        $stmt = $this->db->prepare("UPDATE categories SET name = :name, slug = :slug, active = :active WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'active' => $data['active'] ?? 1
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->execute([$id]);
    }

    private function gerarSlug($string)
    {
        $slug = strtolower(trim($string));
        $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        return $slug;
    }

    // Função para garantir slug único
    private function gerarSlugUnico($slug, $ignoreId = null)
    {
        $baseSlug = $slug;
        $i = 1;

        while (true) {
            if ($ignoreId) {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM categories WHERE slug = ? AND id != ?");
                $stmt->execute([$slug, $ignoreId]);
            } else {
                $stmt = $this->db->prepare("SELECT COUNT(*) FROM categories WHERE slug = ?");
                $stmt->execute([$slug]);
            }

            $count = $stmt->fetchColumn();

            if ($count == 0) {
                break;
            }

            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
