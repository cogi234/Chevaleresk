function add_loader() {
    const container = $(".quest-container")[0];

    // Clear current items
    container.innerHTML = '';

    // Add loader
    const loader = document.createElement("div");
    loader.classList.add("loader");

    container.append(loader);
}