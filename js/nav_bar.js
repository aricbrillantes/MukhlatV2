$(document).ready(function() {
    $.ajax({
        url: window.location.origin + "/MukhlatV2/notifications",
        context: document.body
    });

    $.ajax({
        url: window.location.origin + "/MukhlatV2/topic/refresh",
        context: document.body
    });
    
    $("#nav-logo").on("mouseover", function() {
        $(this).attr('src', window.location.origin + '/MukhlatV2/images/logo/mukhlatlogo on the sideb.png');
    });

    $("#nav-logo").on("mouseout", function() {
        $(this).attr('src', window.location.origin + '/MukhlatV2/images/logo/mukhlatlogo on the sideb.png');
    });

    $("#notif-btn").on("click", function() {
        var notif_count = $("#notif-btn").data("value");
        $.ajax({
            url: window.location.origin + "/MukhlatV2/notifications/read",
            success: function() {
                $("#notif-badge").remove();
                var new_notif_count = $("#notif-label").html() - notif_count;
                if (new_notif_count === 0) {
                    $("#notif-label").remove();
                } else {
                    $("#notif-label").html(new_notif_count);
                }
            }
        });
    });

    $(".invite-accept").on("click", function() {
        var inv_btn = $(this);
        var id = inv_btn.val();
        $.ajax({
            url: window.location.origin + "/MukhlatV2/invite/accept/invite/" + id,
            success: function(data) {
                //return data of user and topic
                var add_span = "<div class = 'invite-action text-success col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-check'></i> You have accepted the invite of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a>. " +
                        "Check out <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/topic/view/" + data.topic_id + "'>"
                        + "<strong>" + data.topic_name + "</strong></a>!</div>";
                var list_item = inv_btn.closest('.notif-item');
                list_item.html(add_span);
                list_item.addClass("list-group-item-success");
            }
        });
    });

    $(".invite-decline").on("click", function() {
        var inv_btn = $(this);
        var id = inv_btn.val();
        $.ajax({
            url: window.location.origin + "/MukhlatV2/invite/decline/invite/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-danger col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-close'></i> You have declined the invite of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> to moderate" +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/topic/view/" + data.topic_id + "'>"
                        + "<strong>" + data.topic_name + "</strong></a>!</div>";
                var list_item = inv_btn.closest('.notif-item');
                list_item.html(add_span);
                list_item.addClass("list-group-item-danger");
            }
        });
    });

    $(".request-accept").on("click", function() {
        var inv_btn = $(this);
        var id = inv_btn.val();

        $.ajax({
            url: window.location.origin + "/MukhlatV2/invite/accept/request/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-success col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-check'></i> You have accepted the request of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> in " +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/topic/view/" + data.topic_id + "'>"
                        + "<strong>" + data.topic_name + "</strong></a>!</div>";
                var list_item = inv_btn.closest('.notif-item');
                list_item.html(add_span);
                list_item.addClass("list-group-item-success");
            }
        });
    });

    $(".request-decline").on("click", function() {
        var inv_btn = $(this);
        var id = inv_btn.val();
        
        $.ajax({
            url: window.location.origin + "/MukhlatV2/invite/decline/request/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-danger col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-close'></i> You have declined the request of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> in" +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/MukhlatV2/topic/view/" + data.topic_id + "'>"
                        + "<strong>" + data.topic_name + "</strong></a>!</div>";
                var list_item = inv_btn.closest('.notif-item');
                list_item.html(add_span);
                list_item.addClass("list-group-item-danger");
            }
        });
    });
    
//    sticker text to image
    var find = ";yum;";
    var repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/yum.png'>";
    var page = document.body.innerHTML;
    findstickers(find, repl, page);
    
    find = ";pretty;";
    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/pretty.gif'>";
    page = document.body.innerHTML;
    findstickers(find, repl, page);
    
    function findstickers(find, repl, page){
    while (page.indexOf(find) >= 0) {
    var i = page.indexOf(find);
    var j = find.length;
    page = page.substr(0,i) + repl + page.substr(i+j);
    document.body.innerHTML = page;
    }}
    
    $('.editroomthemes').click(function(){
           $('.selected2').removeClass('selected2'); // removes the previous selected class
           $(this).addClass('selected2'); // adds the class to the clicked image
       });
       
    $('.blocks').click(function(){
    $('.selected').removeClass('selected'); // removes the previous selected class
    $(this).addClass('selected'); // adds the class to the clicked image
});

//screen resizing for mobile compaitibility
var w = window.innerWidth;
window.addEventListener("resize", function() {
  w=window.innerWidth;
//alert(w);
if(w<768){ //sm and xs
    $('.elements-resizer').removeClass('colly-lg-3');
    $('.elements-resizer').removeClass('colly-md-3');
    $('.roomthemes').addClass('colly-sm-3');
}
else if(w>=1200){ //xl
    $('.elements-resizer').addClass('colly-lg-3');
    $('.elements-resizer').removeClass('colly-md-3');
    $('.roomthemes').removeClass('colly-sm-3');
}
else if(w>=768 && w<1200){ //lg and md
    $('.elements-resizer').addClass('colly-md-3');
    $('.elements-resizer').removeClass('colly-lg-3');
    $('.roomthemes').removeClass('colly-sm-3');
}

});
if(w<768){ //very small screen
    $('.roomthemes').addClass('colly-sm-3');
}
else if(w>=1200){
    $('.elements-resizer').addClass('colly-lg-3');
}
else if(w>=768 && w<1200){
    $('.elements-resizer').addClass('colly-md-3');
}

    
});