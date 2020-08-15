$(document).ready(function () {
    // Jquery UI
    $( ".datepicker" ).datepicker({
        dateFormat: "dd-mm-yy"
    });
    $( ".selectbox" ).selectmenu().selectmenu( "menuWidget" ).addClass( "overflow" );
    // Price filter
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 1500,
        values: [300, 1200],
        slide: function(event, ui) {
            $("#amount_min").val(ui.values[0]);
            $("#amount_max").val(ui.values[1]);
        }
    });
    $("#amount_min").val($("#slider-range").slider("values", 0));
    $("#amount_max").val($("#slider-range").slider("values", 1));
    $("#amount_min").change(function() {
        $("#slider-range").slider("values", 0, $(this).val());
    });
    $("#amount_max").change(function() {
        $("#slider-range").slider("values", 1, $(this).val());
    });
    // Lazy Img
    $("img").addClass("lazy");
    $('.lazy').lazy();
    // Slider
    $(".testi-slider").owlCarousel({
        items: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        loop: true
    });
    $(".desti-slider").owlCarousel({
        items: 3,
        dots: true,
        // autoplay: true,
        // autoplaySpeed: 1000,
        // loop: true,
        navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"],
        nav: false,
        responsive : {
            // breakpoint from 480 up
            0 : {
                items: 1,
                nav: true,
                navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"]
            },
            // breakpoint from 768 up
            640 : {
                items: 2,
                nav: true,
                navText: ["<i class='fas fa-arrow-left'></i>","<i class='fas fa-arrow-right'></i>"]
            },
            // breakpoint from 992 up
            1024: {
                items: 3
            }
        }
    });

    if ($(window).width() < 992){
        $(".cart-mobile").append($(".cart").html());
    }
    $(".filter-btn").click(function () {
        $(".sideBar").toggleClass("active");
    })
});