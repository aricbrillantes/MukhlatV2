<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of notification_model
 *
 * @author Arces
 */
class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* NOTIFY */

    public function notify_user($user_id, $source_id, $type) {
        $logged_user = $_SESSION['logged_user'];

        if ($user_id !== $logged_user->user_id) {
            //remove existing notif
            $remove_data = array("notification_type_id" => $type,
                "user_id" => $user_id,
                "doer_id" => $logged_user->user_id,
                "source_id" => $source_id);

            $this->db->delete("tbl_notifications", $remove_data);

            //add to notifications
            $insert_data = array("notification_type_id" => $type,
                "user_id" => $user_id,
                "doer_id" => $logged_user->user_id,
                "source_id" => $source_id,
                "is_read" => 0);

            $this->db->set("date_performed", "NOW()", FALSE);
            $this->db->insert("tbl_notifications", $insert_data);
        }
    }

    public function invite_user($user_id, $topic_id) {
        $logged_user = $_SESSION['logged_user'];

        $data = array('inviter_id' => $logged_user->user_id,
            'invited_id' => $user_id,
            'topic_id' => $topic_id,
            'status' => 0);

        $this->db->insert('tbl_moderator_invite', $data);
    }

    public function apply_moderator($user_id, $topic_id) {
        $data = array('user_id' => $user_id,
            'topic_id' => $topic_id,
            'status' => 0);

        if ($this->check_request($user_id, $topic_id)) {
            $this->db->delete('tbl_moderator_request', $data);
        } else {
            $this->db->insert('tbl_moderator_request', $data);
        }
    }

    /* GET */

    public function get_user_notifications($user_id) {
        $this->db->select("u.first_name, u.last_name, u.profile_url, n.doer_id, n.notification_type_id, n.source_id");
        $this->db->from("tbl_notifications as n");
        $this->db->join("tbl_users as u", "n.doer_id = u.user_id");
        $this->db->where("n.user_id =", $user_id);
        $this->db->where("date_performed <= NOW()");
        $this->db->where("notification_type_id != 4");
        $this->db->order_by("date_performed", "desc");

        $notifs = $this->db->get()->result();

        $this->load->model("post_model", "posts");
        $this->load->model("topic_model", "topics");
        foreach ($notifs as $notif) {
            $type = $notif->notification_type_id;
            if ($type === '1' || $type === '3' || $type === '5') {
                $notif->post = $this->posts->get_post(false, false, false, $notif->source_id);
            } else if ($type === '2') {
                $notif->topic = $this->topics->get_topic(false, $notif->source_id);
            }
        }

        return $notifs;
    }

    public function get_user_shared($user_id) {
        $this->db->select("u.first_name, u.last_name, u.profile_url, n.doer_id, n.source_id");
        $this->db->from("tbl_notifications as n");
        $this->db->join("tbl_users as u", "n.doer_id = u.user_id");
        $this->db->where("n.user_id = ", $user_id);
        $this->db->where("date_performed <= NOW()");
        $this->db->where("notification_type_id = 4");
        $this->db->order_by("date_performed", "desc");

        $shared = $this->db->get()->result();

        $this->load->model("topic_model", "topics");
        foreach ($shared as $notif) {
            $notif->topic = $this->topics->get_topic(false, $notif->source_id);
        }

        return $shared;
    }

    public function get_user_invites($user_id) {
        $this->db->select("u.first_name, u.last_name, u.user_id, u.profile_url, t.topic_name, t.topic_id, mi.invite_id");
        $this->db->from("tbl_topics as t");
        $this->db->join("tbl_moderator_invite as mi", "t.topic_id = mi.topic_id");
        $this->db->join("tbl_users as u", "mi.inviter_id = u.user_id");
        $this->db->where("mi.status = 0");
        $this->db->where("mi.invited_id = ", $user_id);

        $invites = $this->db->get()->result();

        return $invites;
    }

    public function get_user_requests($user_id) {
        $this->db->select("u.first_name, u.last_name, u.user_id, u.profile_url, t.topic_name, t.topic_id, mr.request_id");
        $this->db->from("tbl_topics as t");
        $this->db->join("tbl_topic_moderator as tm", "t.topic_id = tm.topic_id");
        $this->db->join("tbl_moderator_request as mr", "t.topic_id = mr.topic_id");
        $this->db->join("tbl_users as u", "mr.user_id = u.user_id");
        $this->db->where("mr.status = 0");
        $this->db->where("tm.user_id = ", $user_id);

        $requests = $this->db->get()->result();

        return $requests;
    }

    public function get_request($request_id) {
        $request = $this->db->get_where("tbl_moderator_request", array("request_id" => $request_id))->row();

        return $request;
    }

    public function get_invite($invite_id) {
        $invite = $this->db->get_where("tbl_moderator_invite", array("invite_id" => $invite_id))->row();

        return $invite;
    }

    /* GET COUNT */

    public function get_unread_count($user_id) {
        $this->db->select("COUNT(*) AS unread_count");
        $this->db->where("user_id = ", $user_id);
        $this->db->where("is_read = 0");

        $count = $this->db->get("tbl_notifications")->row();

        if ($count) {
            return $count->unread_count;
        } else {
            return 0;
        }
    }

    public function get_unanswered_invites($user_id) {
        $this->db->select('COUNT(*) AS unanswered_count');
        $this->db->where('invited_id = ', $user_id);
        $this->db->where('status = 0');

        $count = $this->db->get("tbl_moderator_invite")->row();

        if ($count) {
            return $count->unanswered_count;
        } else {
            return 0;
        }
    }

    public function get_unanswered_requests($user_id) {
        $this->db->select('COUNT(mr.request_id) AS unanswered_count');
        $this->db->from('tbl_moderator_request as mr');
        $this->db->join('tbl_topic_moderator as tm', 'mr.topic_id = tm.topic_id');
        $this->db->where('tm.user_id = ', $user_id);
        $this->db->where('mr.status = ', 0);

        $count = $this->db->get()->row();

        if ($count) {
            return $count->unanswered_count;
        } else {
            return 0;
        }
    }

    /* READ NOTIFS */

    public function read_user_notifications($user_id) {
        $this->db->where("user_id = ", $user_id);
        $this->db->update("tbl_notifications", array("is_read" => 1));
    }

    public function check_request($user_id, $topic_id) {
        $has_requested = $this->db->get_where('tbl_moderator_request', array('user_id' => $user_id,
                    'topic_id' => $topic_id, 'status' => 0))->row();

        return $has_requested;
    }

    /* UPDATE User Model */

    public function update_user_notifs($user) {
        //get notifs of user
        $user->notifications = $this->get_user_notifications($user->user_id);

        //get shared of user
        $user->shared_topics = $this->get_user_shared($user->user_id);

        //return unread count
        $user->unread_notifs = $this->get_unread_count($user->user_id);
        
        //return unanswered invite count
        $user->unanswered_invites = $this->get_unanswered_invites($user->user_id);

        //return unanswered request count
        $user->unanswered_requests = $this->get_unanswered_requests($user->user_id);

        //update requests to topics
        $user->moderator_requests = $this->get_user_requests($user->user_id);

        //update requests to topics
        $user->moderator_invites = $this->get_user_invites($user->user_id);
    }

    /* RESPOND */

    public function respond_request($request_id, $response) {
        $this->db->where("request_id = ", $request_id);
        $this->db->update("tbl_moderator_request", array("status" => $response));

        if ($response === 1) {
            $request = $this->get_request($request_id);
            $data = array("topic_id" => $request->topic_id,
                "user_id" => $request->user_id);
            $this->db->insert("tbl_topic_moderator", $data);
        }
    }

    public function respond_invite($invite_id, $response) {
        $this->db->where("invite_id = ", $invite_id);
        $this->db->update("tbl_moderator_invite", array("status" => $response));

        if ($response === 1) {
            $invite = $this->get_invite($invite_id);
            $data = array("topic_id" => $invite->topic_id,
                "user_id" => $invite->invited_id);
            $this->db->insert("tbl_topic_moderator", $data);
        }
    }

    public function update_invite($topic_id, $invited_id) {
        $this->db->where(array('topic_id' => $topic_id, 'invited_id' => $invited_id));
        $this->db->update("tbl_moderator_invite", array("status" => 1));
    }

    public function update_request($topic_id, $user_id) {
        $this->db->where(array('topic_id' => $topic_id, 'user_id' => $user_id));
        $this->db->update("tbl_moderator_request", array("status" => 1));
    }

}
