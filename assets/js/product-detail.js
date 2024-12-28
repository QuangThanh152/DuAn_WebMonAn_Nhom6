document.addEventListener("DOMContentLoaded", () => {
  const quantityInput = document.getElementById("quantity");
  const increaseButton = document.getElementById("increase");
  const decreaseButton = document.getElementById("decrease");

  increaseButton.addEventListener("click", () => {
    quantityInput.value = parseInt(quantityInput.value) + 1;
  });

  decreaseButton.addEventListener("click", () => {
    if (quantityInput.value > 1) {
      quantityInput.value = parseInt(quantityInput.value) - 1;
    }
  });
  document.getElementById("add-to-cart").addEventListener("click", function () {
    var productId = document
      .querySelector(".product-detail")
      .getAttribute("data-product-id");
    var qty = quantityInput.value;

    var xhr = new XMLHttpRequest();
    xhr.open(
      "GET",
      "/php-Workspace/DuAn_WebMonAn_Nhom6/cart/add/" + productId + "/" + qty,
      true
    );
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        window.location.href = "/php-Workspace/DuAn_WebMonAn_Nhom6/cart";
      } else if (xhr.readyState == 4) {
        alert(
          "Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng. Vui lòng thử lại."
        );
      }
    };
    xhr.send();
  });
});
