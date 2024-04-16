// Show recipes
// $recipes_list_html = "";
// include_once "php/html/recipesListHTML.php";

let index = 0;
let reachedEnd = false;
let fetch = null;

function checkVisible(elm) {
    var rect = elm.getBoundingClientRect();
    var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
    return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}

function checkLoader() {
    let unloader = $("#panoramix-unloader")[0];

    if (reachedEnd || !checkVisible(unloader)) 
    {
        clearInterval(fetch);
        fetch = setInterval(checkLoader, reachedEnd ? 10000 : 1000);
    }

    $.ajax({
        method: "GET",
        url: "operations/getRecipes",
        data: {
            index: index
        }
    }).then((e) => {

        reachedEnd = e == "";
        
        if (reachedEnd)
            return;

        html = $.parseHTML(e);
        html.forEach(element => {

            if ($("#" + element.id).length == 0)
                unloader.before(element);
        });

        index++;
    });
}

fetch = setInterval(checkLoader, 1000);