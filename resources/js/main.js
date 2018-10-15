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

function countdown(id, deadline) {
    let now = (new Date()).getTime();
    deadline = (new Date(`${deadline}`)).getTime();
    let distance = deadline - now;
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById(`days${id}`).innerHTML = `${days}`;
    document.getElementById(`hours${id}`).innerHTML = `${hours}`;
    document.getElementById(`minutes${id}`).innerHTML = `${minutes}`;
    document.getElementById(`seconds${id}`).innerHTML = `${seconds}`;
}