let bar = Array.from(document.querySelectorAll("li"));

bar.forEach(function(it) {
  it.onclick = function() {
    bar.forEach(function(el) {
      el.classList.remove("nav_menu_active");
    });
    this.classList.toggle("nav_menu_active");
  };
});