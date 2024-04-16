const BUTTON_OPEN = "fa-chevron-left";
const BUTTON_CLOSE = "fa-chevron-right";

var $toggle = document.getElementById('filter-button');

$toggle.addEventListener('click', function () {
    var isOpen = $("#filter").hasClass("slide-in");

    $("#filter").toggleClass("slide-in");

    if (isOpen) {
        $toggle.classList.add(BUTTON_CLOSE);
        $toggle.classList.remove(BUTTON_OPEN);
    }
    else {
        $toggle.classList.add(BUTTON_OPEN);
        $toggle.classList.remove(BUTTON_CLOSE);
    }
});

// $toggle.click.apply($toggle);
$toggle.classList.add("fa", BUTTON_CLOSE);