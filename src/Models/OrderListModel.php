<?php
namespace App\Models;

class OrderListModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function addOrderItem($order_id, $product_id, $qty) {
        $stmt = $this->db->prepare("INSERT INTO order_list (order_id, product_id, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $order_id, $product_id, $qty);
        return $stmt->execute();
    }

    public function getOrderItems($order_id) {
        $stmt = $this->db->prepare("SELECT * FROM order_list WHERE order_id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteOrderItem($id) {
        $stmt = $this->db->prepare("DELETE FROM order_list WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
