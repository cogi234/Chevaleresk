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

    $.ajax({
        method: "GET",
        url: "operations/canCraft",
        data: {
            "multiplier": quantity,
            "id": current_recipe_id
        }
    }).then((e) => {
        $("#craft-btn").prop('disabled', !JSON.parse(e));
    });
}

function craft() {
    $.ajax({
        method: "GET",
        url: "operations/craftCurrent",
        data: {
            "multiplier": quantity,
            "id": current_recipe_id
        }
    });
}

function set_recipe(id) {
    current_recipe_id = id;
    set_quantity(quantity);
}

set_quantity(quantity);