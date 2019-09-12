<?php

class Post_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_topic_posts($topic_id) {
        $user = $_SESSION['logged_user'];
        $query = $this->db->order_by('date_posted', 'DESC')->get_where('tbl_posts', array('topic_id' => $topic_id, 'parent_id' => 0));
        $posts = $query->result();

        //load user of post
        $this->load->model('user_model', 'users');

        foreach ($posts as $post) {
            $post->user = $this->users->get_user(false, false, array('user_id' => $post->user_id));
            $post->vote_count = $this->get_vote_count($post->post_id);
            $post->vote_type = $this->get_vote_type($post->post_id, $user->user_id);
        }

        return $posts;
    }

    public function get_post($get_descendants, $get_votes, $get_attachments, $post_id) {
        $post = $this->db->get_where('tbl_posts', array('post_id' => $post_id))->row();

        //load user of post
        $this->load->model('user_model', 'users');
        $post->user = $this->users->get_user(false, false, array('user_id' => $post->user_id));

        //load topic of post
        $this->load->model('topic_model', 'topics');
        $post->topic = $this->topics->get_topic(false, $post->topic_id);

        if ($get_votes) {
            //get votes of post
            $post->vote_count = $this->get_vote_count($post->post_id);

            $user = $_SESSION['logged_user'];
            $post->vote_type = $this->get_vote_type($post->post_id, $user->user_id);
        }

        if ($get_descendants) {
            //get replies of post
            $post->replies = $this->get_replies($post->post_id);
        }

        if ($get_attachments) {
            $this->load->model('attachment_model', 'attachments');
            $post->attachments = $this->attachments->get_post_attachments($post->post_id);

            if ($post->post_id === $post->root_id) {
                $post->thread_attachments = $this->attachments->get_thread_attachments($post->post_id);
            }
        }
        return $post;
    }

    public function get_user_activities($user_id, $logged_user_id) {
        $this->db->select('p.post_id, p.post_title, p.post_content, p.date_posted, p.root_id, p.parent_id, t.topic_id, t.topic_name, u1.user_id, '
                . 'u1.first_name, u1.last_name, u1.profile_url');
        $this->db->from('tbl_posts as p');
        $this->db->join('tbl_users as u1', 'p.user_id = u1.user_id');
        $this->db->join('tbl_topics as t', 'p.topic_id = t.topic_id');
        $this->db->join('tbl_topic_follower as tf', 'tf.topic_id = t.topic_id');
        $this->db->join('tbl_users as u2', 'tf.user_id = u2.user_id');
        $this->db->where('u1.user_id =', $user_id);
        $this->db->where('u2.user_id =', $logged_user_id);
        $this->db->where('t.is_cancelled =', '0');
        $this->db->order_by('p.date_posted', 'DESC');

        $user_activities = $this->db->get()->result();

        foreach ($user_activities as $post) {
            if ($post->parent_id !== '0') {
                $post->parent = $this->get_post(false, true, false, $post->parent_id);
            }

            $post->vote_count = $this->get_vote_count($post->post_id);
            $post->vote_type = $this->get_vote_type($post->post_id, $logged_user_id);
        }

        return $user_activities;
    }

    public function get_home_posts($user_id) {
        $this->db->select('p.post_id, p.post_title, p.post_content, p.date_posted, t.topic_id, t.topic_name, u1.user_id, u1.first_name, u1.last_name, u1.profile_url, u1.is_enabled');
        $this->db->from('tbl_posts as p');
        $this->db->join('tbl_users as u1', 'p.user_id = u1.user_id');
        $this->db->join('tbl_topics as t', 'p.topic_id = t.topic_id');
        $this->db->join('tbl_topic_follower as tf', 'tf.topic_id = t.topic_id');
        $this->db->join('tbl_users as u2', 'tf.user_id = u2.user_id');
        $this->db->where('u2.user_id =', $user_id);
        $this->db->where('p.parent_id =', '0');
        $this->db->where('t.is_cancelled =', '0');
        $this->db->order_by('p.date_posted', 'DESC');

        $home_posts = $this->db->get()->result();

        foreach ($home_posts as $post) {
            $post->vote_count = $this->get_vote_count($post->post_id);
            $post->vote_type = $this->get_vote_type($post->post_id, $user_id);
        }

        return $home_posts;
    }

    public function get_vote_count($post_id) {
        $this->db->select('SUM(vote_type) as vote_count', FALSE);
        $this->db->where("post_id = ", $post_id);
        $vote_count = $this->db->get("tbl_post_vote")->row()->vote_count;
        return $vote_count;
    }

    public function get_vote_type($post_id, $user_id) {
        $query = $this->db->get_where('tbl_post_vote', array('post_id' => $post_id, 'user_id' => $user_id))->row();

        if ($query) {
            return $query->vote_type;
        } else {
            return null;
        }
    }

    public function remove_vote($post_id, $user_id) {
        $this->db->where(array('post_id' => $post_id, 'user_id' => $user_id));
        $this->db->delete('tbl_post_vote');
    }

    public function vote_post($user_id, $post_id, $vote_type) {
        //delete existing votes of user to post
        $this->db->delete('tbl_post_vote', array('post_id' => $post_id, 'user_id' => $user_id));

        //add new vote of user to post
        $data = array('post_id' => $post_id,
            'user_id' => $user_id,
            'vote_type' => $vote_type);
        $this->db->insert('tbl_post_vote', $data);
    }

    public function get_replies($post_id) {
        $replies = $this->db->get_where("tbl_posts", array('parent_id' => $post_id))->result();

        if ($replies) {
            //load user of post
            $this->load->model('user_model', 'users');
            $this->load->model('attachment_model', 'attachments');

            //load attachments of post
            foreach ($replies as $reply) {
                $reply->user = $this->users->get_user(false, false, array('user_id' => $reply->user_id));
                $reply->vote_count = $this->get_vote_count($reply->post_id);
                $reply->vote_type = $this->get_vote_type($reply->post_id, $reply->user_id);
                $reply->attachments = $this->attachments->get_post_attachments($reply->post_id);

                $reply->replies = $this->get_replies($reply->post_id);
            }
        }
        return $replies;
    }

    public function update_post($post_id, $data = array()) {
        $this->db->where('post_id', $post_id);
        $this->db->update('tbl_posts', $data);
    }

    /* REPORTS */

    public function get_topic_post_count($topic_id) {
        $this->db->select('COUNT(*) as post_count');
        $this->db->from('tbl_posts');
        $this->db->where(array('topic_id' => $topic_id, 'is_deleted' => '0'));
        $this->db->group_by('topic_id');
        
        $count = $this->db->get()->row();
        if ($count) {
            return $count->post_count;
        } else {
            return 0;
        }
    }

    public function get_post_count($user_id) {
        $this->db->select('COUNT(*) as post_count');
        $this->db->from('tbl_posts');
        $this->db->where(array('user_id' => $user_id, 'is_deleted' => '0'));

        $count = $this->db->get()->row();

        if ($count) {
            return $count->post_count;
        } else {
            return 0;
        }
    }

    public function get_root_post_count($user_id) {
        $this->db->select('COUNT(*) as post_count');
        $this->db->from('tbl_posts');
        $this->db->where('user_id = ', $user_id);
        $this->db->where('post_id = root_id');
        $this->db->where('is_deleted = 0');

        $count = $this->db->get()->row();

        if ($count) {
            return $count->post_count;
        } else {
            return 0;
        }
    }

    public function get_reply_count($user_id) {
        $this->db->select('COUNT(*) as post_count');
        $this->db->from('tbl_posts');
        $this->db->where('user_id = ', $user_id);
        $this->db->where('post_id != root_id');

        $count = $this->db->get()->row();

        if ($count) {
            return $count->post_count;
        } else {
            return 0;
        }
    }

    public function get_vote_points($user_id) {
        $this->db->select('SUM(pv.vote_type) as vote_points');
        $this->db->from('tbl_post_vote as pv');
        $this->db->join('tbl_posts as p', 'p.post_id = pv.post_id');
        $this->db->where('p.user_id = ', $user_id);

        $count = $this->db->get()->row();

        if ($count->vote_points > 0) {
            return $count->vote_points;
        } else {
            return 0;
        }
    }

    public function get_vote_type_count($user_id, $type) {
        $this->db->select('COUNT(*) as vote_count');
        $this->db->from('tbl_post_vote');
        $this->db->where('user_id = ', $user_id);
        $this->db->where('vote_type = ', $type);

        $count = $this->db->get()->row();

        if ($count) {
            return $count->vote_count;
        } else {
            return 0;
        }
    }

}
