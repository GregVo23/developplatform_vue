console.log('scroll effect');

let lastKnownScrollPosition = 0;
let ticking = false;
let footer = document.querySelector('#footer');
let height = document.querySelector("body > div.min-h-screen.bg-gray-100 > main > div > div > div.grid.grid-cols-1.gap-4.lg\\:col-span-2 > section > div > div").offsetHeight;


function doSomething(scrollPos) {

let position = window.pageYOffset;

if(position > height - 500){

    document.querySelector("#sidebar > div").style.width = '100%';
    document.querySelector('#sidebar').style.position = 'relative';
    document.querySelector('#sidebar').style.width = '100%';
    document.querySelector('#sidebar').style.transition = 'background-color 0.3s ease';
    document.querySelector('#sidebar').style.backgroundColor = 'transparent';
    document.querySelector('#sidebar').style.display = 'flex';

}else{

    document.querySelector("#sidebar > div").style.width = '100%';
    document.querySelector('#sidebar').style.position = 'fixed';
    document.querySelector('#sidebar').style.width = '32%';
    document.querySelector('#sidebar').style.transition = 'background-color 0.3s ease';
    document.querySelector('#sidebar').style.backgroundColor = 'white';
    document.querySelector('#sidebar').style.display = 'flex';
}
}

document.addEventListener('scroll', function(e) {
lastKnownScrollPosition = window.scrollY;


if (!ticking) {
  window.requestAnimationFrame(function() {
    doSomething(lastKnownScrollPosition);
    ticking = false;
  });

  ticking = true;
}
});

