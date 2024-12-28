<?php

// Kiểm tra và định nghĩa BASE_URL nếu chưa được định nghĩa
if (!defined('BASE_URL')) {
  define('BASE_URL', 'http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/admin');
}

/**
 * Chuyển hướng tới một trang cụ thể
 *
 * @param string $page
 */
if (!function_exists('redirect')) {
  function redirect($page)
  {
    header('Location: ' . BASE_URL . '/' . $page);
    exit();
  }
}

/**
 * Hiển thị một thông báo flash
 *
 * @param string $name
 * @param string $message
 * @param string $class
 */
if (!function_exists('flash')) {
  function flash($name = '', $message = '', $class = 'alert alert-success')
  {
    if (!empty($name)) {
      if (!empty($message) && empty($_SESSION[$name])) {
        if (!empty($_SESSION[$name . '_class'])) {
          unset($_SESSION[$name . '_class']);
        }
        if (!empty($_SESSION[$name])) {
          unset($_SESSION[$name]);
        }
        $_SESSION[$name] = $message;
        $_SESSION[$name . '_class'] = $class;
      } elseif (empty($message) && !empty($_SESSION[$name])) {
        $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
        echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
        unset($_SESSION[$name]);
        unset($_SESSION[$name . '_class']);
      }
    }
  }
}

/**
 * Kiểm tra nếu người dùng đã đăng nhập
 *
 * @return bool
 */
if (!function_exists('isLoggedIn')) {
  function isLoggedIn()
  {
    return isset($_SESSION['user_id']);
  }
}

// xử lý hiệu ứng thông báo ở trang admin
function flash($message = '', $type = 'toast toast-success') {
  if (!empty($message)) {
      $_SESSION['flash_message'] = $message;
      $_SESSION['flash_type'] = $type;
  }
}
?>