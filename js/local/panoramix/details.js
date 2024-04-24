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
        } catch (error) {
            console.error(error);
        }
    });
 }

 function create_ui(parent) {
    // Difficulty
    const difficulty = document.createElement("div");
    difficulty.classList.add("item-level");

    const difficultyText = document.createElement("span");
    difficultyText.id = "details-difficulty";

    difficulty.append(difficultyText);
    parent.append(difficulty);

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

    // <span id="detail-player-level" class=" "></span>
    // <img id="detail-image"/>
    // <p id="detail-effect"></p>
    // <div id="detail-ingredients"></div>
    // $remove_button
    // <span id="quantity_label"></span>
    // $add_button
    // $craft_button

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
    let difficulty = data.difficulty;
    let difficulty_class = data.difficulty_class;
    let player_level = data.player_level;
    let image_src = data.image;

    // Difficulty
    const difficultyText = $("#details-difficulty")[0];

    if (difficultyText != undefined) {
        difficultyText.className = difficulty_class;
        difficultyText.innerText = difficulty;
        difficultyText.setAttribute("title", "Potion de difficulté: " + difficulty);
    }
    else
        console.warn("No element has the id 'details-difficulty'");

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
    
    //effet
    //$("#detail-effect").html(data.effect);
    //ingredients
    // data.ingredients.forEach(ingredient => {
    //     let imageHtml = '<img class="" src="'+ ingredient.image +'"/>';
    //     let quantityHtml = '<p class="">'+ ingredient.name +'</p>';
    //     $("#detail-ingredients").append("");
    // });
};

let container = $("#details-container")[0];

if (container != undefined)
    create_ui(container);