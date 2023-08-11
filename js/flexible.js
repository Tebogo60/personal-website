let date = Date().split(" ");

// if (parseInt(date[4].slice(0, 2)) > 5 && parseInt(date[4].slice(0, 2)) < 18) {
//   body.classList.add("light_theme");
// }

// this code generates random number.
const randomNumber = () => {
  let num = Math.floor(Math.random() * (body.offsetWidth / 2));

  return num;
};

let colors = [
  "bg-gradient-blue-100",
  "bg-gradient-blue-300",
  "bg-gradient-pink-100",
  "bg-gradient-red-100",
];

// this code selects random colors from the color array
const randomColor = () => {
  let index = Math.floor(Math.random() * colors.length);

  return index;
};

// this code places circles in random location.
const placeCircles = () => {
  for (let i = 0; i < 7; i++) {
    circles.innerHTML += `<span class="circle"></span>`;
  }

  for (let i = 0; i < circles.children.length; i++) {
    let circleWidthHeight = randomNumber();

    let x = Math.floor(Math.random() * body.offsetWidth);
    let y = Math.floor(Math.random() * body.offsetHeight);

    circles.children[i].classList.add(colors[randomColor()]);

    if (x + circleWidthHeight > body.offsetWidth) {
      x -= body.offsetWidth - (x + circleWidthHeight);
    }

    if (y + circleWidthHeight > body.offsetHeight) {
      y -= body.offsetWidth - (y + circleWidthHeight);
    }

    circles.children[i].style.width = `${circleWidthHeight}px`;
    circles.children[i].style.height = `${circleWidthHeight}px`;
    circles.children[i].style.left = `${x}px`;
    circles.children[i].style.top = `${y}px`;
  }
};

// placeCircles();
