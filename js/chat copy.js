var chat = {
    clients: {},
    from: null,
    user_id: null,
    processing: false,
    ongoing_call: false,
    init: function()
    {
        $(window).resize(this.clean_up);
        $('.chat-contact').click(this.open);
        this.from = $('#from-name').val();
        this.user_id = $('#my-user-id').val();
        $('#contacts .btn-default').click(this.get_online);
    },
    init_dialog: function()
    {
        $('.send-button').click(this.send);
        $('.share-button').click(this.share);
        $('.call-button a:last-child').click(this.call_doctor);
        $('.chat-close').click(this.close);
        $('.chat .dropdown-menu').click(function(event)
        {
            event.stopPropagation();
        });
    },
    call_doctor: function()
    {
        if (!chat.ongoing_call)
        {
            var chat_ui, message;

            $(this).prop('disabled', true);
            chat_ui = $(this).closest('.chat');
            chat_ui.removeClass('open');
            $('#other-session-id').val(chat_ui.attr('user-session'));
            $.post('consultation/get_token/', {connect_session_id: chat_ui.attr('user-session')}, function(token)
            {
                $('#other-token').val(token);
                case_records.start_call();
            });
        }
    },
    get_online: function(event)
    {
        if (!chat.processing)
        {
            chat.processing = true;
            $.get('chat/online_list/', function(response)
            {
                chat.processing = false;
                var chat_list;

                chat_list = JSON.parse(response);

                $('#contacts ul').html('');
                if (chat_list.online!= null && chat_list.online.length > 0)
                {
                    $.each(chat_list.online, function (index, element)
                    {
                        $('#contacts ul').append('<li class="chat-contact" user-id="' + element.user_id + '" user-session="' + element.session_id + '">'
                            + '<a href="javascript:void(0);">'
                                + element.last_name + ', ' + element.first_name
                            + '</a>'
                            + '<span class="specialty">'
                                + element.specialty
                            + '</span>'
                        +'</li>');
                    });
                }
                else
                {
                    $('#contacts ul').append('<li class="text-center">No Online Doctors</li>');
                }

                if (chat_list.offline!= null && chat_list.offline.length > 0)
                {
                    $('#contacts ul').append('<li class="divider"></li><span class="offline text-center">Offline</span>');
                    $.each(chat_list.offline, function (index, element)
                    {
                        var specialty;
                        
                        specialty = element.specialty != null ? element.specialty : '';
                        $('#contacts ul').append('<li class="chat-contact" user-id="' + element.user_id + '" user-session="' + element.session_id + '">'
                            + '<a href="javascript:void(0);">'
                                + element.last_name + ', ' + element.first_name
                            + '</a>'
                            + '<span class="specialty">'
                                + specialty
                            + '</span>'
                        +'</li>');
                    });
                }

                chat.init();
            });
        }
    },
    clean_up: function(event)
    {
        if ($('.chat').length > 1)
        {
            do
            {                
                var chat_area_rect, last_chat_rect;
                
                chat_area_rect = $('#chat-area')[0].getBoundingClientRect();
                last_chat_rect = $('.chat:last-child')[0].getBoundingClientRect();
        
                if (last_chat_rect.top > chat_area_rect.top + last_chat_rect.height)
                {
                    $($('.chat')[0]).remove();
                    last_chat_rect = $('.chat:last-child')[0].getBoundingClientRect();
                }
            } while ((last_chat_rect.top > chat_area_rect.top + last_chat_rect.height));
        }
    },
    open: function(event)
    {
        var user_id;
    
        event.stopPropagation();
        
        user_id = $(this).attr('user-id');
        
        if (chat.clients[user_id] == undefined || chat.clients[user_id] == null)
        {
            chat.clients[user_id] = new chat_client($(this).attr('user-session'), user_id, $(this).find('a').text());
        }
        else
        {
            chat.clients[user_id].init();
        }
        $('#contacts').removeClass('open');
    },
    share: function(event)
    {
        var chat_ui, message;
        
        chat_ui = $(this).closest('.chat');
        message = '<a href="' + $('#share-link').val() + '">View Record</a>';
        chat.execute_send(chat_ui, message);
    },
    send: function(event)
    {
        var chat_ui, message;
        
        chat_ui = $(this).closest('.chat');
        text_input = chat_ui.find('.message-input textarea');
        message = text_input.val();
        text_input.val('');
        chat.execute_send(chat_ui, message);
    },
    execute_send: function(chat_ui, message)
    {        
        if (message.length > 0)
        {
            var user_id, messages;
            
            user_id = chat_ui.attr('user-id');
            messages = chat_ui.find('.messages');
            
            messages.append('<li class="sender text-left">' + message + '</li>');
            messages[0].scrollTop = messages[0].scrollHeight;
            
            if (chat.clients[user_id] == undefined || chat.clients[user_id] == null)
            {
                chat.clients[user_id] = new chat_client(chat_ui.attr('user-session'), user_id, chat.from);
            }
            chat.clients[user_id].chat(message);
        }
    },
    close: function(event)
    {
        $(this).closest('.chat').remove();
    },
    sent: function(chat_ui, response)
    {
    }
};

$(document).ready(function()
{
    chat.init();
});