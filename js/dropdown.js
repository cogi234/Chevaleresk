/* When the user clicks on the button, toggle between hiding and showing the dropdown content */
function dropdownClicked(id) {
    let content = document.getElementById(id);

    if (content == null)
        return;

    toggle(content);
}

function toggle(element) {
    element.style.display = element.style.display == "block" ? "" : "block";
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (event.target.matches('.dropdown-button'))
        return;

    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
        dropdowns[i].style.display = "";
    }
}