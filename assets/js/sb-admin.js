(function ($) {
  "use strict"; // Start of use strict

  // Toggle the side navigation
  $("#sidebarToggle").on('click', function (e) {
    e.preventDefault();
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    $("#wrapper #content-wrapper").toggleClass("toggled");
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $(document).on('click', 'a.scroll-to-top', function (event) {
    var $anchor = $(this);
    $('html, body').stop().animate({
      scrollTop: ($($anchor.attr('href')).offset().top)
    }, 1000, 'easeInOutExpo');
    event.preventDefault();
  });

  // Init popover messages
  $(function () {
    $('[data-toggle="popover"]').popover({
      container: 'body',
      template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="bg-dark text-light popover-header"></h3><div class="popover-body"></div></div>'
    });
  });

  window.addEventListener('load', function () {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);

  $(document).on('click', 'tr.clickable', function (e) {
    if (e.target.getAttribute('data-link') == undefined) {
      window.location = $(this).data('href');
    } else {
      document.getElementById('confirmButtonDelete').href = e.target.getAttribute('data-link');
    }
  });

  $('.justify-fault').on('click', (e) => {
    let justificativas = document.querySelector('#justificativas');
    let componente_id = e.target.previousElementSibling.htmlFor.substr(11, 2);
    if (String(justificativas.value).includes(componente_id)) {
      justificativas.value = String(justificativas.value).replace(`${componente_id},`, ''); 
    } else {
      justificativas.value += `${componente_id},`;
    }
    e.target.classList.toggle('text-success');
  });

  $(() => {
    if ('serviceWorker' in navigator) {
      navigator.serviceWorker.register('sw.js').then(() => {
        console.log('SW registrado');
      }).catch((error) => {
        console.log('SW Error');
      });
    }
  });

})(jQuery); // End of use strict
