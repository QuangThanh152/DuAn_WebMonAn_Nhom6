<?php
namespace App\Models;

class OrderModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function addOrder($name, $address, $mobile, $email, $status) {
        if (is_null($address)) {
            $address = 'Không có địa chỉ';
        }
        if (is_null($mobile)) {
            $mobile = 'Không có số điện thoại';
        }
        if (is_null($email)) {
            $email = 'no-email@example.com';
        }

        $stmt = $this->db->prepare("INSERT INTO orders (name, address, mobile, email, status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $name, $address, $mobile, $email, $status);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function updateOrderStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("ii", $status, $id);
        return $stmt->execute();
    }

    public function getOrders() {
        $stmt = $this->db->prepare("SELECT * FROM orders");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteOrder($id) {
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
