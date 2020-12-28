// Component declaration
const menuContainer = document.querySelector(".menu-container");
const openMenu = document.getElementById("open-menu-arrow");
const closeMenu = document.getElementById("close-menu-arrow");
const menuOverlay = document.querySelector(".menu-overlay");
const bodyOverlay = document.getElementsByTagName("body")[0];

// starts menu opening and closing button for menu: cross
function openNav() {
  menuContainer.style.cssText = "display:block;";
  //openMenu.style.cssText = "display:none;"; 
  closeMenu.style.cssText = "display:block";
  // enables Overlay and disables scroll on body
  menuOverlay.style.cssText = "display:block;";
  bodyOverlay.classList.add("enable-overlay");
}

function closeNav() {
  menuContainer.style.cssText = "display:none;";
  openMenu.style.cssText = "display:block;";
  closeMenu.style.cssText = "display:none";  
  menuOverlay.style.cssText = "display:none;";
  bodyOverlay.classList.remove("enable-overlay");
}
// ends menu opening and closing button for menu: cross

/* Open submenus
const menus = document.querySelectorAll(".main-menu>li")

const clearMenus = () => {
  menus.forEach((menu) => {
    menu.querySelector('.sub-nav').classList.remove('subnav-active')
  })
}

menus.forEach((menu) => {
  menu.addEventListener("click", function(e) {
    e.preventDefault()
    clearMenus()
    this.querySelector('.sub-nav').classList.toggle('subnav-active')
  })
})*/