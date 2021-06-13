/* require('./bootstrap');

require('alpinejs'); */

document.addEventListener('DOMContentLoaded', function(){
  const open = document.getElementById('open');
  const overlay = document.querySelector('.overlay');
  const close = document.getElementById('close');

  open.addEventListener('click', () => {
    overlay.classList.add('show');
    open.classList.add('hide');
  });

  close.addEventListener('click', () => {
    overlay.classList.remove('show');
    open.classList.remove('hide');
  });
});

const targetElements = document.querySelectorAll(".point");
window.addEventListener("scroll", function() {
  for (let i =0; i < targetElements.length; i++) {
    const getElementDistance = targetElements[i].getBoundingClientRect().top + targetElements[i].clientHeight*.5;
    if(window.innerHeight > getElementDistance){
      targetElements[i].classList.add("show");
    }
  }
})



