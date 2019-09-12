<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of topic_model
 *
 * @author Arces
 */
class Topic_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    public function get_topics(){
        $query = $this->db->get('tbl_topics');
        
        return $query->result();
    }
    
    public function get_topic($load_posts, $id) {
        $topic = $this->db->get_where('tbl_topics', array('topic_id' => $id))->row();

        if ($load_posts) {
            //get posts
            $this->load->model('post_model', 'posts');
            $topic->posts = $this->posts->get_topic_posts($topic->topic_id);

            $this->load->model('user_model', 'users');
            $topic->followers = $this->users->get_topic_followers($topic->topic_id);
            $topic->moderators = $this->users->get_topic_moderators($topic->topic_id);

            $topic->nonfollowers = $this->users->get_nonfollowers($topic->topic_id);
            $topic->nonmoderators = $this->users->get_nonmoderators($topic->topic_id);
        }

        $this->load->model('user_model', 'users');
        $topic->user = $this->users->get_user(false, false, array('user_id' => $topic->creator_id));
        return $topic;
    }

    public function get_user_topics($user_id) {
        $topics = $this->db->order_by('topic_name', 'ASC')->get_where('tbl_topics', array('creator_id' => $user_id, 'is_cancelled' => 0))->result();

        $this->load->model('user_model', 'users');

        foreach ($topics as $topic) {
            $topic->followers = $this->users->get_topic_followers($topic->topic_id);
        }

        return $topics;
    }

    public function get_followed_topics($user_id) {
        $this->db->select('*');
        $this->db->from('tbl_topics');
        $this->db->join('tbl_topic_follower', 'tbl_topic_follower.topic_id = tbl_topics.topic_id');
        $this->db->where(array('tbl_topic_follower.user_id' => $user_id, 'tbl_topics.is_cancelled' => 0));
        $topics = $this->db->order_by('tbl_topics.topic_name', 'ASC')->get()->result();

        $this->load->model('user_model', 'users');

        foreach ($topics as $topic) {
            $topic->followers = $this->users->get_topic_followers($topic->topic_id);
        }

        return $topics;
    }

    public function get_moderated_topics($user_id) {
        $this->db->select('*');
        $this->db->from('tbl_topics t');
        $this->db->join('tbl_topic_moderator tm', 'tm.topic_id = t.topic_id');
        $this->db->where(array('tm.user_id' => $user_id, 't.is_cancelled' => 0));
        $topics = $this->db->order_by('t.topic_name', 'ASC')->get()->result();

        $this->load->model('user_model', 'users');

        foreach ($topics as $topic) {
            $topic->followers = $this->users->get_topic_followers($topic->topic_id);
        }

        return $topics;
    }

    public function check_follow($topic_id, $user_id) {
        $is_followed = $this->db->get_where('tbl_topic_follower', array('topic_id' => $topic_id, 'user_id' => $user_id))->row();

        return $is_followed;
    }

    public function check_moderated($topic_id, $user_id) {
        $is_moderated = $this->db->get_where('tbl_topic_moderator', array('topic_id' => $topic_id, 'user_id' => $user_id))->row();

        return $is_moderated;
    }

    public function search_topics($keyword, $sort_type) {
        switch ($sort_type) {
            case 0: $this->db->like("topic_name", $keyword, "both");
                $this->db->where("is_cancelled = 0");
                $topics = $this->db->get("tbl_topics")->result();
                break;
            case 1: $this->db->select("*");
                $this->db->from("tbl_topics");
                $this->db->like("topic_name", $keyword, "both");
                $this->db->where("is_cancelled = 0");
                $this->db->order_by('date_created', 'desc');
                $topics = $this->db->get()->result();
                break;
            case 2: $this->db->select("t.topic_id, t.topic_name, t.creator_id, IFNULL(COUNT(*), 0) AS follower_count");
                $this->db->from("tbl_topics t")->join("tbl_topic_follower tf", "t.topic_id = tf.topic_id", "left");
                $this->db->like("topic_name", $keyword, "both");
                $this->db->where("is_cancelled = 0");
                $this->db->group_by('t.topic_id');
                $this->db->order_by('follower_count', 'desc');
                $topics = $this->db->get()->result();
                break;
            case 3: $this->db->select("t.topic_id, t.topic_name, t.creator_id, IFNULL(COUNT(*), 0) AS post_count");
                $this->db->from("tbl_topics t")->join("tbl_posts p", "t.topic_id = p.topic_id", "left");
                $this->db->like("topic_name", $keyword, "both");
                $this->db->where("is_cancelled = 0");
                $this->db->group_by('t.topic_id');
                $this->db->order_by('post_count', 'desc');
                $topics = $this->db->get()->result();
                break;
        }
        
        $this->load->model("user_model", "users");
        $this->load->model("post_model", "posts");
        foreach ($topics as $topic) {
            $topic->user = $this->users->get_user(false, false, array('user_id' => $topic->creator_id));
            $topic->followers = $this->users->get_topic_followers($topic->topic_id);
            $topic->post_count = $this->posts->get_topic_post_count($topic->topic_id);
        }
        
        return $topics;
    }

    public function update_topic($topic_id, $data = array()) {
        $this->db->where('topic_id', $topic_id);
        $this->db->update('tbl_topics', $data);
    }

    public function remove_member($user_id, $topic_id, $type) {
        if ($type === 1) {
            $this->db->delete('tbl_topic_follower', array('user_id' => $user_id, 'topic_id' => $topic_id));
        } else if ($type === 2) {
            $this->db->delete('tbl_topic_moderator', array('user_id' => $user_id, 'topic_id' => $topic_id));
        } else if ($type === 3) {
            $this->update_topic($topic_id, array('is_cancelled' => 1));
        }
    }

    public function get_topic_count($user_id) {
        $this->db->select('COUNT(*) as topic_count');
        $this->db->from('tbl_topics');
        $this->db->where('creator_id = ', $user_id);

        $count = $this->db->get()->row();

        if ($count) {
            return $count->topic_count;
        } else {
            return 0;
        }
    }

    public function get_followed_topic_count($user_id) {
        $this->db->select('COUNT(*) as topic_count');
        $this->db->from('tbl_topic_follower');
        $this->db->where('user_id = ', $user_id);

        $count = $this->db->get()->row();

        if ($count) {
            return $count->topic_count;
        } else {
            return 0;
        }
    }

    public function get_moderated_topic_count($user_id) {
        $this->db->select('COUNT(*) as topic_count');
        $this->db->from('tbl_topic_moderator');
        $this->db->where('user_id = ', $user_id);

        $count = $this->db->get()->row();

        if ($count) {
            return $count->topic_count;
        } else {
            return 0;
        }
    }

    public function update_user_topics($user) {
        $user->topics = $this->get_user_topics($user->user_id);
        $user->followed_topics = $this->get_followed_topics($user->user_id);
        $user->moderated_topics = $this->get_moderated_topics($user->user_id);
    }

}
