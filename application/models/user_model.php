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
        
        $query = $this->db->select('user_id, first_name, last_name, parent, email, description, is_enabled, role_id')
                ->from('tbl_users')
                ->where('parent', $parent_id);

        $query = $this->db->get();
        // echo print_r($query->result());

        return $query;
    }

    //function for getting specific child's data
    public function view_specific_child($user_id) 
    {        
        $query = $this->db->select('user_id, first_name, last_name, parent, email, description, is_enabled, role_id')
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
            $settings = 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A';
           
            $warning = '30';
            $keep = '1';
            $limit = '120';

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
