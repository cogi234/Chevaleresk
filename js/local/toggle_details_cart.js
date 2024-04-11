$("#details-cart-collapse").on("click", function () {
    $("#details-cart").toggleClass("details-fixed-cart");
    $(this).toggleClass("fa-plus");
    $(this).toggleClass("fa-minus");
});