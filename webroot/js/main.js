(function ($) {
    "use strict";

    var fullHeight = function () {
        $(".js-fullheight").css("height", $(window).height());
        $(window).resize(function () {
            $(".js-fullheight").css("height", $(window).height());
        });
    };
    fullHeight();

    $("#sidebarCollapse").on("click", function () {
        $("#sidebar").toggleClass("active");
    });
    // $("#key").change(function () {
    //     $.ajax({
    //         type: "POST",
    //         url: "todos/search/",
    //         data: {
    //             id: $("#key").val(),
    //         },
    //         headers: {
    //             "X-CSRF-Token": $('meta[name="csrfToken"]').attr("content"),
    //         },
    //         // dataType: "dataType",
    //         // success: function(response) {

    //         // }
    //     }).done(function (response) {
    //         location.assign("todos/search/");
    //         // $("#content").html(response);
    //     });
    // });
})(jQuery);
