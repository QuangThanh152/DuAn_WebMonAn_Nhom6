document.addEventListener("DOMContentLoaded", () => {
  const menuGrid = document.getElementById("menuGrid");
  const prevPageButton = document.getElementById("prevPage");
  const nextPageButton = document.getElementById("nextPage");

  const itemsPerPage = 4; // Số lượng món ăn trên mỗi trang
  let currentPage = 1;

  function renderMenu(items, page) {
    menuGrid.innerHTML = ""; // Xóa nội dung hiện tại
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const paginatedItems = items.slice(startIndex, endIndex);

    paginatedItems.forEach((item) => {
      const itemElement = document.createElement("div");
      itemElement.className = "menu-item";
      itemElement.innerHTML = `
                <h3>${item.name}</h3>
                <p>Price: $${item.price.toFixed(2)}</p>
            `;
      menuGrid.appendChild(itemElement);
    });
  }

  function updatePaginationButtons(items, page) {
    prevPageButton.disabled = page === 1;
    nextPageButton.disabled = page * itemsPerPage >= items.length;

    const paginationButtons = document.querySelectorAll(".pagination-button");
    paginationButtons.forEach((button) => button.classList.remove("active"));
    paginationButtons[page].classList.add("active");
  }

  prevPageButton.addEventListener("click", () => {
    if (currentPage > 1) {
      currentPage--;
      renderMenu(menuItems, currentPage);
      updatePaginationButtons(menuItems, currentPage);
    }
  });

  nextPageButton.addEventListener("click", () => {
    if (currentPage * itemsPerPage < menuItems.length) {
      currentPage++;
      renderMenu(menuItems, currentPage);
      updatePaginationButtons(menuItems, currentPage);
    }
  });

  renderMenu(menuItems, currentPage);
  updatePaginationButtons(menuItems, currentPage);
});
