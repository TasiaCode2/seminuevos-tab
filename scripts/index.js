const catList = document.getElementById("category-list");
const categories = document.getElementById("categories");

catList.onclick = () => {
    categories.classList.toggle("show");
    console.log("hey");
}


