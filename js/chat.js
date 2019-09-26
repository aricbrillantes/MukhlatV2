$(document).ready(function()
{
    $("a#submit_msg").click(function(){
        var chat_message = $("input#chat_msg").val();
        
        if(chat_message == "")
        {
            return false;
        }
        
        // $.post( base_url + "chat/ajax_add_chat_message", { chat_message : chat_message, chat_id : chat_id , sender_id : sender_id }, function(data) {
        //     alert(data);
        // }, "json");
        $.ajax({
            type: "POST",
            url: base_url + "chat/ajax_add_chat_message",
            data: { chat_message : chat_message, chat_id : chat_id , sender_id : sender_id },
            success: function () {
                alert('hello');
            }
        });

        return false;
    });

});