const scrollEffects = () => {
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

window.addEventListener("scroll", () => {
  scrollEffects();
});

const onloadReturn = () => {
  scrollEffects();
};

onloadReturn();

const AnimateButton = () => {
  let i = 0;
  buttons.forEach((button) => {
    button.id = i++;
    if (parseInt(button.id) % 2 === 0) {
      button.style.animation = `Animate_button 1s linear .5s infinite`;
    } else {
      button.style.animation = `Animate_button 1s linear 0s infinite`;
    }
  });
};

AnimateButton();

for (let j = 0; j < 10; j++) {
  for (let i = 0; i < 10; i++) {
    boxes.innerHTML += `
    <span class="box" 
    style="
    width: ${Math.floor(bgBox.offsetWidth / 10)}px; 
    height: ${Math.floor(bgBox.offsetHeight / 10)}px; 
    top: ${Math.floor(bgBox.offsetHeight / 10) * j}px; 
    left:${Math.floor(bgBox.offsetWidth / 10) * i}px; 
    ">
    </span>;`;
  }
}

const randomBoxIndex = () => {
  return Math.floor(Math.random() * 400);
};

const usedRandomIndex = [];

const popBox = () => {
  let randomIndex = randomBoxIndex();
  boxes.children[randomIndex].classList.toggle("box_pop");
  usedRandomIndex.push(randomIndex);
};

if (boxes.children) {
  setInterval(popBox, 250);
}
