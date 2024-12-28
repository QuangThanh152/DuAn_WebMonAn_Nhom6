<?php
if (!isset($_SESSION['user'])) { 
    // Chuyển hướng đến trang đăng nhập 
    header('Location: http://localhost/php-Workspace/DuAn_WebMonAn_Nhom6/login'); 
    exit(); 
}
?>

<!-- Thông báo -->
<?php if (isset($notification) && !empty($notification)): ?>
<div id="notification" class="notification">
    <p><?php echo htmlspecialchars($notification, ENT_QUOTES, 'UTF-8'); ?></p>
</div>
<?php endif; ?>

<div class="cart-container">
    <div class="cart-items">
        <h2>Giỏ hàng của bạn</h2>
        <?php if (isset($cartItems) && count($cartItems) > 0): ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td>
                                <?php if (!empty($item['img_path'])): ?>
                                    <img src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/img/<?php echo htmlspecialchars($item['img_path'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                                <?php else: ?>
                                    <img src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/img/default.png" alt="No Image" width="50" height="50">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($item['category_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <form method="post" action="/php-Workspace/DuAn_WebMonAn_Nhom6/cart/update/<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <div class="quantity-container">
                                        <button type="button" onclick="updateQuantity(<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>, 'decrease')"><i class="fas fa-minus"></i></button>
                                        <input type="number" name="qty" id="quantity-<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>" value="<?php echo htmlspecialchars($item['qty'], ENT_QUOTES, 'UTF-8'); ?>" min="1">
                                        <button type="button" onclick="updateQuantity(<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>, 'increase')"><i class="fas fa-plus"></i></button>
                                        <button type="submit" class="icon-button"><i class="fas fa-save icon-update"></i></button>
                                    </div>
                                </form>
                            </td>
                            <td><?php echo htmlspecialchars($item['price'], ENT_QUOTES, 'UTF-8'); ?> $</td>
                            <td><?php echo htmlspecialchars($item['price'] * $item['qty'], ENT_QUOTES, 'UTF-8'); ?> $</td>
                            <td>
                                <form method="post" action="/php-Workspace/DuAn_WebMonAn_Nhom6/cart/remove/<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="icon-button"><i class="fas fa-trash icon-remove"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Giỏ hàng của bạn trống.</p>
        <?php endif; ?>
    </div>

    <div class="cart-checkout">
        <div>
            <h3>Tổng cộng:</h3>
            <?php $totalPrice = 0; ?>
            <?php foreach ($cartItems as $item): ?>
                <?php $totalPrice += $item['price'] * $item['qty']; ?>
                <p class="item-total"><?php echo htmlspecialchars($item['product_name'], ENT_QUOTES, 'UTF-8'); ?>: <?php echo htmlspecialchars($item['price'] * $item['qty'], ENT_QUOTES, 'UTF-8'); ?> $</p>
            <?php endforeach; ?>
            <div class="separator"></div>
        </div>
        <div class="totals">
            Tổng tiền: <?php echo htmlspecialchars($totalPrice, ENT_QUOTES, 'UTF-8'); ?> $
        </div>
        <form method="post" action="/php-Workspace/DuAn_WebMonAn_Nhom6/cart/checkout">
            <button type="submit">Thanh toán</button>
        </form>
    </div>
</div>

<!-- Thông báo thành công -->
<script>
function updateQuantity(id, action) {
    const quantityInput = document.getElementById('quantity-' + id);
    let currentQty = parseInt(quantityInput.value);
    if (action === 'increase') {
        quantityInput.value = currentQty + 1;
    } else if (action === 'decrease' && currentQty > 1) {
        quantityInput.value = currentQty - 1;
    }
}

document.addEventListener('DOMContentLoaded', (event) => {
    <?php if (isset($notification) && !empty($notification)): ?>
    // Hiển thị thông báo
    const notification = document.getElementById('notification');
    notification.classList.add('show');
    // Tự động ẩn thông báo sau 3 giây
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
    <?php endif; ?>
});
</script>

