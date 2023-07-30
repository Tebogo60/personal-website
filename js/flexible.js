let date = Date().split(" ");

if (parseInt(date[4].slice(0, 2)) > 5 && parseInt(date[4].slice(0, 2)) <= 18) {
  body.classList.add("light_theme");
}
