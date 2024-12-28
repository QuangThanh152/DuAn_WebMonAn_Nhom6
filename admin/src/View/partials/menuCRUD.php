<?php
require_once __DIR__ . '/../../../config/credentials.php';
require_once __DIR__ . '/../../Controllers/MenuController.php';

$menuController = new \App\Controllers\MenuController();
$error = '';
$success = '';
$limit = 5; // Số lượng menu hiển thị trên mỗi trang
$page = isset($_GET['page']) && $_GET['page'] == 'menu' ? (isset($_GET['page_number']) ? intval($_GET['page_number']) : 1) : 1;
$offset = ($page - 1) * $limit;

// Xử lý các yêu cầu POST từ form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add') {
        if ($menuController->add()) {
            $success = 'Menu added successfully';
        } else {
            $error = 'Something went wrong';
        }
    } elseif (isset($_POST['action']) && $_POST['action'] == 'edit') {
        if ($menuController->edit($_POST['id'])) {
            $success = 'Menu updated successfully';
        } else {
            $error = 'Something went wrong';
        }
    } elseif (isset($_POST['delete_id'])) {
        if ($menuController->delete($_POST['delete_id'])) {
            $success = 'Menu removed successfully';
        } else {
            $error = 'Something went wrong';
        }
    }
}

// Lấy danh sách menu cho trang hiện tại
$menus = $menuController->index($limit, $offset);
$totalMenus = $menuController->getTotalMenus(); // Hàm này trả về tổng số menu
$totalPages = ceil($totalMenus / $limit);
?>

<div id="menuContent">
    <style>
        .menu-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            font-size: 0.9em;
            /* Kích thước nhỏ hơn */
        }

        .pagination a {
            color: #007bff;
            padding: 5px 10px;
            /* Giảm padding để kích thước nhỏ hơn */
            margin: 0 3px;
            /* Giảm margin để kích thước nhỏ hơn */
            border: 1px solid #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
    </style>
    <div class="content-container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        <!-- Form thêm/sửa menu -->
        <div class="menu-form">
            <h2 class="form-title">Menu Form</h2>
            <form id="menuForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST"
                enctype="multipart/form-data">
                <input type="hidden" id="menuId" name="id">
                <input type="hidden" id="menuAction" name="action" value="add">
                <!-- Các trường nhập liệu -->
                <div class="form-group">
                    <label for="menuName">Tên món ăn</label>
                    <input type="text" id="menuName" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="menuDescription">Mô tả</label>
                    <textarea id="menuDescription" name="description" class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center;">
                        Có sẵn
                        <label class="switch">
                            <input type="checkbox" id="menuStatus" name="status" checked>
                            <span class="slider"></span>
                        </label>
                    </label>
                </div>

                <div class="form-group">
                    <label for="category">Loại</label>
                    <select id="category" name="category_id" class="form-control">
                        <?php
                        // Lấy danh sách danh mục
                        $categories = $menuController->getCategories();
                        foreach ($categories as $category) {
                            echo "<option value='" . $category['id'] . "'>" . htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Giá</label>
                    <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="image">Ảnh</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*"
                        onchange="previewImage(event)">
                    <img id="preview" src="" alt="Preview" style="display: none; max-height: 200px; margin-top: 10px;">
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" onclick="clearForm()">Cancel</button>
                </div>
            </form>
        </div>

        <!-- Bảng danh sách menu -->
        <div class="menu-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ảnh</th>
                        <th>Thông tin</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <!-- Trong file partials/menuCRUD.php -->

                <tbody>
                    <?php
                    if (!empty($menus)) {
                        $display_number = ($page - 1) * $limit + 1; // Tính số thứ tự bắt đầu dựa vào trang hiện tại
                        foreach ($menus as $menu) {
                            $image_path = isset($menu["img_path"]) ? "/php-Workspace/DuAn_WebMonAn_Nhom6/admin/assets/img/" . basename($menu["img_path"]) : "https://via.placeholder.com/80";
                            echo "<tr>";
                            // Thay đổi từ $menu["id"] thành $display_number
                            echo "<td>" . $display_number . "</td>";
                            echo "<td><img src='" . htmlspecialchars($image_path, ENT_QUOTES, 'UTF-8') . "' alt='" . htmlspecialchars($menu["name"], ENT_QUOTES, 'UTF-8') . "' class='menu-image'></td>";
                            echo "<td>
                    <strong>Name: </strong>" . htmlspecialchars($menu["name"], ENT_QUOTES, 'UTF-8') . "<br>
                    <strong>Category: </strong>" . htmlspecialchars($menu["category_id"], ENT_QUOTES, 'UTF-8') . "<br>
                    <strong>Description: </strong>" . htmlspecialchars($menu["description"], ENT_QUOTES, 'UTF-8') . "<br>
                    <strong>Price: </strong>$" . number_format($menu["price"], 2) . "
                  </td>";
                            echo "<td>
                    <div class='action-buttons'>
                        <button class='btn btn-primary' onclick='editMenu(" . json_encode($menu) . ")'>Edit</button>
                        <form action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "' method='POST' style='display:inline-block;'>
                            <input type='hidden' name='delete_id' value='" . $menu["id"] . "'>
                            <button type='submit' class='btn btn-danger'>Delete</button>
                        </form>
                    </div>
                  </td>";
                            echo "</tr>";
                            $display_number++; // Tăng số thứ tự
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($page > 1): ?>
                        <a href="?page=menu&page_number=<?php echo $page - 1; ?>">&laquo;</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=menu&page_number=<?php echo $i; ?>"
                            class="<?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=menu&page_number=<?php echo $page + 1; ?>">&raquo;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Hàm xem trước hình ảnh khi người dùng chọn tệp hình ảnh
    function previewImage(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block';
    }

    // Hàm chỉnh sửa menu, hiển thị dữ liệu đã chọn vào form
    function editMenu(menu) {
        document.getElementById('menuId').value = menu.id;
        document.getElementById('menuAction').value = 'edit';
        document.getElementById('menuName').value = menu.name;
        document.getElementById('menuDescription').value = menu.description;
        document.getElementById('menuStatus').checked = menu.status == 1;
        document.getElementById('category').value = menu.category_id;
        document.getElementById('price').value = menu.price;

        // Hiển thị hình ảnh đã chọn trước đó
        if (menu.img_path) {
            var preview = document.getElementById('preview');
            preview.src = "/php-Workspace/DuAn_WebMonAn_Nhom6/admin/assets/img/" + menu.img_path;
            preview.style.display = 'block';
        }
    }

    // Hàm xóa form, đặt lại các giá trị và ẩn hình ảnh xem trước
    function clearForm() {
        document.getElementById('menuForm').reset();
        document.getElementById('menuId').value = '';
        document.getElementById('menuAction').value = 'add';
        var preview = document.getElementById('preview');
        preview.src = '';
        preview.style.display = 'none';
    }
</script>