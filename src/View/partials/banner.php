<link rel="stylesheet" href="/php-Workspace/DuAn_WebMonAn_Nhom6/assets/css/banner.css">
<script>
  function scrollToMenu() {
    const menuSection = document.getElementById('product-list');
    if (menuSection) {
      menuSection.scrollIntoView({
        behavior: 'smooth'
      });
    }
  }
</script>
<section class="banner" id="home">
  <div class="banner-overlay">
    <h1 class="banner-title">Chào mừng bạn đến với Nhóm6 Website HoLo Restaurant</h1>
    <button class="order-button" onclick="scrollToMenu()">Đặt hàng ngay</button>
  </div>
</section>