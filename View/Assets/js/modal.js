let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrir');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function () {
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function () {
    modal.style.display = 'none';
});

// Boton de ir arriba

document.getElementById("button-up").addEventListener("click", scrollUp);

function scrollUp() {

    var currentScroll = document.documentElement.scrollTop;

    if (currentScroll > 0) {
        window.requestAnimationFrame(scrollUp);
        window.scrollTo(0, currentScroll - (currentScroll / 10));
    }
}


///

buttonUp = document.getElementById("button-up");

window.onscroll = function () {

    var scroll = document.documentElement.scrollTop;

    if (scroll > 200) {
        buttonUp.style.transform = "scale(1)";
    } else if (scroll < 200) {
        buttonUp.style.transform = "scale(0)";
    }

}