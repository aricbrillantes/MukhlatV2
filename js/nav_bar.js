$(document).ready(function() {
    $.ajax({
        url: window.location.origin + "/notifications",
        context: document.body
    });

    $.ajax({
        url: window.location.origin + "/topic/refresh",
        context: document.body
    });
    
    $("#nav-logo").on("mouseover", function() {
        $(this).attr('src', window.location.origin + '/images/logo/mukhlatlogo on the sideb.png');
    });

    $("#nav-logo").on("mouseout", function() {
        $(this).attr('src', window.location.origin + '/images/logo/mukhlatlogo on the sideb.png');
    });

    $("#notif-btn").on("click", function() {
        var notif_count = $("#notif-btn").data("value");
        $.ajax({
            url: window.location.origin + "/notifications/read",
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
            url: window.location.origin + "/invite/accept/invite/" + id,
            success: function(data) {
                //return data of user and topic
                var add_span = "<div class = 'invite-action text-success col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-check'></i> You have accepted the invite of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a>. " +
                        "Check out <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/topic/view/" + data.topic_id + "'>"
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
            url: window.location.origin + "/invite/decline/invite/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-danger col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-close'></i> You have declined the invite of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> to moderate" +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/topic/view/" + data.topic_id + "'>"
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
            url: window.location.origin + "/invite/accept/request/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-success col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-check'></i> You have accepted the request of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> in " +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/topic/view/" + data.topic_id + "'>"
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
            url: window.location.origin + "/invite/decline/request/" + id,
            success: function(data) {
                var add_span = "<div class = 'invite-action text-danger col-xs-12' style = 'padding: 15px; font-size: 12px;'>" +
                        "<i class = 'fa fa-close'></i> You have declined the request of " +
                        "<a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/user/profile/" + data.user_id + "'>"
                        + "<strong>" + data.first_name + " " + data.last_name + "</strong></a> in" +
                        " <a class = 'btn btn-link btn-xs no-padding no-margin' style = 'padding-bottom: 3px;' href = '" + window.location.origin + "/topic/view/" + data.topic_id + "'>"
                        + "<strong>" + data.topic_name + "</strong></a>!</div>";
                var list_item = inv_btn.closest('.notif-item');
                list_item.html(add_span);
                list_item.addClass("list-group-item-danger");
            }
        });
    });
    
    
var page;
var page2;
var page3;
var inroompage=0;
var oneonly=1;
if(document.getElementById("chalkb") && document.getElementById("Mposts") && document.getElementById("messageb") || document.getElementById("UHposts")){
    oneonly=0;
}
//alert(oneonly);
if(oneonly===0){oneonly=1;
//alert(oneonly);
var list = new Array();
list[0] = ";love 2;^<img  width='30%' src='" + "/images/stickers/love 2.png'>";
list[1] = ";laughing crying;^<img  width='30%' src='" + "/images/stickers/laughing crying.png'>";
list[2] = ";love;^<img  width='30%' src='" + "/images/stickers/love.png'>";
list[3] = ";sad;^<img  width='30%' src='" + "/images/stickers/sad.png'>";
list[4] = ";angry;^<img  width='30%' src='" + "/images/stickers/angry.png'>";
list[5] = ";yuck;^<img  width='30%' src='" + "/images/stickers/yuck.png'>";
list[6] = ";happy;^<img  width='30%' src='" + "/images/stickers/happy.png'>";
list[7] = ";what;^<img  width='30%' src='" + "/images/stickers/what.png'>";
list[8] = ";haha;^<img  width='30%' src='" + "/images/stickers/haha.png'>";
list[9] = ";amazing;^<img  width='30%' src='" + "/images/stickers/amazing.png'>";
list[10] = ";joke;^<img  width='30%' src='" + "/images/stickers/joke.png'>";
list[11] = ";zzz;^<img  width='30%' src='" + "/images/stickers/zzz.png'>";
list[12] = ";eww;^<img  width='30%' src='" + "/images/stickers/eww.png'>";
list[13] = ";cool;^<img  width='30%' src='" + "/images/stickers/cool.png'>";
list[14] = ";woohoo;^<img  width='30%' src='" + "/images/stickers/woohoo.png'>";
list[15] = ";pretty;^<img  width='30%' src='" + "/images/stickers/pretty.gif'>";
list[16] = ";yum;^<img  width='30%' src='" + "/images/stickers/yum.png'>";
list[17] = ";wenk hi;^<img  width='30%' src='" + "/images/stickers/wenk hi.png'>";
list[18] = ";wenk facepalm;^<img  width='30%' src='" + "/images/stickers/wenk facepalm.png'>";
list[19] = ";wenk haha;^<img  width='30%' src='" + "/images/stickers/wenk haha.png'>";
list[20] = ";spidab;^<img  width='30%' src='" + "/images/stickers/spidab.png'>";
list[21] = ";busy;^<img  width='30%' src='" + "/images/stickers/busy.png'>";
list[22] = ";sweet;^<img  width='30%' src='" + "/images/stickers/sweet.png'>";
var j, k, find, item, repl;
if(document.getElementById("chalkb") && document.getElementById("Mposts") && document.getElementById("messageb")){
    page = document.getElementById("chalkb").innerHTML;
    page2 = document.getElementById("Mposts").innerHTML;
    page3 = document.getElementById("messageb").innerHTML;
    inroompage=1;
    }
else if(document.getElementById("UHposts"))
    page = document.getElementById("UHposts").innerHTML;

for (var i=0; i<list.length; i++) {
item = list[i].split("^");
find = item[0];
repl = item[1];
while (page.indexOf(find) >= 0) {
var j = page.indexOf(find);
var k = find.length;
page = page.substr(0,j) + repl + page.substr(j+k);
}
}

if(inroompage===1){
    for (var i=0; i<list.length; i++) {
    item = list[i].split("^");
    find = item[0];
    repl = item[1];
    while (page2.indexOf(find) >= 0) {
        var j = page2.indexOf(find);
        var k = find.length;
        page2 = page2.substr(0,j) + repl + page2.substr(j+k);
        }
    }
    for (var i=0; i<list.length; i++) {
    item = list[i].split("^");
    find = item[0];
    repl = item[1];
    while (page3.indexOf(find) >= 0) {
        var j = page3.indexOf(find);
        var k = find.length;
        page3 = page3.substr(0,j) + repl + page3.substr(j+k);
        }
    }
}
if(document.getElementById("chalkb") && document.getElementById("Mposts") && document.getElementById("messageb")){
    document.getElementById("chalkb").innerHTML = page;
    document.getElementById("Mposts").innerHTML = page2;
    document.getElementById("messageb").innerHTML = page3;
    }
else if(document.getElementById("UHposts"))
    document.getElementById("UHposts").innerHTML = page;
}
    
    
    $('.editroomthemes').click(function(){
           $('.selected2').removeClass('selected2'); // removes the previous selected class
           $(this).addClass('selected2'); // adds the class to the clicked image
       });
       
    $('.blocks').click(function(){
    $('.selected').removeClass('selected'); // removes the previous selected class
    $(this).addClass('selected'); // adds the class to the clicked image
});

    $('.blocks3').click(function(){
    $('.selected3').removeClass('selected3'); // removes the previous selected class
    $(this).addClass('selected3'); // adds the class to the clicked image
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