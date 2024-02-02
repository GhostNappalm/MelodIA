
var util = {
    mobileMenu() {
      $("#nav").toggleClass("nav-visible");
    },
    windowResize() {
      if ($(window).width() > 800) {
        $("#nav").removeClass("nav-visible");
      }
    },

  };


  
  $(document).ready(function() {
    

    $("#menu").click(util.mobileMenu);
    $(window).resize(util.windowResize);

    var links = $(".nav-link");
    var currentPath = window.location.pathname;

    // Rimuovi la classe "active" da tutti gli altri link
    links.removeClass('active');

    // Trova il link con l'id corrispondente al percorso della pagina
    var activeLink = links.filter(function() {
      return currentPath.indexOf($(this).attr('id')) !== -1;
    } );

    // Aggiungi la classe "active" al link trovato
    activeLink.addClass('active');
         
      
    
  });