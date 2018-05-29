particlesJS.load('particles-js', 'js/particles.json', function() {
});

$(document).ready(function () {
    $.scrollSpeed(80, 500);
    if(window.location.pathname === '/')
    {
        let infoSection = $(".info");
        let timingSection = $(".timing");
        let postsSection = $(".posts");
        infoSection.css("visibility", "hidden");
        timingSection.css("visibility", "hidden");
        postsSection.css("visibility", "hidden");
        let checkPoint = 200;
        window.onscroll = function (event) {
            if(infoSection.offset().top - window.pageYOffset < checkPoint)
            {
                infoSection.addClass("animated bounceInUp");
                infoSection.css("visibility", "visible");
            }
            if(timingSection.offset().top - window.pageYOffset < checkPoint)
            {
                timingSection.addClass("animated bounceInLeft");
                timingSection.css("visibility", "visible");
            }
            if(postsSection.offset().top - window.pageYOffset < checkPoint)
            {
                postsSection.addClass("animated bounceInRight");
                postsSection.css("visibility", "visible");
            }
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