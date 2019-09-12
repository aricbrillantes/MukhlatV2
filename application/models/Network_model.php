<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Network_model
 *
 * @author Arces
 */
class Network_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_general_network() {
        $this->load->model('user_model', 'users');

        $users = $this->users->get_ordinary_users();
        foreach ($users as $user) {
            //get user connections
            $user->user_map = $this->db->query('SELECT result.user_id FROM (select u.user_id from tbl_posts p ' .
                            'join tbl_post_vote pv on p.post_id = pv.post_id ' .
                            'join tbl_users u on u.user_id = p.user_id where pv.user_id = ' . $user->user_id .
                            ' UNION ALL select u.user_id from tbl_posts p1 '
                            . 'join tbl_posts p2 on p2.parent_id = p1.post_id ' .
                            'join tbl_users u on p1.user_id = u.user_id where p2.user_id = ' . $user->user_id . ') result ' .
                            'group by result.user_id;')->result();

            //get topic connections
            $user->topic_map = $this->db->query('SELECT result.topic_id FROM (select t.topic_id from tbl_posts p ' .
                            'join tbl_topics t on p.topic_id = t.topic_id ' .
                            'where p.user_id = ' . $user->user_id . ' UNION ALL select t.topic_id from tbl_post_vote pv ' .
                            'join tbl_posts p on pv.post_id = p.post_id join tbl_topics t on t.topic_id ' .
                            '= p.topic_id where pv.user_id = ' . $user->user_id .
//                            . ' UNION ALL select ' .
//                            'topic_id from tbl_topics where creator_id = ' . $user->user_id . ' UNION ALL select ' .
//                            'topic_id from tbl_topic_follower where user_id = ' . $user->user_id . ' UNION ALL select ' .
//                            'topic_id from tbl_topic_moderator where user_id = ' . $user->user_id . 
                            ' ) result ' .
                            'group by result.topic_id;')->result();
        }

        return $users;
    }

    public function get_user_network($user_id) {
        $this->load->model('user_model', 'users');

        $user = $this->users->get_user(false, false, array('user_id' => $user_id));

        //get user replies
        $user->total_reply = $this->db->query("select count(*) as 'total_reply' from tbl_posts " .
                        'where post_id != root_id AND user_id = ' . $user_id)->row();

        $user->reply_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'reply_count' from tbl_posts p1 join " .
                        'tbl_posts p2 on p1.parent_id = p2.post_id join tbl_users u on p2.user_id = u.user_id ' .
                        'where p1.user_id = ' . $user_id . ' group by u.user_id;')->result();

        //get user downvotes
        $user->total_downvote = $this->db->query("select count(*) as 'total_downvote' from tbl_post_vote " .
                        'where user_id = ' . $user_id . ' AND vote_type = -1')->row();
        $user->downvote_user_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'downvote_count' from tbl_post_vote pv " .
                        'join tbl_posts p on pv.post_id = p.post_id ' .
                        'join tbl_users u on p.user_id = u.user_id ' .
                        'where pv.user_id = ' . $user_id . ' and vote_type = -1 ' .
                        'group by p.user_id')->result();

        //get user upvotes
        $user->total_upvote = $this->db->query("select count(*) as 'total_upvote' from tbl_post_vote " .
                        'where user_id = ' . $user_id . ' AND vote_type = 1')->row();

        $user->upvote_user_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'upvote_count' from tbl_post_vote pv " .
                        'join tbl_posts p on pv.post_id = p.post_id ' .
                        'join tbl_users u on p.user_id = u.user_id ' .
                        'where pv.user_id = ' . $user_id . ' and vote_type = 1 ' .
                        'group by p.user_id')->result();

        //get posts of users to topic
        $user->total_post = $this->db->query("select count(*) as 'total_post' from tbl_posts " .
                        'where user_id = ' . $user_id)->row();

        $user->post_map = $this->db->query("select t.topic_id, t.topic_name, count(*) as 'post_count' from tbl_posts p " .
                        'join tbl_topics t on p.topic_id = t.topic_id ' .
                        'where p.user_id = ' . $user_id . ' group by t.topic_id')->result();

        $user->downvote_topic_map = $this->db->query("select t.topic_id, t.topic_name, count(*) as 'downvote_count' from tbl_post_vote pv " .
                        'join tbl_posts p on pv.post_id = p.post_id join tbl_topics t on p.topic_id = t.topic_id ' .
                        'where pv.user_id = ' . $user_id . ' AND pv.vote_type = -1 ' .
                        'group by t.topic_id')->result();

        $user->upvote_topic_map = $this->db->query("select t.topic_id, t.topic_name, count(*) as 'upvote_count' from tbl_post_vote pv " .
                        'join tbl_posts p on pv.post_id = p.post_id join tbl_topics t on p.topic_id = t.topic_id ' .
                        'where pv.user_id = ' . $user_id . ' AND pv.vote_type = 1 ' .
                        'group by t.topic_id')->result();
        return $user;
    }

    public function get_topic_network($topic_id) {
        $this->load->model('topic_model', 'topics');
        $topic = $this->topics->get_topic(false, $topic_id);

        //topic->user
        //user posts
        $topic->total_post = $this->db->query("select count(*) as 'total_post' from tbl_posts where topic_id = " . $topic_id)->row();
        $topic->post_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'post_count' from tbl_posts p"
                        . ' join tbl_users u on p.user_id = u.user_id'
                        . ' where topic_id = ' . $topic_id
                        . ' group by u.user_id')->result();
        //user upvotes
        $topic->total_upvote = $this->db->query("select count(*) as 'total_upvote' from tbl_post_vote pv "
                        . "join tbl_posts p on pv.post_id = p.post_id "
                        . "where pv.vote_type = 1 AND p.topic_id = " . $topic_id)->row();
        $topic->upvote_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'upvote_count' from tbl_post_vote pv "
                        . ' join tbl_posts p on p.post_id = pv.post_id'
                        . ' join tbl_users u on pv.user_id = u.user_id'
                        . ' where p.topic_id = ' . $topic_id . ' AND vote_type = 1'
                        . ' group by u.user_id')->result();

        //user downvotes
        $topic->total_downvote = $this->db->query("select count(*) as 'total_downvote' from tbl_post_vote pv "
                        . "join tbl_posts p on pv.post_id = p.post_id "
                        . "where pv.vote_type = -1 AND p.topic_id = " . $topic_id)->row();
        $topic->downvote_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'downvote_count' from tbl_post_vote pv "
                        . ' join tbl_posts p on p.post_id = pv.post_id'
                        . ' join tbl_users u on pv.user_id = u.user_id'
                        . ' where p.topic_id = ' . $topic_id . ' AND vote_type = -1'
                        . ' group by u.user_id')->result();

        //topic->topic
        //mutual followers
        $topic->total_follower = $this->db->query("select count(*) as 'total_follower' from tbl_topic_follower"
                        . " where topic_id = " . $topic_id)->row();
        $topic->mutual_map = $this->db->query("SELECT t.topic_id, t.topic_name, count(*) as 'mutual_count' "
                        . ' from (select user_id from tbl_topic_follower where topic_id = ' . $topic_id . ') tbl1'
                        . ' join tbl_topic_follower tf on tbl1.user_id = tf.user_id'
                        . ' join tbl_topics t on tf.topic_id = t.topic_id'
                        . ' where t.topic_id != ' . $topic_id
                        . ' group by t.topic_id')->result();

        return $topic;
    }

    public function get_within_topic($topic_id) {
        $this->load->model('user_model', 'users');

        $users = $this->users->get_topic_users($topic_id);

        foreach ($users as $user) {
            //get user connections
            $user->user_map = $this->db->query('SELECT result.user_id FROM (select u.user_id from tbl_posts p ' .
                            'join tbl_post_vote pv on p.post_id = pv.post_id ' .
                            'join tbl_users u on u.user_id = p.user_id where pv.user_id = ' . $user->user_id .
                            ' AND p.topic_id = ' . $topic_id . ' UNION ALL select u.user_id from tbl_posts p1 join tbl_posts p2 on p2.parent_id = p1.post_id ' .
                            'join tbl_users u on p1.user_id = u.user_id where p2.user_id = ' . $user->user_id . ' AND p1.topic_id = ' . $topic_id . ') result ' .
                            'group by result.user_id;')->result();
        }

        return $users;
    }

    public function get_user_topic($user_id, $topic_id) {
        $this->load->model('user_model', 'users');
        $this->load->model('topic_model', 'topics');

        $user = $this->users->get_user(false, false, array('user_id' => $user_id));
        $user->topic = $this->topics->get_topic(false, $topic_id);

        //user replies inside topic
        $user->total_replies = $this->db->query("select count(*) as 'total_replies' from tbl_posts"
                        . ' where user_id = ' . $user_id . ' AND topic_id = ' . $topic_id . ' AND parent_id != 0')->row();

        $user->reply_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'reply_count' from tbl_posts p1"
                        . ' join tbl_posts p2 on p1.parent_id = p2.post_id'
                        . ' join tbl_users u on p2.user_id = u.user_id'
                        . ' where p1.user_id = ' . $user_id . ' AND p1.topic_id = ' . $topic_id
                        . ' group by u.user_id')->result();

        //user upvotes inside topic
        $user->total_upvotes = $this->db->query("select count(*) as 'total_upvotes' from tbl_post_vote pv"
                        . ' join tbl_posts p on pv.post_id = p.post_id'
                        . ' where pv.user_id = ' . $user_id . ' AND p.topic_id = '
                        . $topic_id . ' AND pv.vote_type = 1')->row();

        $user->upvote_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'upvote_count' from tbl_posts p"
                        . ' join tbl_post_vote pv on p.post_id = pv.post_id'
                        . ' join tbl_users u on p.user_id = u.user_id'
                        . ' where p.topic_id = ' . $topic_id . ' AND pv.user_id = ' . $user_id . ' AND pv.vote_type = 1'
                        . ' group by u.user_id')->result();

        //user downvotes inside topic
        $user->total_downvotes = $this->db->query("select count(*) as 'total_downvotes' from tbl_post_vote pv"
                        . ' join tbl_posts p on pv.post_id = p.post_id'
                        . ' where pv.user_id = ' . $user_id . ' AND p.topic_id = '
                        . $topic_id . ' AND pv.vote_type = -1')->row();
        $user->downvote_map = $this->db->query("select u.user_id, u.first_name, u.last_name, u.profile_url, count(*) as 'downvote_count' from tbl_posts p"
                        . ' join tbl_post_vote pv on p.post_id = pv.post_id'
                        . ' join tbl_users u on p.user_id = u.user_id'
                        . ' where p.topic_id = ' . $topic_id . ' AND pv.user_id = ' . $user_id . ' AND pv.vote_type = -1'
                        . ' group by u.user_id')->result();
        return $user;
    }

}
