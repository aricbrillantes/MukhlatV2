<?php

class Chat_model extends CI_Model{
    function __constructor(){
        parent::__construct();
    }

    function add_chat_message($chat_id, $sender_id, $chat_message){
        $query_str = "INSERT INTO tbl_chatmsgs ( chat_id, sender_id, chat_message) VALUES (?,?,?)";
        $this->db->query($query_str, array($chat_id, $sender_id, $chat_message));

        // $insert_msg = array("chat_id" => $chat_id,
        //         "sender_id" => $sender_id,
        //         "chat_message" => $chat_message);
        //     $this->db->insert("tbl_chatmsgs", $insert_msg);
    }

    function get_chat_messages($chat_id)
    {
        $query_str = "SELECT
                    cm.sender_id,
                    cm.chat_message_content,
                    DATE_FORMAT(cm.create_date, '%D of %M %Y at %H:%i:%s') AS chat_timestamp,
                    CONCAT(u.first_name, u.last_name) AS sender_name
                    FROM tbl_chatmsgs cm
                    JOIN tbl_users u ON cm.sender_id = u.user_id
                    WHERE cm.chat_id = ?";
    }
}