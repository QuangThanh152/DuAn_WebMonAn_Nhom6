<?php
function view($view, $data = [])
{   
  $file = APPROOT . '/src/View/' . $view . '.php';
  
  if (is_readable($file)) {
    if (isset($data['products'])) {
      $products = $data['products'];
    } else if (isset($data['product'])) {
      $product = $data['product'];
    } else if (isset($data['categories'])) {
      $categories = $data['categories'];
    } else if (isset($data['category'])) {
      $category = $data['category'];
    } else {
      echo 'The key does not exist in the array.';
    }
    require_once $file;
  } else {
    die('<h1> 404 Page not found </h1>');
  }
}
function getCategoryName($categoryId) {
    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Thực hiện truy vấn để lấy tên thể loại
    $sql = "SELECT name FROM category_list WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $stmt->bind_result($categoryName);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    return $categoryName;
}


// Các hàm tiện ích khác
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect($url) {
    header("Location: $url");
    exit;
}

function format_price($price) {
    return number_format($price, 2, '.', ',') . ' VND';
}

function is_logged_in() {
    return isset($_SESSION['user']);
}
?>
