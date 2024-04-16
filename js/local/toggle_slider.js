function create_slider(id, parentId, content = null, toggleBtn = null) {
    const parent = $("#" + parentId);

    // Create slider
    const slider = document.createElement("div");
    slider.id = id;
    slider.innerHTML = content;

    // Toggle btn
    var toggle = toggleBtn ?? parent;

    toggle.click(function () {
        $("#" + id).toggleClass("slide-in");
    });

    parent.append(slider);
};