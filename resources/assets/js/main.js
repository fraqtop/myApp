particlesJS.load('particles-js', 'js/particles.json', function() {
});

$(document).ready(function () {
    $.scrollSpeed(100, 1300);
    $(".info").css("visibility", "hidden");
    $(".timing").css("visibility", "hidden");
    $(".posts").css("visibility", "hidden");
    let checkPoint = 200;
    window.onscroll = function () {
        if($(".info").offset().top - window.pageYOffset < checkPoint)
        {
            $(".info").addClass("animated bounceInUp");
            $(".info").css("visibility", "visible");
        }
        if($(".timing").offset().top - window.pageYOffset < checkPoint)
        {
            $(".timing").addClass("animated bounceInLeft");
            $(".timing").css("visibility", "visible");
        }
        if($(".posts").offset().top - window.pageYOffset < checkPoint)
        {
            $(".posts").addClass("animated bounceInRight");
            $(".posts").css("visibility", "visible");
        }
    }
});

if (document.getElementById('contactForm'))
{
    console.log('true');
    let counter = document.createElement('input');
    counter.name = "contactCounter";
    counter.id = "contactCounter";
    counter.value = 0;
    counter.type = "hidden";
    contactForm.appendChild(counter);
    contactArea.addEventListener('keypress', function () {
        contactCounter.value = parseInt(contactCounter.value) + 1;
    });
}