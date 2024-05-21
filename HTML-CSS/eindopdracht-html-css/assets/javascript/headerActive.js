document.addEventListener("DOMContentLoaded", function () {
    var currentPagePath = window.location.pathname.split('/').pop(); 
    var navLinks = document.querySelectorAll('nav a[data-url]'); 
    var dropdownActive = false;

    navLinks.forEach(function (link) {
        if (link.getAttribute('data-url') === "./"+currentPagePath || link.getAttribute('data-url') === currentPagePath) {
            link.classList.add('active-link'); 
            if (link.closest('.dropdown-content')) {
                dropdownActive = true;
            }
        }

        if (dropdownActive) {
            var dropdownBtn = document.querySelector('.dropdown .dropbtn');
            if (dropdownBtn) {
                dropdownBtn.classList.add('active-link');
            }
        }
    });
});