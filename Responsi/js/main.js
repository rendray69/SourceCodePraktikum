const showMenu = (headerToggle, navbarId) =>{
    const toggleBtn = document.getElementById(headerToggle),
    nav = document.getElementById(navbarId);

    // Validate that variables exist
    if(headerToggle && navbarId){
        toggleBtn.addEventListener('click', ()=>{
            // We add the show-menu class to the div tag with the nav__menu class
            nav.classList.toggle('show-menu');

            toggleBtn.classList.toggle('bx-x');
        });
    }
};
showMenu('header-toggle' , 'navbar');

const linkColor = document.querySelectorAll('.nav__link');

function colorLink(){
    "use strict";
    linkColor.forEach(N => n.classList.remove('activet'));
    this.classList.add('activet');
}

linkColor.forEach(N => n.addEventListener('click', colorLink));

// Prevent Bootstrap dialog from blocking focusin
$(document).on('focusin', function(e) {
   if ($(e.target).closest(".tox-tinymce, .tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
     e.stopImmediatePropagation();
   }
});

function myFunction() {
    var element = document.getElementById("notif");
    element.classList.add("badge");
}