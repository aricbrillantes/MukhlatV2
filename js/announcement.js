$(document).ready(function () 
{
    $("#create-announcement-btn").on("click", function () 
    {
        alert("sasasa");
        if ($("#announcement-content").val()) 
        {
            $("#create-announcement-form").submit();
            $("#announcement-content").parent().removeClass("has-error");
        } 

        else 
        {
            if (!$("#announcement-content").val())
                $("#announcement-content").parent().addClass("has-error");

            else
                $("#announcement-content").parent().removeClass("has-error");
        }
    });
});