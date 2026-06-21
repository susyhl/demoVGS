(function(){
  'use strict';
  document.addEventListener('DOMContentLoaded', function(){
    var sliders = document.querySelectorAll('.cpt-slider');
    if(!sliders.length) return;

    sliders.forEach(function(slider){
      var wrapper = slider.querySelector('.cpt-slider-wrapper');
      var slides = slider.querySelectorAll('.cpt-slide');
      var total = slides.length;
      var index = 0;
      var interval = 5000; // autoplay
      var animating = false;

      // setup styles
      wrapper.style.display = 'flex';
      wrapper.style.transition = 'transform 400ms ease';
      wrapper.style.willChange = 'transform';
      slides.forEach(function(s){ s.style.minWidth = '100%'; s.style.boxSizing = 'border-box'; });

      // try to use existing prev/next buttons rendered inside the DOM (e.g. in .cpt-slide-inner)
      var prev = slider.querySelector('.cpt-slider-prev');
      var next = slider.querySelector('.cpt-slider-next');
      // fallback: create buttons if not present
      if ( ! prev ) {
        prev = document.createElement('button');
        prev.className = 'cpt-slider-prev';
        prev.setAttribute('aria-label', 'Previous slide');
        slider.appendChild(prev);
      }
      if ( ! next ) {
        next = document.createElement('button');
        next.className = 'cpt-slider-next';
        next.setAttribute('aria-label', 'Next slide');
        slider.appendChild(next);
      }

      function goTo(i){
        if(animating) return;
        animating = true;
        index = (i + total) % total;
        wrapper.style.transform = 'translateX(' + (-index * 100) + '%)';
        setTimeout(function(){ animating = false; }, 450 );
      }

      prev.addEventListener('click', function(e){ e.preventDefault(); goTo(index-1); });
      next.addEventListener('click', function(e){ e.preventDefault(); goTo(index+1); });

      // autoplay
      var timer = setInterval(function(){ goTo(index+1); }, interval );
      slider.addEventListener('mouseenter', function(){ clearInterval(timer); });
      slider.addEventListener('mouseleave', function(){ timer = setInterval(function(){ goTo(index+1); }, interval ); });

      // responsive: ensure correct translate after resize
      window.addEventListener('resize', function(){ wrapper.style.transform = 'translateX(' + (-index * 100) + '%)'; });

      // start at first
      goTo(0);

      // Menu toggle (mobile): delegate clicks on toggle buttons inside slides
      slider.addEventListener('click', function(e){
        var toggle = e.target.closest('.cpt-slide-menu-toggle');
        if(toggle){
          e.preventDefault();
          var menu = toggle.closest('.cpt-slide-menu');
          if(menu){
            var isOpen = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
          }
        }
      });
    });
  });
})();
