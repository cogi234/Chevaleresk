var quantity = 0;
var current_recipe_id = -1;

function add_quantity(add) {
    set_quantity(quantity + add);
}

function set_quantity(newQuantity) {

    if (newQuantity < 0)
        newQuantity = 0;

    quantity = newQuantity;

    $("#quantity_label").html(quantity);

    $(".ingredient-label").each(function() {
        const element = $(this);

        let base = element.data("base") * quantity;
        let own = element.data("own"); 


        element.text(own + " / " + base);
        element.css("color", own >= base ? "var(--enough)" : "var(--missing)")
    });

    $.ajax({
        method: "GET",
        url: "operations/canCraft.php",
        data: {
            "multiplier": quantity,
            "id": current_recipe_id
        }
    }).then((e) => {
        $("#craft-btn").prop('disabled', !JSON.parse(e));
    });
}

function craft() {
    document.location.href = "operations/craftCurrent.php?id=" + current_recipe_id + "&multiplier=" + quantity;
}

function set_recipe(id) {
    current_recipe_id = id;
    set_quantity(quantity);
    updateDetails(current_recipe_id);
}

set_quantity(quantity);