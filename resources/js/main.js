$(document).ready(function () {
    $.scrollSpeed(80, 500);
});

if (document.getElementById('editable'))
{
    ClassicEditor.create(editable);
}