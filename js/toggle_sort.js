const BUTTON_OPEN = "fa-chevron-left";
const BUTTON_CLOSE = "fa-chevron-right";

const SLIDE_OPEN = "filter-slide-in";
const SLIDE_CLOSE = "filter-slide-out";

var $slider = document.getElementById('filter');
var $toggle = document.getElementById('filter-button');

$toggle.addEventListener('click', function () {
    var isOpen = $slider.classList.contains('filter-slide-in');

    if (isOpen) {
        $toggle.classList.add(BUTTON_CLOSE);
        $toggle.classList.remove(BUTTON_OPEN);

        $slider.classList.add(SLIDE_CLOSE);
        $slider.classList.remove(SLIDE_OPEN);
    }
    else {
        $toggle.classList.add(BUTTON_OPEN);
        $toggle.classList.remove(BUTTON_CLOSE);

        $slider.classList.add(SLIDE_OPEN);
        $slider.classList.remove(SLIDE_CLOSE);
    }

});

// $toggle.click.apply($toggle);
$toggle.classList.add("fa", BUTTON_CLOSE);