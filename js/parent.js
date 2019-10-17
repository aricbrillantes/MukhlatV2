$(document).ready(function () {
    $(".toggle-account-parent").on("click", function () {
        var btn = $(this);
        $.ajax({
            type: "POST",
            url: "",
            data: {user_id: $(this).val()},
            success: function () {
                if (btn.hasClass("btn-danger")) {
                    btn.removeClass("btn-danger");
                    btn.addClass("btn-success");
                    btn.html("Enable");
                } else if (btn.hasClass("btn-success")) {
                    btn.removeClass("btn-success");
                    btn.addClass("btn-danger");
                    btn.html("Disable");
                }
            }
        });
    });
});