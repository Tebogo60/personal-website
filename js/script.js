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

const openMenu = () => {
  navMenu.classList.toggle("menu-active");
  bars.classList.toggle("bars-active");
};

dark.addEventListener("click", () => {
  changeMode();
});

const changeMode = () => {
  body.classList.toggle("light-active");
  light.classList.toggle("theme-active");
  dark.classList.toggle("theme-active");
};

const homeHeader = document.querySelector(".home .header-large");
const homeHeaderContent = "Full-Stack Web";

const homeSubHeader = document.querySelector(".home .header-med");
const homeSubHeaderContent = "Developer";

const homeMedia = document.querySelector(".home .media");

let headerIndex = -1;
let subHeaderIndex = 0;
const headerTyping = () => {
  if (headerIndex < homeHeaderContent.length) {
    if (headerIndex === -1) {
      headerIndex++;
    }
    homeHeader.innerHTML += homeHeaderContent[headerIndex];
    headerIndex++;
  }

  if (
    headerIndex >= homeHeaderContent.length &&
    subHeaderIndex < homeSubHeaderContent.length
  ) {
    homeSubHeader.innerHTML += homeSubHeaderContent[subHeaderIndex];
    subHeaderIndex++;
  }

  setTimeout(headerTyping, 100);
};

headerTyping();
