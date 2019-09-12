$(document).ready(function() {
    $("#side-topics-created").hide();
    $("#side-topics-moderated").hide();
    $("#side-topics-followed").hide();

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