const openMenu = document.querySelector(".bi-list");
const listItem = document.querySelector(".list-items");
const logoToggle = document.querySelector(".logo_toggle");

openMenu.addEventListener('click', function() {
    listItem.classList.toggle("active");
    openMenu.classList.toggle("active");
    logoToggle.classList.toggle("active");
})