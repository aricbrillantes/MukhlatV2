<?php

class Chat extends CI_Controller
{
    public function __constructor()
    {
        parent::__construct();
        
       
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

    
    
    public function ajax_add_chat_message()
    {
        $this->load->model('chat_model','chatmodel');
        $chat_id = $this->input->post('chat_id');
        $sender_id = $this->input->post('sender_id');
        $chat_message = $this->input->post('chat_message', TRUE);

        $this->chatmodel->add_chat_message($chat_id,$sender_id,$chat_message);
    }


}