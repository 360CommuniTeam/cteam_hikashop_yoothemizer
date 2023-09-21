  /*jshint esversion: 6 */
  (function () {
    "use strict";
  
  
    window.addEventListener("load", function() {
  
      var passwordToggleElements = document.querySelectorAll('.uk-input-password-toggle');
      
      passwordToggleElements.forEach((elm) => {
        elm.addEventListener('click', function (e) {
          e.preventDefault();
          
          if(elm.previousElementSibling.getAttribute('type') == 'password') {
            elm.previousElementSibling.setAttribute('type', 'text');
            elm.setAttribute('uk-icon', 'icon: eye-slash');
          } else {
            elm.previousElementSibling.setAttribute('type', 'password');
            elm.setAttribute('uk-icon', 'icon: eye');
          }


          return false;
        });
      })

    });
  
  })();
  