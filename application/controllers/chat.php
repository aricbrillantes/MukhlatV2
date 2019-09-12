<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//use OpenTok\OpenTok;

class Chat extends MY_Controller
{

    function __construct($error = false)
    {
        parent::__construct($error);
        $this->load->model('users_model', 'users');
//        $this->load->model('messages_model', 'messages');
    }
    
    function index()
    {
    }
    
    function online()
    {
        $this->users->update(array (
            'user_id' => $_SESSION['user']->user_id,
            'online' => 1
        ));
    }
    
    function offline()
    {
        $this->users->update(array (
            'user_id' => $_SESSION['user']->user_id,
            'online' => 0
        ));
    }
    
//    function token()
//    {
//        $this->openTok = new OpenTok(config_item('tokbox_api_key'), config_item('tokbox_api_secret'));
//        echo $this->openTok->generateToken($this->input->post('session_id'));
//        exit();
//    }
    
    function send()
    {
        if ($_SESSION['user']->role_id == 2)
        {
            $post = $this->input->post();
            $post['sender_id'] = $_SESSION['user']->user_id;
            $post['message'] = strip_tags($post['message']);
            $result = $this->messages->create($post);
        }
        else
        {
            $result = 0;
        }
        echo json_encode($result);
        exit();
    }
    
    function messages($recipient_id = 0, $offset = 0)
    {
        echo json_encode($this->messages->read(array(
            'sender_id' => $_SESSION['user']->user_id,
            'recipient_id' => $recipient_id,
            'limit' => 10,
            'offset' => $offset,
            'order_by' => 'message_id',
            'order' => 'desc'
        )));
        exit();
    }
    
    function online_list()
    {
        $user = $_SESSION['logged_user'];
//        $online_doctors = $this->users->read(array (
//            'role_id' => 2,
//            'online' => 1,
//            'deleted' => 0,
//            'order_by' => 'last_name,first_name'
//        ));
//
//        $offline_doctors = $this->users->read(array (
//            'role_id' => 2,
//            'online' => 0,
//            'deleted' => 0,
//            'order_by' => 'last_name,first_name'
//        ));
//        
//        if (!empty($offline_doctors))
//        {
//            foreach ($offline_doctors as $index => $offline_doctor)
//            {
//                if ($offline_doctor->user_id == $user->user_id)
//                {
//                    unset($offline_doctors[$index]);
//                    break;
//                }
//            }
//            $offline_doctors = array_values($offline_doctors);
//        }
//        
//        if (!empty($online_doctors))
//        {
//            foreach ($online_doctors as $index => $online_doctor)
//            {
//                if ($online_doctor->user_id == $user->user_id)
//                {
//                    unset($online_doctors[$index]);
//                    break;
//                }
//            }
//            $online_doctors = array_values($online_doctors);
//        }
//        
//        echo json_encode(array (
//            'online' => $online_doctors,
//            'offline' => $offline_doctors
//        ));
//        exit();
    }
}

/* End of file chat.php */
/* Location: ./application/controllers/chat.php */