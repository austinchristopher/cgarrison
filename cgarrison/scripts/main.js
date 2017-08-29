let tripped = false;

(function animloop() {
  requestAnimationFrame(animloop);
  const header = document.querySelector('.site-header__header');
  if (window.scrollY > 0 && tripped === false) {
    header.classList.add('sticky');
    tripped = true;
  } else if( window.scrollY === 0 && tripped === true) {
    header.classList.remove('sticky');
    tripped = false;
  }
})();

function resetMainMenu() {
  var mainMenuLinks = document.querySelectorAll('#menu-main li a');
  mainMenuLinks = Array.prototype.slice.call(mainMenuLinks);
  mainMenuLinks.forEach(function(item) {
    item.classList.remove('active');
  });
}

var scroll = new SmoothScroll('#projects', {
  header: '[data-scroll-header]',
  speed: 1250,
  easing: 'easeInOutCubic',
});


var mainMenuLinks = document.querySelectorAll('#menu-main li a');
mainMenuLinks = Array.prototype.slice.call(mainMenuLinks);

mainMenuLinks.forEach(function(item) {
  item.addEventListener('click', function(e) {
    resetMainMenu();
    item.classList.add('active');
    e.preventDefault();
    var hash = e.target.hash;
    hash = hash.replace('/', '');
    scroll.animateScroll(document.querySelector(hash));
  });
});
