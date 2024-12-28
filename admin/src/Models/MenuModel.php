<?php
namespace App\Models;

class MenuModel
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=localhost;dbname=fos_db', 'root', '');
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getMenus($limit, $offset)
    {
        $stmt = $this->db->prepare('SELECT * FROM product_list LIMIT :limit OFFSET :offset');
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCategories()
    {
        $stmt = $this->db->query('SELECT * FROM category_list');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addMenu($data)
    {
        $stmt = $this->db->prepare('INSERT INTO product_list (name, description, price, category_id, status, img_path) VALUES (:name, :description, :price, :category_id, :status, :img_path)');
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':img_path', $data['img_path']);

        return $stmt->execute();
    }

    public function updateMenu($data)
    {
        $stmt = $this->db->prepare('UPDATE product_list SET name = :name, description = :description, price = :price, category_id = :category_id, status = :status, img_path = :img_path WHERE id = :id');
        $stmt->bindParam(':id', $data['id']);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':img_path', $data['img_path']);

        return $stmt->execute();
    }

    public function deleteMenu($id)
    {
        $stmt = $this->db->prepare('DELETE FROM product_list WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getTotalMenus()
    {
        $stmt = $this->db->query('SELECT COUNT(*) as total FROM product_list');
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
