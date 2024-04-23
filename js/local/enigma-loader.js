function add_loader() {
    const container = $("#quest-container");
    // Clear current items
    container.empty();

    // Add loader
    const loader = document.createElement("div");
    loader.classList.add("loader");

    container.append(loader);
}

$(".receive-quest-button").click(add_loader);