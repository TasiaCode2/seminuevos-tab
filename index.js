const catList = document.getElementById("category-list");
const categories = document.getElementById("categories");

catList.onclick = () => {
    categories.classList.toggle("show");
}

const menuBtn = document.getElementById("menu-icon");
const menu = document.getElementById("menu-container");
menuBtn.onclick = () => {
    menu.classList.toggle("show-menu");
}

const closeBtn = document.getElementById("close-icon");
closeBtn.onclick = () => {
    menu.classList.toggle("show-menu");
}
