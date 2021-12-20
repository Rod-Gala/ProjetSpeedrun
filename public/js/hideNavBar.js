var actualY = window.scrollY;
var navbar = document.getElementById('navbar');
navbar.style.transform = "translateY(0%)";
window.addEventListener('scroll', scrollEvent);

/**
 * Function hidding the navbar when scroll down
 * and show it when scroll up
 */
function scrollEvent() {
    // Get the new value of scrollY
    let newScrollY = window.scrollY;
    // Calculate the delta of Ys
    let deltaY = actualY - newScrollY;

    // If Delta is negative and navbar displayed
    if (deltaY < 0 && navbar.style.transform == "translateY(0%)") {
        navbar.style.transform = "translateY(-100%)";
        
    }
    // If Delta is positive and navbar hidden
    if (deltaY > 0 && navbar.style.transform == "translateY(-100%)") {
        navbar.style.transform = "translateY(0%)";
    }

    // Replace scrollY value
    actualY = newScrollY;
}