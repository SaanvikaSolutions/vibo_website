// navigation js 
//asscssing the nav elements
let burger = document.querySelector(".burger");
let navItem = document.querySelector(".nav-items");
console.log(navItem);

burger.addEventListener("click", () =>{
    navItem.classList.toggle("nav-vis");

});
// navigation js end 
// slider js start 
window.addEventListener('load', function () {
    let slide = document.querySelectorAll(".Each-sider");
    let dots = document.querySelectorAll(".circle");

    let counter = 0;
    let intervalId;
    let slidWidth = slide[0].clientWidth;

    function Slider(){
        counter++;

        if(counter == slide.length){
            counter = 0;
        }
        slide.forEach(slide => {
            slide.style.transform = `translateX(-${slidWidth * counter}px)`;
            slide.style.transition = `all 1s ease`;
        });

        dots.forEach(dot =>{
            dot.classList.remove('dot-green');
        });
        dots[counter].classList.add('dot-green');
    }

    function startTimer() {
        intervalId = setInterval(Slider, 4000);
    }

    startTimer();

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            counter=i;

            slide.forEach(slide => {
                slide.style.transform = `translateX(-${slidWidth * (counter)}px)`;
                slide.style.transition = `all 1s ease`;
            });

            dots.forEach(dot =>{
                dot.classList.remove('dot-green');
            });
            dots[counter].classList.add('dot-green');
            
            clearInterval(intervalId);
            startTimer();
        });
    });

    window.addEventListener('resize', function () {
        slidWidth = slide[0].clientWidth;
        console.log('Resize event triggered');
        console.log('slidWidth:', slidWidth);

        slide.forEach(slide => {
            slide.style.transition = 'none';
            slide.style.transform = `translateX(-${slidWidth * counter}px)`;
        });

        setTimeout(() => {
            slide.style.transition = '';
        }, 50);
    });
    
});
// slider js end 


// Mvvr js start 
let MVVHead = document.querySelectorAll(".heading-MVV");
let MVVLeft = document.querySelectorAll(".Mission-content")

MVVHead.forEach((dot, i) => {
    dot.addEventListener("click", () => {
        // Remove MVVR-active class from all elements
        MVVLeft.forEach(element => {
            element.classList.remove("MVVR-active");
        });

        // Add MVVR-active class to the clicked element
        MVVLeft[i].classList.add("MVVR-active");
    });
});
// Mvvr js end 


// testimonial js start 
// Access the testimonials
let testSlide = document.querySelectorAll('.testItem');
// Access the indicators
let dots = document.querySelectorAll('.dot');

var counter = 0;

// Add click event to the indicators
function switchTest(currentTest) {
    currentTest.classList.add('active');
    var testId = currentTest.getAttribute('attr');
    if (testId > counter) {
        testSlide[counter].style.animation = 'next1 0.5s ease-in forwards';
        counter = testId;
        testSlide[counter].style.animation = 'next2 0.5s ease-in forwards';
    }
    else if (testId == counter) { return; }
    else {
        testSlide[counter].style.animation = 'prev1 0.5s ease-in forwards';
        counter = testId;
        testSlide[counter].style.animation = 'prev2 0.5s ease-in forwards';
    }
    indicators();
}

// Add and remove active class from the indicators
function indicators() {
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(' active', '');
    }
    dots[counter].className += ' active';
}

// Code for auto sliding
function slideNext() {
    testSlide[counter].style.animation = 'next1 0.5s ease-in forwards';
    if (counter >= testSlide.length - 1) {
        counter = 0;
    }
    else {
        counter++;
    }
    testSlide[counter].style.animation = 'next2 0.5s ease-in forwards';
    indicators();
}
function autoSliding() {
    deleteInterval = setInterval(timer, 2000);
    function timer() {
        slideNext();
        indicators();
    }
}
autoSliding();

// Stop auto sliding when mouse is over the indicators
const container = document.querySelector('.indicators');
container.addEventListener('mouseover', pause);
function pause() {
    clearInterval(deleteInterval);
}

// Resume sliding when mouse is out of the indicators
container.addEventListener('mouseout', autoSliding);
// testimonial js end