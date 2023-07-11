const navbar = document.querySelector("nav");
const themeToggle = document.querySelector(".theme-toggler");
const themeToggler = document.querySelector(".toggle");
const menu = document.querySelector(".nav-menu");
const moon = document.querySelector(".moon");
const sun = document.querySelector(".sun");
const bars = document.querySelector(".bars");
const menuLink = document.querySelectorAll(".menu-link");

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

const openMenu = () => {
  bars.classList.toggle("active_bars");
  menu.classList.toggle("active_menu");
};

window.addEventListener("scroll", () => {
  let scrollValue = window.scrollY;

  if (scrollValue > 69) {
    navbar.classList.add("blur");
  } else {
    navbar.classList.remove("blur");
  }
});

const sections = document.querySelectorAll("section");
const indicators = document.querySelectorAll(".indicator span");
const sectionIdsArr = [];
const sectionHeightsArr = [];

let sectionHeightValue = 0;
let currentSection = "home";

sections.forEach((section) => {
  sectionHeightValue += section.offsetHeight;
  sectionIdsArr.push(section.id);
  sectionHeightsArr.push(sectionHeightValue);
});

window.addEventListener("scroll", () => {
  let scrollValue = window.scrollY;

  for (let i = 0; i < sectionHeightsArr.length; i++) {
    if (scrollValue >= sectionHeightsArr[sectionHeightsArr.length - 1]) {
      currentSection = sectionIdsArr[sectionHeightsArr.length - 1];
      break;
    }

    if (scrollValue < sectionHeightsArr[i] - 10) {
      currentSection = sectionIdsArr[i];
      break;
    }
  }

  indicators.forEach((indicator) => {
    indicator.classList.remove("active_indicator");
    if (indicator.className === currentSection) {
      indicator.classList.add("active_indicator");
    }
  });
});
