<?php
namespace App\Core;

session_start();

class Controller {
    protected function render($view, $data = [], $layout = 'HomePage') {
        extract($data); // Giải nén biến dữ liệu
        ob_start();
        include __DIR__ . '/../View/views/' . $view . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../View/layouts/' . $layout . '.php';
    }

    protected function redirect($url) {
        header("Location: http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6" . $url);        
        exit();
    }
}
?>
