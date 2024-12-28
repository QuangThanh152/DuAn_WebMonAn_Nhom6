
<div class="product-detail" data-product-id="<?php echo $product['id']; ?>">
    <img src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/img/<?php echo htmlspecialchars($product['img_path'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="product-detail-info">
        <h1><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="product-label">Loại:</p>
        <p><?php echo htmlspecialchars($product['category_id'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="product-label">Mô tả:</p>
        <p><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="product-label">Giá:</p>
        <p><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> $</p>
        <p class="product-label">Tình trạng:</p>
        <p><?php echo $product['status'] == 1 ? 'Available' : 'Unavailable'; ?></p>
        <div class="quantity">
            <button id="decrease"><i class="fas fa-minus"></i></button>
            <input type="number" id="quantity" value="1" min="1">
            <button id="increase"><i class="fas fa-plus"></i></button>
        </div>
        <button id="add-to-cart">Thêm vào giỏ hàng</button>
    </div>
</div>
<script src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/js/product-detail.js"></script>

