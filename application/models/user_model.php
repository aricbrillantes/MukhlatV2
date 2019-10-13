<?php

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_users() {
        $query = $this->db->get('tbl_users');
        return $query->result();
    }

    public function get_ordinary_users() {
        $query = $this->db->select('user_id, first_name, last_name, profile_url')
                ->from('tbl_users')
                ->where('role_id = 2');
        return $query->get()->result();
    }

    public function get_user($load_topics, $load_activities, $fields = array()) {
        $query = $this->db->get_where('tbl_users', $fields);

        $user = $query->row();

        if ($user) {
            if ($load_topics) {
                $this->load->model('topic_model', 'topics');
                $user->topics = $this->topics->get_user_topics($user->user_id);
                $user->followed_topics = $this->topics->get_followed_topics($user->user_id);
                $user->moderated_topics = $this->topics->get_moderated_topics($user->user_id);
            }

            if ($load_activities) {
                $logged_user = $_SESSION['logged_user'];
                $this->load->model('post_model', 'posts');
                $user->activities = $this->posts->get_user_activities($user->user_id, $logged_user->user_id);

                $user->post_count = $this->posts->get_post_count($user->user_id);
                $user->vote_points = $this->posts->get_vote_points($user->user_id);
            }
        }
        return $user;
    }

    public function isParent($parent_id,$child_id) 
    {
       $query = $this->db->select('user_id')
                ->from('tbl_users')
                ->where('user_id', $child_id)
                ->where('parent', $parent_id);

        $query = $this->db->get();
        
        // echo print_r($query->result());

        if($query->num_rows() < 1)
            return 999;

        else return 1;
        
    }

    //function for getting parents' children's data
    public function view_child($parent_id) 
    {
        // echo $parent_id . "<br>";
        
        $query = $this->db->select('user_id, first_name, last_name, parent, email, description')
                ->from('tbl_users')
                ->where('parent', $parent_id);

        $query = $this->db->get();
        // echo print_r($query->result());

        return $query;
    }

    //function for getting specific child's data
    public function view_specific_child($user_id) 
    {        
        $query = $this->db->select('user_id, first_name, last_name, parent, email, description')
                ->from('tbl_users')
                ->where('user_id', $user_id);

        $query = $this->db->get();
        
        // echo print_r($query->result());
        return $query;
    }

    public function get_usertimes($user_id) 
    {

        $this->db->select('user_id, time_setting, warning, keep, use_limit');
        $this->db->from('tbl_usertimes');
        $this->db->where(array('tbl_usertimes.user_id' => $user_id));
        
        $query = $this->db->get();
        
        // echo print_r($query->result());

        if(!empty($query->result()))
        {
            return $query;
        }    

        else
        {
            $settings = 'cell15-A cell16-A cell17-A cell18-A cell19-A cell20-A cell21-A cell22-A cell23-A cell24-A cell25-A cell26-A cell27-A cell28-A cell29-A cell30-A cell31-A cell32-A cell33-A cell34-A cell35-A cell36-A cell37-A cell38-A cell39-A cell40-A cell41-A cell42-A cell43-A cell44-A cell45-A cell46-A cell47-A cell48-A cell49-A cell50-A cell51-A cell52-A cell53-A cell54-A cell55-A cell56-A cell57-A cell58-A cell59-A cell60-A cell61-A cell62-A cell63-A cell64-A cell65-A cell66-A cell67-A cell68-A cell69-A cell70-A cell71-A cell72-A cell73-A cell74-A cell75-A cell76-A cell77-A cell78-A cell79-A cell80-A cell81-A cell82-A cell83-A cell84-A cell85-A cell86-A cell87-A cell88-A cell89-A cell90-A cell91-A cell92-A cell93-A cell94-A cell95-A cell96-A cell97-A cell98-A';
            $warning = '30';
            $keep = '1';
            $limit = '180';

            $data = array
            (
                'user_id' => $user_id,
                'time_setting'=> $settings,
                'warning' => $warning,
                'keep' => $keep,
                'use_limit' => $limit
            );

            $this->db->insert('tbl_usertimes',$data);   
            header("Refresh:0");
        }
    }

    public function set_usertimes($user_id) 
    {        
        
        $this->db->delete('tbl_usertimes', array('user_id' => $user_id));

        $settings = htmlspecialchars($_COOKIE["timeSetting"]);
        $warning = htmlspecialchars($_COOKIE["selectedWarning"]);
        $keep = htmlspecialchars($_COOKIE["selectedKeep"]);
        $limit = htmlspecialchars($_COOKIE["selectedLimit"]);

        $data = array
        (
            'user_id' => $user_id,
            'time_setting'=> $settings,
            'warning' => $warning,
            'keep' => $keep,
            'use_limit' => $limit
        );

        $this->db->insert('tbl_usertimes',$data);   
        header("Refresh:0");
    }

    public function get_child_records($user_id) 
    {
        $this->load->model('topic_model', 'topics');
        $this->load->model('post_model', 'posts');
        $this->load->model('record_model', 'records');
        $record = new stdClass();

        // number of topics 
        $record->topic_count = $this->topics->get_topic_count($user_id);

       // number of topics followed
        $record->followed_topic_count = $this->topics->get_followed_topic_count($user_id);

       // number of topics moderated
        $record->moderated_topic_count = $this->topics->get_moderated_topic_count($user_id);

        //  number of posts 
        $record->post_count = $this->posts->get_root_post_count($user_id);

        // points 
        $record->points = $this->posts->get_vote_points($user_id);

        // number of upvotes given 
        $record->upvote_count = $this->posts->get_vote_type_count($user_id, 1);

        // number of downvotes given 
        $record->downvote_count = $this->posts->get_vote_type_count($user_id, -1);

       // number of replies 
        $record->reply_count = $this->posts->get_reply_count($user_id);

        //upvotes
        $record->upvotes = $this->records->get_user_upvotes($user_id);

        //downvotes
        $record->downvotes = $this->records->get_user_downvotes($user_id);

        //posts started
        $record->post_start = $this->records->get_post_start($user_id);

        //posts published
        $record->post_published = $this->records->get_post_published($user_id);

        //replies
        $record->replies = $this->records->get_user_replies($user_id);
        return $record;
    }



    public function get_topic_users($topic_id) {
        $users = $this->db->query('SELECT result.user_id, result.first_name, result.last_name, result.profile_url FROM (select u.user_id, '
                        . 'u.first_name, u.last_name, u.profile_url from tbl_posts p '
                        . 'join tbl_users u on p.user_id = u.user_id '
                        . 'where p.topic_id = ' . $topic_id . ' UNION ALL select u.user_id, '
                        . 'u.first_name, u.last_name, u.profile_url from tbl_post_vote pv '
                        . 'join tbl_users u on pv.user_id = u.user_id join tbl_posts p on p.post_id '
                        . '= pv.post_id where p.topic_id = ' . $topic_id . ' ) result '
                        . 'group by result.user_id;')->result();
        
        return $users;
    }

    public function get_topic_followers($topic_id) {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->join('tbl_topic_follower', 'tbl_topic_follower.user_id = tbl_users.user_id');
        $this->db->where(array('tbl_topic_follower.topic_id' => $topic_id));
        $query = $this->db->order_by('tbl_users.first_name', 'ASC')->get();

        return $query->result();
    }

    public function get_topic_moderators($topic_id) {
        $this->db->select('*');
        $this->db->from('tbl_users u');
        $this->db->join('tbl_topic_moderator tm', 'tm.user_id = u.user_id');
        $this->db->where(array('tm.topic_id' => $topic_id));
        $query = $this->db->order_by('u.first_name', 'ASC')->get();

        return $query->result();
    }

    public function toggle_account($user_id) {
        $this->db->set("is_enabled", "1 - is_enabled", FALSE);
        $this->db->where("user_id", $user_id);
        $this->db->update("tbl_users");
    }

    public function search_users($keyword, $get_admin) {
        $this->db->where("CONCAT(first_name, ' ', last_name) LIKE '%" . $keyword . "%'", NULL, FALSE);
        if (!$get_admin) {
            $this->db->where("role_id = ", 2);
            $this->db->where("is_enabled", true);
        }
        $users = $this->db->get("tbl_users")->result();

        return $users;
    }

    public function get_nonfollowers($topic_id) {
        //subquery
        $this->db->select("tf.user_id")
                ->from("tbl_topic_follower tf")
                ->join("tbl_topics t", "tf.topic_id = t.topic_id")
                ->where("tf.topic_id = ", $topic_id);
        $subjoin = $this->db->get_compiled_select();

        //main
        $this->db->select("u.user_id, u.first_name, u.last_name, u.profile_url")
                ->from("tbl_users u")
                ->join("($subjoin) sub", "u.user_id = sub.user_id", "left outer")
                ->where("sub.user_id is null")
                ->where("u.is_enabled = ", true)
                ->where("u.role_id = ", 2);

        $non_followers = $this->db->get()->result();
        return $non_followers;
    }

    public function get_nonmoderators($topic_id) {
        //subquery
        $this->db->select("tm.user_id")
                ->from("tbl_topic_moderator tm")
                ->join("tbl_topics t", "tm.topic_id = t.topic_id")
                ->where("tm.topic_id = ", $topic_id);
        $subjoin = $this->db->get_compiled_select();

        //main
        $this->db->select("u.user_id, u.first_name, u.last_name, u.profile_url")
                ->from("tbl_users u")
                ->join("($subjoin) sub", "u.user_id = sub.user_id", "left outer")
                ->where("sub.user_id is null")
                ->where("u.is_enabled = ", true)
                ->where("u.role_id = ", 2);

        $non_moderators = $this->db->get()->result();
        return $non_moderators;
    }

    public function update_profile($user_id, $data) {
        $this->db->where('user_id = ', $user_id);
        $this->db->update('tbl_users', $data);
    }

    public function get_user_records($user_id) {
        $this->load->model('topic_model', 'topics');
        $this->load->model('post_model', 'posts');
        $this->load->model('record_model', 'records');
        $record = new stdClass();
//        number of topics /
        $record->topic_count = $this->topics->get_topic_count($user_id);

//        number of topics followed
        $record->followed_topic_count = $this->topics->get_followed_topic_count($user_id);

//        number of topics moderated
        $record->moderated_topic_count = $this->topics->get_moderated_topic_count($user_id);

        //        number of posts /
        $record->post_count = $this->posts->get_root_post_count($user_id);

//                points /
        $record->points = $this->posts->get_vote_points($user_id);

//                number of upvotes given /
        $record->upvote_count = $this->posts->get_vote_type_count($user_id, 1);

//                number of downvotes given /
        $record->downvote_count = $this->posts->get_vote_type_count($user_id, -1);

//        number of replies / 
        $record->reply_count = $this->posts->get_reply_count($user_id);

        //upvotes
        $record->upvotes = $this->records->get_user_upvotes($user_id);

        //downvotes
        $record->downvotes = $this->records->get_user_downvotes($user_id);

        //posts started
        $record->post_start = $this->records->get_post_start($user_id);

        //posts published
        $record->post_published = $this->records->get_post_published($user_id);

        //replies
        $record->replies = $this->records->get_user_replies($user_id);
        return $record;
    }

}
