const MIN_INTERVAL = 1_000;
const MAX_INTERVAL = 10_000;
const FETCH_VALUE = 0.75;

let index = 0;
let fetchInterval = null;
let fetchPending = false;
let reachedEnd = false;

function getScrollPercent(element) {
    var maxScrollTop = element.prop("scrollHeight") - element.outerHeight();

    return element.scrollTop() / maxScrollTop;
}

function createLoader() {
    let loader = getLoader();
    
    if (loader != undefined)
    {
        loader.style.display = "inherit";
        return;
    }

    loader = document.createElement("i");
    loader.id = "panoramix-loader";
    loader.classList.add("loader");

    $("#items").append(loader);
}

function getLoader() {
    return $("#panoramix-loader")[0];
}

function setFetch(interval) {
    clearInterval(fetchInterval);

    if (interval > 0)
        fetchInterval = setInterval(checkLoader, interval);
    else
        fetchInterval = null;
}

function checkLoader() {
    if (fetchPending)
        return;

    setFetch(-1);
    fetchPending = true;

    $.ajax({
        method: "GET",
        url: "operations/getRecipes.php",
        data: {
            index: index
        }
    }).then((e) => {

        let loader = getLoader();

        fetchPending = false;
        setFetch(MAX_INTERVAL);
        
        reachedEnd = e == "";
        if (reachedEnd) {
            loader.style.display = "none";
            return;
        }

        loader.style.display = "inherit";

        html = $.parseHTML(e);
        html.forEach(element => {

            if ($("#" + element.id).length == 0 && element.dataset != undefined) {
                element.addEventListener("click", function () {
                    click_element(element);
                });
                
                if (current_recipe_id == -1)
                    click_element(element);

                loader.before(element);
            }
        });

        createLoader();

        index++;
    });
}

function click_element(element) {
    set_recipe(element.dataset.id);

    $(".selected").removeClass("selected");
    element.classList.add("selected");
}

function setup_ui(parent) {
    if (parent == undefined)
        return;
    
    parent.scrollTop = 0;
    parent.addEventListener("scroll", function() {
    
        if (fetchPending || reachedEnd)
            return;
    
        let value = getScrollPercent($(this));
        if (value < FETCH_VALUE)
            return;
    
        checkLoader();
    });
    
}

setup_ui(document.getElementById('items'));

createLoader();
checkLoader();