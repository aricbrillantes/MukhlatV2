<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Record_model
 *
 * @author Arces
 */
class Record_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_user_upvotes($user_id) {
        $this->db->select("u1.first_name, u1.last_name, COUNT(*) as vote_count")
                ->from("tbl_post_vote pv")
                ->join("tbl_posts p", "pv.post_id = p.post_id")
                ->join("tbl_users u1", "p.user_id = u1.user_id")
                ->join("tbl_users u2", "pv.user_id = u2.user_id")
                ->where(array("vote_type" => "1", "u2.user_id" => $user_id))
                ->group_by("u1.user_id")
                ->order_by("vote_count", "desc")
                ->limit("10");

        $upvotes = $this->db->get()->result();
        return $upvotes;
    }

    public function get_user_downvotes($user_id) {
        $this->db->select("u1.first_name, u1.last_name, COUNT(*) as vote_count")
                ->from("tbl_post_vote pv")
                ->join("tbl_posts p", "pv.post_id = p.post_id")
                ->join("tbl_users u1", "p.user_id = u1.user_id")
                ->join("tbl_users u2", "pv.user_id = u2.user_id")
                ->where(array("vote_type" => "-1", "u2.user_id" => $user_id))
                ->group_by("u1.user_id")
                ->order_by("vote_count", "desc")
                ->limit("10");

        $downvotes = $this->db->get()->result();
        return $downvotes;
    }

    public function get_post_start($user_id) {
        $this->db->select("topic_name, count(*) as post_count")
                ->from("tbl_posts p")
                ->join("tbl_topics t", "p.topic_id = t.topic_id")
                ->where(array("p.parent_id" => "0", "user_id" => $user_id))
                ->group_by("topic_name")
                ->order_by("post_count", "desc")
                ->limit("10");

        $post_start = $this->db->get()->result();
        return $post_start;
    }

    public function get_post_published($user_id) {
        $this->db->select("topic_name, count(*) as post_count")
                ->from("tbl_posts p")
                ->join("tbl_topics t", "p.topic_id = t.topic_id")
                ->where(array("user_id" => $user_id))
                ->group_by("topic_name")
                ->order_by("post_count", "desc")
                ->limit("10");

        $post_published = $this->db->get()->result();
        return $post_published;
    }

    public function get_user_replies($user_id) {
        $this->db->select("u2.first_name, u2.last_name, count(*) as reply_count")
                ->from("tbl_posts p1")
                ->join("tbl_posts p2", "p1.parent_id = p2.post_id")
                ->join("tbl_users u1", "p1.user_id = u1.user_id")
                ->join("tbl_users u2", "p2.user_id = u2.user_id")
                ->where("u1.user_id =  " . $user_id)
                ->group_by("u2.user_id")
                ->order_by("reply_count", "desc")
                ->limit("10");

        $replies = $this->db->get()->result();
        return $replies;
    }

}
