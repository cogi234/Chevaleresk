 function updateDetails(id){
    $.ajax({
        method: "GET",
        url: "operations/getRecipeDetails.php",
        data: {
            "id": current_recipe_id
        }
    }).then((e) => {
        console.log(e);
        e = JSON.parse(e);
        //difficulty
        $("#detail-difficulty").addClass(e.difficulty_class);
        $("#detail-difficulty").html(e.difficuty)
        $("#detail-difficulty").attr("title", "Potion de difficulté: " + e.difficuty)
        //player level
        $("#detail-player-level").html(e.player_level)
        //image
        $("#detail-image").attr("src", e.image);
        //effet
        $("#detail-effect").html(e.effect);
        //ingredients
        e.ingredients.forEach(ingredient => {
            let imageHtml = '<img class="" src="'+ ingredient.image +'"/>';
            let quantityHtml = '<p class="">'+ ingredient.name +'</p>';
            $("#detail-ingredients").append("");
        });
    });
 }