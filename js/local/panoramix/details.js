var current_id = null;

function updateDetails(id) {
    $("#details-loader").css("opacity", 1);
    $("#details-loader-panel").css("opacity", 1);
    current_id = id;

    $.ajax({
        method: "GET",
        url: "operations/getRecipeDetails.php",
        data: {
            "id": id,
        }
    }).then((e) => {
        try {
            e = JSON.parse(e);

            if (e.id != current_id)
                return;

            update_ui(e);
            $("#details-loader").css("opacity", 0);
            set_quantity(1);
        } catch (error) {
            console.error(error);
        }
    });
 }

 function create_ui(parent) {
    // Player Level
    const playerLvl = document.createElement("div");

    const playerLvlText = document.createElement("span");
    playerLvlText.id = "details-player-level";

    playerLvl.append(playerLvlText);
    parent.append(playerLvl);

    // Image
    const image = document.createElement("div");
    image.id = "details-image";
    image.classList.add("product-image");
    
    parent.append(image);

    // Name
    const name = document.createElement("div");
    name.id = "details-name";

    parent.append(name);

    // Ingredients
    const ingredients = document.createElement("div");
    ingredients.id = "details-ingredients-container";

    parent.append(ingredients);

    // Quantity
    const make_container = document.createElement("div");
    make_container.id = "details-make-container";

    const quantity_input = document.createElement("input");
    quantity_input.type = "number";
    quantity_input.min = 1;
    quantity_input.value = 1;
    quantity_input.addEventListener("change", () => set_quantity(quantity_input.value));

    make_container.append(quantity_input);
    
    // Craft
    const craft_btn = document.createElement("button");
    craft_btn.id = "craft-btn";
    craft_btn.innerText = "Fabriquer";
    craft_btn.addEventListener("click", () => craft());

    make_container.append(craft_btn);
    parent.append(make_container);

    // Loader
    const loader = document.createElement("div");
    loader.id = "details-loader";

    const loader_panel = document.createElement("div");
    loader_panel.id = "details-loader-panel";
    loader_panel.style.opacity = 0;

    const loader_text = document.createElement("span");
    loader_text.innerText = "Chargement ...";

    const loader_anim = document.createElement("i");
    loader_anim.classList.add("loader");

    loader_panel.append(loader_text);
    loader_panel.append(loader_anim);
    loader.append(loader_panel);
    parent.append(loader);
};
 
function update_ui(data) {
    // Get data
    let player_level = data.player_level;
    let image_src = data.image;
    let item_name = data.name;
    let item_effect = data.effect;
    let ingredients_list = data.ingredients;

    // Player Level
    const playerLvlText = $("#details-player-level")[0];

    if (playerLvlText != undefined) {
        playerLvlText.innerText = player_level;
    }
    else
        console.warn("No element has the id 'details-player'");

    // Image
    const image = $("#details-image")[0];

    if (image != undefined) {
        image.style.backgroundImage = "url('" + image_src + "')";
    }
    else
        console.warn("No element has the id 'details-image'");
    
    // Name
    const name = $("#details-name")[0];

    if (name != undefined) {
        name.innerHTML = "";

        if (item_effect != null)
            name.innerHTML += '<i id="details-effect" class="fa-solid fa-wand-sparkles fa-fw" title="' + item_effect + '"></i>';

        name.innerHTML += '<span>' + item_name + '</span>';
    }
    else
        console.warn("No element has the id 'details-name'");
    
    // Ingredients
    const ingredients = $("#details-ingredients-container")[0];

    if (ingredients != undefined) {
        ingredients.innerHTML = "";

        ingredients_list.forEach(element => {

            const container = document.createElement("div");
            container.classList.add("ingredient");
            container.setAttribute("title", element.name);

            const img = document.createElement("div");
            img.classList.add("ingredient-img");
            img.style.backgroundImage = "url('" + element.image + "')";

            const quantity = document.createElement("span");
            quantity.classList.add("ingredient-label");
            quantity.dataset.base = element.quantity;
            quantity.dataset.own = element.inventory;

            container.append(img);
            container.append(quantity);
            ingredients.append(container);
        });
    }
    else 
        console.warn("No element has the id 'details-ingredients-container'");

    // data.ingredients.forEach(ingredient => {
    //     let imageHtml = '<img class="" src="'+ ingredient.image +'"/>';
    //     let quantityHtml = '<p class="">'+ ingredient.name +'</p>';
    //     $("#detail-ingredients").append("");
    // });
};

let container = $("#details-container")[0];

if (container != undefined)
    create_ui(container);