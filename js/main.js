const sectionArr = [
  "home",
  "about me",
  "experience",
  "project",
  "get in touch",
];

for (let i = 0; i < main.children.length; i++) {
  indicatorSections.innerHTML += `<span class="" id="${i}" style="top: ${
    (i / 5) * 100
  }%">${sectionArr[i]}</span>`;
}

window.addEventListener("scroll", () => {
  const scrollY = window.scrollY;

  if (scrollY > 200) {
    returnBtn.classList.remove("opacity-0");
    returnBtn.classList.add("opacity-100");
  } else {
    returnBtn.classList.remove("opacity-100");
    returnBtn.classList.add("opacity-0");
  }

  indicator.style.top = `${
    (scrollY / (body.offsetHeight + footer.offsetHeight)) * 100
  }%`;

  let currentSectionIndex = Math.floor(
    (scrollY / (body.offsetHeight + footer.offsetHeight)) * 5
  );

  let lastSectionId = "";
  let currentSectionId = sectionArr[currentSectionIndex];

  const addPop = () => {
    indicatorSections.children[
      sectionArr.indexOf(lastSectionId) + 1
    ].classList.add("pop_indicator");
  };

  if (lastSectionId !== currentSectionId) {
    lastSectionId = currentSectionId;

    addPop();
  }
});

const onloadReturn = () => {
  const scrollY = window.scrollY;

  if (scrollY > 200) {
    returnBtn.classList.remove("opacity-0");
    returnBtn.classList.add("opacity-100");
  } else {
    returnBtn.classList.remove("opacity-100");
    returnBtn.classList.add("opacity-0");
  }

  indicator.style.top = `${
    (scrollY / (body.offsetHeight + footer.offsetHeight)) * 100
  }%`;
};

onloadReturn();

const AnimateButton = () => {
  let i = 0;
  buttons.forEach((button) => {
    button.id = i++;
    if (parseInt(button.id) % 2 === 0) {
      button.style.animation = `Animate_button 1s linear 1.5s infinite`;
    } else {
      button.style.animation = `Animate_button 1s linear 1.0s infinite`;
    }
  });
};

AnimateButton();
