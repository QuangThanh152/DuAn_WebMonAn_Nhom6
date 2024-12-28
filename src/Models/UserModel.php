<?php
namespace App\Models;

class UserModel {
    private $db;

    public function __construct($conn) {
        $this->db = $conn;
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("
            SELECT 
                * 
            FROM 
                users 
            WHERE 
                username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Kiểm tra nếu người dùng không tồn tại
        if ($result->num_rows === 0) {
            return false;
        }

        return $result->fetch_assoc();
    }

    public function getUsers() {
        return $this->db->query("SELECT * FROM users")->fetch_all(MYSQLI_ASSOC);
    }

    public function addUser($name, $username, $password, $type) {
        $stmt = $this->db->prepare("INSERT INTO users (name, username, password, type) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $username, $password, $type);
        return $stmt->execute();
    }

    public function createUser($username, $password, $firstName, $lastName, $email, $phone, $address, $type = 2) {
        $this->db->begin_transaction();
        try {
            // Thêm người dùng vào bảng `users`
            $stmt = $this->db->prepare("INSERT INTO users (username, password, type) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $username, $password, $type);
            $stmt->execute();
            $userId = $this->db->insert_id;

            // Thêm thông tin chi tiết vào bảng `user_info`
            $stmt = $this->db->prepare("INSERT INTO user_info (user_id, first_name, last_name, email, mobile, address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $userId, $firstName, $lastName, $email, $phone, $address);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (\Exception $e) {
            $this->db->rollback();
            return false;
        }
    }
}
?>
