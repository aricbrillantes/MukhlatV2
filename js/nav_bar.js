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
//    var find = ";yum;";
//    var repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/yum.png'>";
//    var page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";pretty;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/pretty.gif'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";woohoo;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/woohoo.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";cool;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/cool.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";eww;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/eww.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";zzz;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/zzz.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";joke;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/joke.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";amazing;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/amazing.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";what;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/what.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";haha;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/haha.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";happy;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/happy.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";yuck;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/yuck.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";angry;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/angry.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";sad;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/sad.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";love;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/love.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";laughing crying;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/laughing crying.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    find = ";love 2;";
//    repl = "<img  width='50%' src='" + "/MukhlatV2/images/stickers/love 2.png'>";
//    page = document.body.innerHTML;
//    findstickers(find, repl, page);
//    
//    function findstickers(find, repl, page){
//    while (page.indexOf(find) >= 0) {
//    var i = page.indexOf(find);
//    var j = find.length;
//    page = page.substr(0,i) + repl + page.substr(i+j);
//    document.body.innerHTML = page;
//    }}
    
    
    
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
    $('.themesmodal').addClass('themesmodal2');
    $('.themesmodal').removeClass('themesmodal');
    $('#navbaricons2').addClass('hideme');
    $('#navtoggler').removeClass('hideme');
    
//    $('.hider').addClass('hideme');
    $('.hidertab').removeClass('hideme');
    $('.mystuffpreview').addClass('hideme');
    $('.hideinbig').removeClass('hideme');
    
    $('#nav-logo3').removeClass('hideme');
    $('#nav-logo').addClass('hideme');
    $('#nav-logo2').addClass('hideme');
}
else if(w>=1200){ //xl
    $('.elements-resizer').addClass('colly-lg-3');
    $('.elements-resizer').removeClass('colly-md-3');
    $('.roomthemes').removeClass('colly-sm-3');
    $('.themesmodal2').addClass('themesmodal');
    $('.themesmodal2').removeClass('themesmodal2');
    
    $('#nav-logo3').addClass('hideme');
    $('#nav-logo').removeClass('hideme');
    $('#nav-logo2').removeClass('hideme');
    
    $('#navbaricons2').removeClass('hideme');
    $('#navtoggler').addClass('hideme');
    
    $('.hidertab').addClass('hideme');
    $('.hider').removeClass('hideme');
    $('.mystuffpreview').removeClass('hideme');
    $('.hideinbig').addClass('hideme');
    
}
else if(w>=768 && w<1200){ //lg and md
    $('.elements-resizer').addClass('colly-md-3');
    $('.elements-resizer').removeClass('colly-lg-3');
    $('.roomthemes').removeClass('colly-sm-3');
    $('.themesmodal2').addClass('themesmodal');
    $('.themesmodal2').removeClass('themesmodal2');
    $('#navbaricons2').addClass('hideme');
    $('#navtoggler').removeClass('hideme');
    
    $('.mystuffpreview').removeClass('hideme');
    $('.hidertab').addClass('hideme');
    $('.hider').removeClass('hideme');
    $('.hideinbig').addClass('hideme');
    
    $('#nav-logo3').addClass('hideme');
    $('#nav-logo').removeClass('hideme');
    $('#nav-logo2').removeClass('hideme');
}

});
//alert(w);
if(w<768){ //very small screen
    $('.roomthemes').addClass('colly-sm-3');
    $('.hider').addClass('hideme');
    $('.themesmodal').addClass('themesmodal2');
    $('.themesmodal').removeClass('themesmodal');
    $('#navbaricons2').addClass('hideme');
        
    $('#nav-logo3').removeClass('hideme');
    $('#nav-logo').addClass('hideme');
    $('#nav-logo2').addClass('hideme');
}
else if(w>=1200){
    $('.elements-resizer').addClass('colly-lg-3');
    $('#navtoggler').addClass('hideme');
    $('.hideinbig').addClass('hideme');
    
}
else if(w>=768 && w<1200){
    $('.elements-resizer').addClass('colly-md-3');
    $('.mystuffpreview').removeClass('hideme');
    $('.hidertab').addClass('hideme');
    $('#navbaricons2').addClass('hideme');
    $('.hideinbig').addClass('hideme');
    
}

$('#navtoggler').on('click', function() {
		$('body').toggleClass('open-nav');
	});

});