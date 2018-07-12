$(document).ready(function () {
    $.scrollSpeed(80, 500);
    if(window.location.pathname === '/')
    {
        particlesJS.load('particles-js', 'js/particles.json', function() {
        });
        let infoSection = $(".info");
        let timingSection = $(".timing");
        let postsSection = $(".posts");
        infoSection.css("visibility", "hidden");
        timingSection.css("visibility", "hidden");
        postsSection.css("visibility", "hidden");
        let checkPoint = 350;
        window.onscroll = function () {
            if(infoSection.offset().top - window.pageYOffset < checkPoint)
            {
                infoSection.addClass("animated fadeInUp");
                infoSection.css("visibility", "visible");
            }
            if(timingSection.offset().top - window.pageYOffset < checkPoint)
            {
                timingSection.addClass("animated zoomIn");
                timingSection.css("visibility", "visible");
            }
            if(postsSection.offset().top - window.pageYOffset < checkPoint)
            {
                postsSection.addClass("animated zoomIn");
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
    contactArea.oninput = function () {
        contactCounter.value = parseInt(contactCounter.value) + 1;
    };
}
if (document.getElementById('editable'))
{
    ClassicEditor.create(editable);
}