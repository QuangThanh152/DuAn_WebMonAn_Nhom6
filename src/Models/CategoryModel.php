<?php
namespace App\Models;
class CategoryModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function addCategory($name) {
        return $this->db->query("INSERT INTO category_list (name) VALUES ('$name')");
    }

    public function getCategories() {
        return $this->db->query("SELECT * FROM category_list")->fetchAll();
    }

    public function updateCategory($id, $name) {
        return $this->db->query("UPDATE category_list SET name = '$name' WHERE id = $id");
    }

    public function deleteCategory($id) {
        return $this->db->query("DELETE FROM category_list WHERE id = $id");
    }
}
?>
