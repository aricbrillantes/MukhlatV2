<?php

class Chat_model extends CI_Model{
    
    public function add_chat_message($chat_id, $sender_id, $chat_message) {
        if($chat_message != "")
        {
            $query_str = "INSERT INTO tbl_chatmsgs ( chat_id, sender_id, chat_message) VALUES (?,?,?)";
            $this->db->query($query_str, array($chat_id, $sender_id, $chat_message));
        }

    }

    public function get_chat_messages($chat_id) {
        $query_str = "SELECT
                    cm.sender_id,
                    cm.chat_message,
                    DATE_FORMAT(cm.create_date, '%m/%d/%Y @ %h:%i %p') AS chat_timestamp,
                    CONCAT(u.first_name,' ', u.last_name) AS sender_name
                    FROM tbl_chatmsgs cm
                    JOIN tbl_users u ON cm.sender_id = u.user_id
                    WHERE cm.chat_id = ?";
                    
        
        $result = $this->db->query($query_str,$chat_id);
        
        
        return $result;

        // $this->db->select("cm.sender_id, cm.chat_message, DATE_FORMAT(cm.create_date, '%m/%d/%Y @ %h:%i %p') as chat_timestamp, CONCAT(u.first_name, ' ' , u.last_name) as sender_name");
        // $this->db->from("tbl_chatmsgs as cm");
        // $this->db->join("tbl_users as u", "cm.sender_id = u.user_id");
        // $this->db->where("cm.chat_id =", $chat_id);


        // $result = $this->db->get()->result();
        
        // return $result;

    }

    public function get_chats($user_id)
    {
        $user_idcopy = $user_id;
        // echo '<script type="text/javascript">alert("user is '.$user_id.'");</script>';
        $query_str = "SELECT chat_id FROM tbl_chats WHERE user_1 = ? OR user_2 = ?";
        $result =  $this->db->query($query_str,  array($user_id,$user_idcopy));
        return $result;
        

        // $this->db->select("chat_id");
        // $this->db->from("tbl_chats");
        // $this->db->where("user_1 =", $user_id, "OR user_2 =", $user_id);
        // $result = $this->db->get()->result();
        
        // return $result;
    }

    public function get_other_user($chat_id, $user_id)
    {
        // echo '<script type="text/javascript">alert("user is '.$user_id.' and chat id is '.$chat_id.'");</script>';
        $query_str = "SELECT  
        CASE user_1
           WHEN ? THEN user_2
           ELSE user_1
        END AS other_user
        FROM tbl_chats
        WHERE chat_id = ?";
        $result =  $this->db->query($query_str, array($user_id,$chat_id));
        return $result;

    }

    public function get_name($user_id)
    {
        $query_str="SELECT CONCAT(first_name, ' ', last_name) AS name
        FROM tbl_users
        WHERE user_id = ?";
        

        $result =  $this->db->query($query_str, $user_id);
        
        return $result;
    }

    
}