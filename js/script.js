const body = document.querySelector("body");
const menu = document.querySelector(".nav-menu");

// -- this code changes the site theme when toggle button is clicked.

const themeToggle = document.querySelector(".theme-toggle");
let savedTheme = localStorage.getItem("theme");

const themeChange = () => {
  if (themeToggle.innerHTML.indexOf("on") > -1) {
    themeToggle.innerHTML = `<i class="las la-toggle-off"></i>`;
    body.classList.add("light");

    // -- This code saves the user's preferred theme to local storage.
    localStorage.setItem("theme", "light");
  } else {
    themeToggle.innerHTML = `<i class="las la-toggle-on"></i>`;
    body.classList.remove("light");

    // -- This code saves the user's preferred theme to local storage.
    localStorage.setItem("theme", "dark");
  }
};

if (savedTheme === "light") {
  setTimeout(themeChange, 500);
}

themeToggle.addEventListener("click", () => {
  setTimeout(themeChange, 500);
});

// -- This code open the menu when bars are clicked.

const menuToggle = document.querySelector(".bars");
const menuLink = document.querySelectorAll(".menu-link");
const navMenu = document.querySelector(".nav-menu");

const collapseMenu = () => {
  navMenu.classList.toggle("menu-active");
  body.classList.toggle("remove-scrollbar");
};

menuLink.forEach((e) => {
  e.addEventListener("click", () => {
    setTimeout(collapseMenu, 500);
  });
});

menuToggle.addEventListener("click", () => {
  setTimeout(collapseMenu, 500);
});

// This code indicates current viewport window.

const sections = document.querySelectorAll("section");
const indicators = document.querySelectorAll(".indicator a");
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
