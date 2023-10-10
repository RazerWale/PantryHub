let slidePage = document.querySelector(".slidepage");
let firstNextBtn = document.querySelector(".nextBtn");

let secondNextBtn = document.querySelector(".next-1");
let secondPrevBtn = document.querySelector(".prev-1");

let thirdPrevBtn = document.querySelector(".prev-2");
let formSubmitBtn = document.querySelector(".reg-submit");

let slidePage2 = document.querySelector(".slidenextpg2");
let slidePrevPage3 = document.querySelector(".slideprevpg3");

const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const passConInput = document.getElementById('passCon');
const submitBtn = document.getElementById('submit');
const submitForm = document.getElementById('form');

firstNextBtn.addEventListener("click", function(event) {
    event.preventDefault();
    if (usernameInput.value !== '' && emailInput.value !== '' && passwordInput.value !== '' && passConInput.value !== '') {
        slidePage.style.marginLeft = "-31.24%";
    } else {
        alert('please input all the fields')
    }
});
secondNextBtn.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-62.48%";
});
secondPrevBtn.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "0";
});
thirdPrevBtn.addEventListener("click", function(event) {
    event.preventDefault();
    slidePage.style.marginLeft = "-31.24%";
});