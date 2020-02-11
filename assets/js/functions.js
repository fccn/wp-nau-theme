// JavaScript Document

// starts menu opening and closing button for top menu: hamburger
function openNav() {
  document.getElementById("menu-container").style.cssText = "left:0px;";
  document.getElementById("open-menu-arrow").style.cssText = "display:none";
  document.getElementById("close-menu-arrow").style.cssText = "display:block;z-index:2;";
  document.getElementById("menu-overlay").style.cssText = "display:block;z-index:0;background: #000; opacity:0.5;";
}

function closeNav() {
  document.getElementById("menu-container").style.cssText = "left:-375px";
  document.getElementById("menu-overlay").style.cssText = "display:block;z-index:-1;";
  document.getElementById("open-menu-arrow").style.cssText = "display:block;";
  document.getElementById("close-menu-arrow").style.cssText = "display:none;";
}
// ends menu opening and closing button for menu: hamburger
