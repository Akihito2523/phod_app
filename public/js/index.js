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




const tagetElement = document.querySelectorAll(".animationTarget");
console.log("画面の高さ", window.innerHeight)
document.addEventListener("scroll", function(){
    for(let i = 0; i < tagetElement.length; i++){
    //getBoundingClientRectはブラウザからliタグまでの距離
    const getElementDistance = tagetElement[i].getBoundingClientRect().top + tagetElement[i].clientHeight * .6;//6割見えてshowが出てくる

    // li要素が見えたらクラスshowを追加
    if(window.innerHeight > getElementDistance){
        tagetElement[i].classList.add("show");
    }
    //if(window.innerHeight)
    }
});

