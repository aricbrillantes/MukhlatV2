$(document).ready(function () 
{
    $("#create-note-btn").on("click", function () 
    {
        alert("sasasa");
        if ($("#note-content").val()) 
        {
            $("#create-note-form").submit();
            $("#note-content").parent().removeClass("has-error");
        } 

        else 
        {
            if (!$("#note-content").val())
                $("#note-content").parent().addClass("has-error");

            else
                $("#note-content").parent().removeClass("has-error");
        }
    });
});