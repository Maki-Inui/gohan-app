/* require('./bootstrap');

require('alpinejs'); */

const targetElements = document.querySelectorAll(".point");
window.addEventListener("scroll", function() {
  for (let i =0; i < targetElements.length; i++) {
    const getElementDistance = targetElements[i].getBoundingClientRect().top + targetElements[i].clientHeight*.5;
    if(window.innerHeight > getElementDistance){
      targetElements[i].classList.add("show");
    }
  }
})
