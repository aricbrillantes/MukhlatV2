function chat_client(session_id, user_id, display_name)
{
    this.session_id = session_id;
    this.session = this.session_id.length > 0 ? TB.initSession(this.session_id) : null;
    this.user_id = user_id;
    this.display_name = display_name;
    this.connection = null;
    this.offset = 0;
    this.initial = true;
    
    this.init = function()
    {
        var single_chat;
        
        single_chat = $('.chat[user-id="' + this.user_id + '"]');
        if (single_chat.length == 0)
        {
            var single_chat_dialog, that;
            
            that = this;
            single_chat_dialog = chat_dialog.replace('{ Chat Name }', this.display_name);
            $('#chat-area').append(single_chat_dialog);
            $('#chat-area .chat:last-child').attr('user-id', this.user_id);
            $('#chat-area .chat:last-child').attr('user-session', this.session_id);
            chat.clean_up(event);        
            chat.init_dialog();            
            $.get('chat/messages/' + this.user_id + '/' + this.offset  + '/', function(response)
            {
                that.load_messages(that, response);
            });
        }
        this.show();
    };
    
    this.load_messages = function(chat_client_object, response)
    {    
        messages = JSON.parse(response);
        
        if (chat_client_object.initial && messages.length > 0)
        {
            messages.shift();
        }
        
        messages_list = $('.chat[user-id="' + chat_client_object.user_id + '"] .messages');
        messages_list.find('.divider').remove();
        messages_list.find('.load-more').remove();
        
        $.each(messages, function(index, item)
        {
            li_class = item.recipient_id == chat_client_object.user_id ? 'sender text-left' : 'recipient text-right';
            messages_list.prepend('<li class="' + li_class + '">' + item.message + '</li>');
            
            if (index == messages.length - 1 && (messages.length == 10 || messages.length == 9))
            {
                messages_list.prepend('<li class="divider"></li><a href="javascript:void(0);" class="load-more text-center">load more messages</a>');
                if (chat_client_object.offset == 0)
                {
                    messages_list[0].scrollTop = messages_list[0].scrollHeight;
                }
                
                messages_list.find('.load-more').click(function(event)
                {
                    chat_client_object.offset += messages.length;
                    $.get('chat/messages/' + chat_client_object.user_id + '/' + chat_client_object.offset  + '/', function(response)
                    {
                        chat_client_object.load_messages(chat_client_object, response);
                    });
                });
            }
        });
    };
    
    this.show = function()
    {
        $('.chat[user-id="' + this.user_id + '"]').addClass('open');
    };
    
    this.chat = function(message)
    {
        if (this.session_id.length > 0  && this.connection == null)
        {
            var that;
            
            that = this;
            $.post('chat/token/', {session_id: this.session_id}, function(token)
            {
                that.session.on('sessionConnected', function(event)
                {

                });
                that.session.on('connectionCreated', function(event)
                {
                    if (event.connection.connectionId != that.session.connection.connectionId)
                    {
                        that.connection = event.connection;
                        that.send_message(message);
                    }
                });
                that.session.on('connectionDestroyed', function(event)
                {
                    that.session.disconnect();
                    that.connection = null;
                });
                that.session.connect(opentok.apiKey, token);
            });
        }
        else
        {
            this.send_message(message);
        }
    };
    
    this.send_message = function(message)
    {
        that = this;
        $.post('chat/send/', {
            recipient_id: this.user_id,
            message: message
        }, function(response)
        {
            if (that.session_id.length > 0)
            {
                that.send_signal(message);
            }
        });
    };
    
    this.send_signal = function(message)
    {
        var data;
        
        data = {
            message: message,
            user_id: chat.user_id,
            from: chat.from,
            from_sesion: opentok.session_id
        };
        this.session.signal(
        {
            to: this.connection,
            data: JSON.stringify(data)
        },
        function(error)
        {
            if (error)
            {
                console.log('signal error (' + error.code + '): ' + error.reason);
            }
            else
            {
                console.log('signal sent.');
            }
        });
    };
    
    this.add_message = function(message)
    {
        var messages;
        
        messages = $('.chat[user-id="' + this.user_id + '"] .messages');
        if (messages.length > 0)
        {
            this.show();
            messages.append('<li class="recipient text-right">' + message + '</li>');
            messages[0].scrollTop = messages[0].scrollHeight;
        }
        else
        {
            this.init();
        }
    };
    
    this.init();
    
    return this;
}