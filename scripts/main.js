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

function closeMenu() {
  document.querySelector('.site-header__main-nav--mobile').classList.remove('open');
}

var scroll = new SmoothScroll('.menu-item a', {
  header: '[data-scroll-header]',
  speed: 1250,
  easing: 'easeInOutCubic',
  before: closeMenu
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

var mobileMenu = document.querySelector('.main-nav__mobile-expander');
mobileMenu.addEventListener('click', function() {
  document.querySelector('.site-header__main-nav--mobile').classList.toggle('open');
});
