<?php
namespace App\Models;

class CartModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getCartItems($user_id) {
        $query = "SELECT cart.id, cart.product_id, cart.qty, product_list.name AS product_name, category_list.name AS category_name, product_list.price, product_list.img_path 
                  FROM cart 
                  JOIN product_list ON cart.product_id = product_list.id 
                  JOIN category_list ON product_list.category_id = category_list.id 
                  WHERE cart.user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $cartItems = [];
        while ($row = $result->fetch_assoc()) {
            $cartItems[] = $row;
        }
        
        return $cartItems;
    }

    public function getCartItemByUserIdAndProductId($user_id, $product_id) {
        $query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function addCartItem($user_id, $product_id, $qty) {
        $stmt = $this->db->prepare("INSERT INTO cart (user_id, product_id, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $user_id, $product_id, $qty);
        return $stmt->execute();
    }

    public function updateCartItemQty($id, $qty) {
        $stmt = $this->db->prepare("UPDATE cart SET qty = ? WHERE id = ?");
        $stmt->bind_param("ii", $qty, $id);
        return $stmt->execute();
    }

    public function deleteCartItem($id) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }
}
?>
