const menu = document.getElementById("menu");
const menuList = document.getElementById("menu-list");

// Fungsi untuk menutup menu
const closeMenu = () => {
  menuList.classList.add("hidden");
};

// Event listener untuk membuka menu
menu.addEventListener("click", () => {
  menuList.classList.toggle("hidden");
});

// Event listener untuk menutup menu saat mengklik di luar menu
document.addEventListener("click", (event) => {
  const isClickInsideMenu = menu.contains(event.target);
  const isMenuVisible = !menuList.classList.contains("hidden");

  if (!isClickInsideMenu && isMenuVisible) {
    closeMenu();
  }
});

// Optional: Event listener untuk menutup menu saat menekan tombol escape
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape" && !menuList.classList.contains("hidden")) {
    closeMenu();
  }
});
