const body = document.querySelector("body");
const navMenu = document.querySelector(".nav-menu");
const bars = document.querySelector(".bars");
const light = document.querySelector(".theme-toggle .light");
const dark = document.querySelector(".theme-toggle .dark");

bars.addEventListener("click", () => {
  openMenu();
});

light.addEventListener("click", () => {
  changeMode();
});

dark.addEventListener("click", () => {
  changeMode();
});

const openMenu = () => {
  navMenu.classList.toggle("menu-active");
  bars.classList.toggle("bars-active");
};

const changeMode = () => {
  body.classList.toggle("light-active");
  light.classList.toggle("theme-active");
  dark.classList.toggle("theme-active");
};
