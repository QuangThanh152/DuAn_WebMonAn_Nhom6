<?php
namespace App\Models;

class ProductModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function addProduct($category_id, $name, $description, $price, $img_path, $status) {
        $stmt = $this->db->prepare("INSERT INTO product_list (category_id, name, description, price, img_path, status) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$category_id, $name, $description, $price, $img_path, $status]);
    }

    public function getProducts() {
        $result = $this->db->query("SELECT * FROM product_list");
        
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        
        return $products;
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM product_list WHERE id = ?");
        $stmt->bind_param("i", $id); // Bind tham số
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateProduct($id, $category_id, $name, $description, $price, $img_path, $status) {
        $stmt = $this->db->prepare("UPDATE product_list SET category_id = ?, name = ?, description = ?, price = ?, img_path = ?, status = ? WHERE id = ?");
        return $stmt->execute([$category_id, $name, $description, $price, $img_path, $status, $id]);
    }

    public function deleteProduct($id) {
        return $this->db->query("DELETE FROM product_list WHERE id = $id");
    }
}
?>
