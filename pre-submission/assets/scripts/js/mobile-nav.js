(() => {
  const hamburger = document.getElementById('mobile-hamburger-menu');
  const nav = document.querySelector('.nav-bar');
  console.log(nav)

  hamburger.addEventListener('click', e => {
    if(hamburger.classList.contains('menu-active')) {
      nav.parentElement.parentElement.style.opacity = 0;
      nav.parentElement.parentElement.style.zIndex = 0;
      hamburger.classList.remove('menu-active')
    } else {
      nav.parentElement.parentElement.style.opacity = 1;
      nav.parentElement.parentElement.style.zIndex = 10;
      hamburger.classList.add('menu-active')
    }
  })
})()