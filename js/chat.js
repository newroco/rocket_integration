document.addEventListener("DOMContentLoaded", function () {
    var elements = document.getElementsByClassName('messenger--add-members-info');

    if (elements.length > 0) {
        setTimeout(function () {
            elements[0].classList.add('messenger--hidden');
        }, 7000);
    }
});
