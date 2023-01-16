const btnСlose = document.querySelector(".btn_close");
const donateContainer = document.querySelector("#donate");
const donate = document.querySelector(".donateBtn");

const testBtn = document.querySelector(".testBtn");
const booksBtn = document.querySelector(".booksBtn");

donate.addEventListener('click', function() {
    donateContainer.classList.add("active");
})

btnСlose.addEventListener('click', function() {
    donateContainer.classList.remove("active");
})

testBtn.addEventListener('click', function() {
    alert("Бұл сілтеме уақытша істемейді!")
})

booksBtn.addEventListener('click', function() {
    alert("Бұл сілтеме уақытша істемейді!")
})
