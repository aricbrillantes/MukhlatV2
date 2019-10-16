$(document).ready(function() {
    $("#side-topics-created").hide();
    $("#side-topics-moderated").hide();
    if(getCookie("tpsidebar")==='0')
        $("#side-topics-followed").hide();
    else
        $("#side-topics-followed").show();

    $("#side-topics-created-btn").on("click", function() {
        $("#side-topics-created").toggle('fast');
    });
    
    $("#side-topics-moderated-btn").on("click", function() {
        $("#side-topics-moderated").toggle('fast');
    });
    
    $("#side-topics-followed-btn").on("click", function() {
        $("#side-topics-followed").toggle('fast');
    });
});