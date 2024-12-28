<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/HomeModel.php';

class HomeController
{
    private $homeModel;

    public function __construct()
    {
        $this->homeModel = new \App\Models\HomeModel();
    }

    public function getActiveMenusCount()
    {
        return $this->homeModel->getActiveMenusCount();
    }

    public function getInactiveMenusCount()
    {
        return $this->homeModel->getInactiveMenusCount();
    }

    public function getOrdersForVerificationCount()
    {
        return $this->homeModel->getOrdersForVerificationCount();
    }

    public function getConfirmedOrdersCount()
    {
        return $this->homeModel->getConfirmedOrdersCount();
    }
}
?>