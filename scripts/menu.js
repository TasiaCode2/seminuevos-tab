const menuBtn = document.getElementById("menu-icon");
const menu = document.getElementById("menu-container");
const body = document.body;

// Muestra el menú y bloquea el scroll del body
menuBtn.onclick = () => {
    menu.classList.toggle("show-menu");
    body.classList.toggle("block-scroll");
}


const closeBtn = document.getElementById("close-icon");

// Oculta el menú y desbloquea el scroll del body
closeBtn.onclick = () => {
    menu.classList.toggle("show-menu");
    body.classList.toggle("block-scroll");
}