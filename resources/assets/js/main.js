particlesJS.load('particles-js', 'js/particles.json', function() {
});

$(document).ready(function () {
    jQuery.scrollSpeed(100, 1300);
});

let counter = document.createElement('input');
counter.name = "contactCounter";
counter.id = "contactCounter";
counter.value = 0;
counter.type = "hidden";
contactForm.appendChild(counter);
contactArea.addEventListener('keypress', function () {
    contactCounter.value = parseInt(contactCounter.value) + 1;
});