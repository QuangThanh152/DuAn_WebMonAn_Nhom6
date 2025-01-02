<?php
namespace App\Controllers;

require_once __DIR__ . '/../Models/MenuModel.php'; // Cập nhật đường dẫn

class MenuController
{
    private $menuModel;

    public function __construct()
    {
        $this->menuModel = new \App\Models\MenuModel();
    }

    public function index($limit = 5, $offset = 0)
    {
        $offset = max(0, $offset); // Đảm bảo offset không âm
        return $this->menuModel->getMenus($limit, $offset);
    }

    public function getCategories()
    {
        return $this->menuModel->getCategories();
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $image_path = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_name = basename($_FILES['image']['name']);
                $target_path = __DIR__ . '/../../assets/img/' . $image_name;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                    $image_path = $image_name;
                }
            }

            $data = [
                'name' => trim($_POST['name']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'category_id' => trim($_POST['category_id']),
                'status' => isset($_POST['status']) ? 1 : 0,
                'img_path' => $image_path
            ];

            if ($this->menuModel->addMenu($data)) {
                flash('menu_message', 'Menu added successfully');
                redirect('menus');
            } else {
                flash('menu_message', 'Something went wrong', 'alert alert-danger');
                redirect('menus/add');
            }
        }
    }

    public function edit($id)
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $image_path = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = basename($_FILES['image']['name']);
            $target_path = __DIR__ . '/../../assets/img/' . $image_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                $image_path = $image_name;
            }
        } else {
            // Lấy ảnh cũ từ cơ sở dữ liệu
            $currentMenu = $this->menuModel->getMenuById($id);
            $image_path = $currentMenu['img_path'];
        }

        $data = [
            'id' => $id,
            'name' => trim($_POST['name']),
            'description' => trim($_POST['description']),
            'price' => trim($_POST['price']),
            'category_id' => trim($_POST['category_id']),
            'status' => isset($_POST['status']) ? 1 : 0,
            'img_path' => $image_path
        ];

        if ($this->menuModel->updateMenu($data)) {
            flash('menu_message', 'Menu updated successfully');
            redirect('menus');
        } else {
            flash('menu_message', 'Something went wrong', 'alert alert-danger');
            redirect('menus/edit/' . $id);
        }
    }
}


    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->menuModel->deleteMenu($id)) {
                flash('menu_message', 'Menu removed successfully');
                redirect('menus');
            } else {
                flash('menu_message', 'Something went wrong', 'alert alert-danger');
                redirect('menus');
            }
        }
    }

    public function getTotalMenus()
    {
        return $this->menuModel->getTotalMenus();
    }
}
