// Component declaration
const menuContainer = document.querySelector(".menu-container");
const openMenu = document.getElementById("open-menu-arrow");
const closeMenu = document.getElementById("close-menu-arrow");
const menuOverlay = document.querySelector(".menu-overlay");
const bodyOverlay = document.getElementsByTagName("body")[0];
const helpWidget = document.getElementsByTagName('iframe');

console.log(helpWidget)

/* Menu functions to open and close on mobile.
   They also take care of the overlay activation
*/

function openNav() {
  menuContainer.style.cssText = "display:block";
  //openMenu.style.cssText = "display:none;"; 
  closeMenu.style.cssText = "display:block";

  // enables Overlay and disables scroll on body
  menuOverlay.style.cssText = "display:block";
  bodyOverlay.classList.add("enable-overlay");
}

function closeNav() {
  menuContainer.style.cssText = "display:none;";
  //openMenu.style.cssText = "display:block;";
  closeMenu.style.cssText = "display:none";
  menuOverlay.style.cssText = "display:none;";
  bodyOverlay.classList.remove("enable-overlay");
}