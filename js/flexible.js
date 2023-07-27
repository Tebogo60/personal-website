const circles = document.querySelector(".circles");
const body = document.querySelector("body");

const gradientBg = [
  "bg-gradient-blue-100",
  "bg-gradient-blue-300",
  "bg-gradient-pink-100",
  "bg-gradient-red-100",
];

const randomizeCircles = () => {
  for (let i = 0; i < 10; i++) {
    let randomBg = Math.floor(Math.random() * gradientBg.length);
    let randomTiming = Math.floor(Math.random() * 20);
    circles.innerHTML += `<span class="circle ${
      gradientBg[randomBg]
    }" style="animation: circleAnimation ${
      randomTiming * 4
    }s ease infinite;"></span>`;
  }

  for (let i = 0; i < circles.children.length; i++) {
    var x = Math.floor(Math.random() * window.innerWidth);
    var y = Math.floor(Math.random() * (body.offsetHeight - window.innerWidth));

    circles.children[i].style.left = x + "px";
    circles.children[i].style.top = y + "px";

    circles.children[i].style.width = x / 2 + "px";
    circles.children[i].style.height = x / 2 + "px";
  }
};

window.onload = randomizeCircles;
