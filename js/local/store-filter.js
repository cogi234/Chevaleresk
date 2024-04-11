function filterSubmit(event) {
    add_loader();
}

const form = document.getElementById("store-filter");
form.addEventListener("htmx:beforeSend", filterSubmit);

function add_loader() {
    const parent = $(".store-item-holder")[0];

    // Clear current items
    parent.innerHTML = '';

    // Add loader
    const loader = document.createElement("div");
    loader.classList.add("loader");

    parent.append(loader);
}

add_loader();