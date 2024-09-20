//asscssing the nav elements
let burger = document.querySelector(".burger");
let navItem = document.querySelector(".nav-items");
console.log(navItem);

burger.addEventListener("click", () =>{
    navItem.classList.toggle("nav-vis");

});


let profile = document.querySelector(".Profile-c");
let pbox = document.querySelector(".pBox");
let cross = document.querySelector(".cross");

profile.addEventListener("click", () =>{
    pbox.classList.toggle("pBox-vis");

});
cross.addEventListener("click", () =>{
    pbox.classList.remove("pBox-vis");

});