document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.querySelector(".wrapper");
  const loginLink = document.querySelector(".login-link");
  const registerLink = document.querySelector(".register-link");
  const btnLoginPopup = document.querySelectorAll(".btnlogin-popup")[0]; // Nút Login
  const btnRegisterPopup = document.querySelectorAll(".btnlogin-popup")[1]; // Nút Register (phần navigation)
  const iconClose = document.querySelector(".icon-closed");

  // Khi click vào link Register trong form Login
  if (registerLink) {
    registerLink.addEventListener("click", () => {
      if (wrapper) {
        wrapper.classList.add("active");
      }
    });
  }

  // Khi click vào link Login trong form Register
  if (loginLink) {
    loginLink.addEventListener("click", () => {
      if (wrapper) {
        wrapper.classList.remove("active");
      }
    });
  }

  // Khi click vào nút Login
  if (btnLoginPopup) {
    btnLoginPopup.addEventListener("click", () => {
      if (wrapper) {
        wrapper.classList.add("active-popup");
        wrapper.classList.remove("active"); // Hiện Login trước
      }
    });
  }

  // Khi click vào nút Register
  if (btnRegisterPopup) {
    btnRegisterPopup.addEventListener("click", () => {
      if (wrapper) {
        wrapper.classList.add("active-popup");
        wrapper.classList.add("active"); // Hiện Register trực tiếp
      }
    });
  }

  // Khi click vào icon đóng (nếu có)
  if (iconClose) {
    iconClose.addEventListener("click", () => {
      if (wrapper) {
        wrapper.classList.remove("active-popup");
        wrapper.classList.remove("active");
      }
    });
  }
});
document.addEventListener("DOMContentLoaded", (event) => {
  const loginLink = document.querySelectorAll(".login-link");
  const registerLink = document.querySelectorAll(".register-link");
  const wrapper = document.querySelector(".wrapper");
  const btnLoginPopup = document.querySelector(".btnlogin-popup");

  registerLink.forEach((link) => {
    link.addEventListener("click", () => {
      wrapper.classList.add("active");
    });
  });

  loginLink.forEach((link) => {
    link.addEventListener("click", () => {
      wrapper.classList.remove("active");
    });
  });

  btnLoginPopup.addEventListener("click", () => {
    wrapper.classList.remove("active");
  });

  const btnRegisterPopup = document.querySelector(".btnregister-popup");
  btnRegisterPopup.addEventListener("click", () => {
    wrapper.classList.add("active");
  });
});

