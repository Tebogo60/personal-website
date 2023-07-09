const navbar = document.querySelector("nav");
const themeToggle = document.querySelector(".theme-toggler");
const themeToggler = document.querySelector(".toggle");
const menu = document.querySelector(".nav-menu");
const moon = document.querySelector(".moon");
const sun = document.querySelector(".sun");
const bars = document.querySelector(".bars");
const menuLink = document.querySelectorAll(".menu-link");
const section = document.querySelectorAll("section");

let lightActive = false;
let menuActive = false;

const changeTheme = () => {
  sun.classList.toggle("active_theme");
  moon.classList.toggle("active_theme");
  themeToggler.classList.toggle("active_sun");
  themeToggler.classList.toggle("active_moon");

  if (lightActive === true) {
    lightActive = true;
  } else {
    lightActive = false;
  }
};

const openMenu = () => {
  bars.classList.toggle("active_bars");
  menu.classList.toggle("active_menu");
};

window.addEventListener("scroll", () => {
  const scrollValue = window.scrollY;

  if (scrollValue > 69) {
    navbar.classList.add("blur");
  } else {
    navbar.classList.remove("blur");
  }
});

themeToggle.addEventListener("click", () => {
  changeTheme();
});

menuLink.forEach((e) => {
  e.addEventListener("click", () => {
    openMenu();
  });
});

bars.addEventListener("click", () => {
  openMenu();
});
