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

    $(".exportPdf").on("click", function () {
        var key = $("#key").val() ? $("#key").val() : "";
        var type = $("#type").val() ? $("#type").val() : "";
        var day = $("#day").val() ? $("#day").val() : "all";
        window.location.href =
            "" +
            window.location.origin +
            "/todos/exportpdf?key=" +
            key +
            "&type=" +
            type +
            "&day=" +
            day +
            "";
    });
    console.log(window.location.pathname);
    $(".exportXml").on("click", function () {
        var key = $("#key").val();
        var type = $("#type").val();
        var day = $("#day").val();
        window.location.href =
            "" +
            window.location.origin +
            "/todos/exportxml?key=" +
            key +
            "&type=" +
            type +
            "&day=" +
            day +
            "";
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
