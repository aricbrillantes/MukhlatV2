<?php

class Chat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('chat_model', 'chatmodel');
    }

    public function index() 
    {
        
        // if (!empty($logged_user)) 
        // {
            $logged_user = $_SESSION['logged_user'];
            
            $this->view_data['chat_id']= 1;
            
            
            //  echo "<script type='text/javascript'>alert('');</script>";

            $this->view_data['sender_id']= $logged_user->user_id;
            $this->load->view('chat/viewchat', $this->view_data);
            

            
        // }
        // else 
        // {
        //     //formerly $this->load->view('errors/html/error_general');
        //     $homeURL = base_url('');
        //     header("Location: $homeURL");
        //     die();
        // }
    }

    public function ajax_getChatMessages()
    {
        $logged_user = $_SESSION['logged_user'];
        $chat_id = $this->input->post('chat_id');

        
        $chat_messages = $this->chatmodel->get_chat_messages($chat_id);


        

        if($chat_messages->num_rows() >0)
        {
            

            // echo "<script type='text/javascript'>alert('if');</script>";
            $chat_messages_html = '<ul>';
            foreach($chat_messages->result() as $chat_msg)
            {
                $li_class = ($logged_user->user_id == $chat_msg->sender_id) ? 'class=by_current_user':'';
                $chat_messages_html .= '<li ' . $li_class .'>' . '<span class=chat_header>'. $chat_msg->chat_timestamp . ' by ' . $chat_msg->sender_name . '<p class=message_content>' . $chat_msg->chat_message ;
            }
           
            // echo '<script type="text/javascript">alert("message is '.$chat_messages_html.'");</script>';

            
            $str = json_encode($chat_messages_html);
            echo trim($str, '"'); 
            
        }
        else
        {
            // echo "<script type='text/javascript'>alert('else');</script>";
            
            $str = json_encode('');
            echo trim($str, '"'); 
            
        }
    }

    
    public function ajax_add_chat_message()
    {
        $chat_id = $this->input->post('chat_id');
        $sender_id = $this->input->post('sender_id');
        $chat_message = $this->input->post('chat_message', TRUE);

        $this->chatmodel->add_chat_message($chat_id,$sender_id,$chat_message);
    }

    public function ajax_getChats()
    {
        $sender_id = $this->input->post('sender_id');
        $chats=$this->chatmodel->get_chats($sender_id);
        if($chats->num_rows() >0)
        {

            // echo "<script type='text/javascript'>alert('if');</script>";
            $chats_html = '';
            foreach($chats->result() as $chat_instance)
            {
                $chats_html .= '<button class=chat_inst style=border:1pxsolidgray;width:100%;min-height:20%; value='.$chat_instance->chat_id.'>';
                $other_user = $this->chatmodel->get_other_user($chat_instance->chat_id, $sender_id);
                foreach($other_user->result() as $other_user_instance)
                {
                    $other_user_name = $this->chatmodel->get_name($other_user_instance->other_user);
                    foreach($other_user_name->result() as $other_user_name_instance)
                    {
                        $chats_html .= '<h2>' . $other_user_name_instance->name ;
                        
                        
                        // $chats_html .= '<div id="chat_inst" style="border: 1px solid gray;">';
                    }
                }
                
            }
            
           
            // echo '<script type="text/javascript">alert("message is '.$chat_messages_html.'");</script>';
            
            $str = json_encode($chats_html);
            echo trim($str, '"'); 
            
        }
        else
        {
            // echo "<script type='text/javascript'>alert('else');</script>";
            
            $str = json_encode('"');
            echo trim($str, '"'); 
            
        }

    }

    public function change_chat($chat_id)
    {
        $this->view_data['chat_id']= $chat_id;
        $this->load->view('chat/viewchat', $this->view_data);
    }

    

}