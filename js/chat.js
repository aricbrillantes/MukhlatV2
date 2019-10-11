$(document).ready(function()
{
    function get_chats()
    {
        $.ajax({
            type: "POST",
            url: base_url + "chat/ajax_getChats",
            // dataType: "json",
            data: { sender_id : sender_id },
            success: function (data) {
                // alert('2');
                
                   
                $("div#chats_box").append(data);
                // $(div).find('#chat_viewport').html('<h1>Hello</h1>');
                
                
            }
        });
    }
    get_chats();
    function get_chatmessages()
    {
        // alert('1');
        $.ajax({
            type: "POST",
            url: base_url + "chat/ajax_getChatMessages",
            // dataType: "json",
            data: { chat_id : chat_id },
            success: function (data) {
                // alert('2');
                
                   
                $("div#chat_viewport").html(data);
                // $(div).find('#chat_viewport').html('<h1>Hello</h1>');
                
                
            }
        });
    }

    get_chatmessages();

    $("a#submit_msg").click(function(){
        var chat_message = $("input#chat_msg").val();
        
        if(chat_message == "")
        {
            return false;
        }
        else{
            // $.post( base_url + "chat/ajax_add_chat_message", { chat_message : chat_message, chat_id : chat_id , sender_id : sender_id }, function(data) {
            //     alert(data);
            // }, "json");
            $.ajax({
                type: "POST",
                url: base_url + "chat/ajax_add_chat_message",
                data: { chat_message : chat_message, chat_id : chat_id , sender_id : sender_id },
                success: function () {
                    // alert('hello');
                }
            });
        }
        // return false;
    });

    $(".chat_inst").on("click", function(){
        var chat_id = $(".chat_inst").val();
        alert('button clicked');
        $.ajax({
            type: "POST",
            url: base_url + "chat/change_chat",
            data: { chat_id : chat_id },
            success: function () {
                alert('chat changed');
            }
        });
        

    });

});