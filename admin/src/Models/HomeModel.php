<?php
namespace App\Models;

class HomeModel
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

    public function getActiveMenusCount()
    {
        $stmt = $this->db->query('SELECT COUNT(*) as count FROM product_list WHERE status = 1');
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }

    public function getInactiveMenusCount()
    {
        $stmt = $this->db->query('SELECT COUNT(*) as count FROM product_list WHERE status = 0');
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }

    public function getOrdersForVerificationCount()
    {
        $stmt = $this->db->query('SELECT COUNT(*) as count FROM orders WHERE status = 0');
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }

    public function getConfirmedOrdersCount()
    {
        $stmt = $this->db->query('SELECT COUNT(*) as count FROM orders WHERE status = 1');
        return $stmt->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}
?>