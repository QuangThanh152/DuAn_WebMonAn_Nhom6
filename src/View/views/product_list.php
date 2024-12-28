<link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/product_list.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script>
    function toggleHeartIcon(element) {
        if (element.classList.contains('far')) {
            element.classList.remove('far');
            element.classList.add('fas', 'active');
        } else {
            element.classList.remove('fas', 'active');
            element.classList.add('far');
        }
    }

    function redirectToProductDetail(productId) {
        window.location.href = `/php-Workspace/DuAn_WebMonAn_Nhom6/product/${productId}`;
    }
</script>

<div id="product-list" class="product-grid-container">
    <h2>Danh sách sản phẩm</h2>
    <?php if (isset($products) && count($products) > 0): ?>
        <div class="product-grid">
            <?php foreach ($products as $product): ?>
                <div class="card">
                    <img src="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/img/<?php echo htmlspecialchars($product['img_path'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <i class="far fa-heart heart-icon" onclick="toggleHeartIcon(this)"></i>
                    <div class="card-content">
                        <h3 class="card-title"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="card-category">
                            <?php 
                            // Lấy tên thể loại món ăn từ category_id
                            $categoryId = htmlspecialchars($product['category_id'], ENT_QUOTES, 'UTF-8');
                            $categoryName = getCategoryName($categoryId);
                            echo $categoryName;
                            ?>
                        </p>
                        <p class="card-price">
                            <span>Rs <?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> $</span>
                            <button onclick="redirectToProductDetail(<?php echo $product['id']; ?>)">+</button>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No products available.</p>
    <?php endif; ?>
</div>
