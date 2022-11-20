'use strict';

window.addEventListener("DOMContentLoaded", function () {
    let form_recipe = document.getElementById("form_recipe");

    form_recipe.addEventListener(
        "submit",
        function () {
            window.confirm("削除しますか？");
        },
        false
    );
});





window.addEventListener('scroll', reveal);

function reveal() {
let reveals = document.querySelectorAll('.reveal');

for (let i = 0; i < reveals.length; i++) {

    console.log(window.innerHeight);
    let windowheight = window.innerHeight;
    let revealtop = reveals[i].getBoundingClientRect().top;
    let revealpoint = 20;

    if (revealtop < windowheight - revealpoint) {
    reveals[i].classList.add('active');
    } else {
    reveals[i].classList.remove('active');
    }
}
}



