//asscssing the nav elements
let burger = document.querySelector(".burger");
let navItem = document.querySelector(".nav-items");
console.log(navItem);

burger.addEventListener("click", () =>{
    navItem.classList.toggle("nav-vis");

});