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
    if (e.target.getAttribute('data-link') == null && e.target.tagName != "I") {
      if (e.target.href == null) {
        window.location = $(this).data('href');
      }
    } else {
      document.getElementById('confirmButtonDelete').href = e.target.getAttribute('data-link') == null ? e.target.parentElement.getAttribute('data-link') : e.target.getAttribute('data-link');
    }
  });

  $('.presence').on('click', e => {
    let atrasos = document.getElementById('atrasos');
    let justificativas = document.getElementById('justificativas');

    let componente_id = e.target.nextElementSibling.htmlFor.substr(11, 2);

    // Desmarca a opção de atraso e justificativa, caso estejam marcados
    e.target.nextElementSibling.nextElementSibling.classList.remove('text-success');
    e.target.nextElementSibling.nextElementSibling.nextElementSibling.classList.remove('text-danger');

    // Remove da lista de atrasados e justificados, caso estejam
    atrasos.value = String(atrasos.value).replace(`${componente_id},`, '');
    justificativas.value = String(justificativas.value).replace(`${componente_id},`, '');
  });

  $('.justify-fault').on('click', (e) => {
    let atrasos = document.getElementById('atrasos');
    let justificativas = document.querySelector('#justificativas');

    let componente_id = e.target.previousElementSibling.htmlFor.substr(11, 2);

    // Verifica se existe e remove
    if (String(justificativas.value).includes(componente_id)) {
      justificativas.value = String(justificativas.value).replace(`${componente_id},`, ''); 
    } else {
      // Marca como justificado
      justificativas.value += `${componente_id},`;
      // Remove da lista de atrasados, caso esteja
      atrasos.value = String(atrasos.value).replace(`${componente_id},`, '');
      // Remove a marcação de atraso, caso esteja marcado
      e.target.nextElementSibling.classList.remove('text-danger');
      // Desmarca o checkbox de presença, caso esteja marcado
      e.target.previousElementSibling.previousElementSibling.checked = false;
    }

    e.target.classList.toggle('text-success');
  });

  $('.later').on('click', e => {
    let atrasos = document.getElementById('atrasos');
    let justificativas = document.getElementById('justificativas');

    let componente_id = e.target.previousElementSibling.previousElementSibling.htmlFor.substr(11, 2);

    // Verifica se existe e remove
    if (String(atrasos.value).includes(componente_id)) {
      atrasos.value = String(atrasos.value).replace(`${componente_id},`, '');
    } else {
      // Marca como atrasado
      atrasos.value += `${componente_id},`;
      // Remove da lista de justificativas, caso tenha sido clicado
      justificativas.value = String(justificativas.value).replace(`${componente_id},`, '');
      // Remove a marcação da justificativa
      e.target.previousElementSibling.classList.remove('text-success'); 
      // Desmarca o checkbox de presença, caso esteja marcado
      e.target.previousElementSibling.previousElementSibling.previousElementSibling.checked = false;
    }

    e.target.classList.toggle('text-danger');
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
