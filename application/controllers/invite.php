<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invite
 *
 * @author Arces
 */
class Invite extends CI_Controller {

    public function index() {
        $topic = $_SESSION['current_topic'];
        $user_ids = $this->input->post('invite-checkbox');
        $this->load->model("notification_model", "notifs");
        foreach ($user_ids as $id) {
            //invite
            $this->notifs->invite_user($id, $topic->topic_id);
        }
        //change
        redirect(base_url('topic/view/' . $topic->topic_id));
    }

    public function share() {
        $topic = $_SESSION['current_topic'];
        $user_ids = $this->input->post('share-checkbox');
        $this->load->model("notification_model", "notifs");
        foreach ($user_ids as $id) {
            $this->notifs->notify_user($id, $topic->topic_id, 4);
        }
        //change
        redirect(base_url('topic/view/' . $topic->topic_id));
    }

    public function accept() {
        $type = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $this->load->model("notification_model", "notifs");
        $this->load->model("topic_model", "topics");
        $this->load->model("user_model", "users");

        if ($type === "request") {
            //REQUEST
            $this->notifs->respond_request($id, 1);

            $request = $this->notifs->get_request($id);
            $request->topic = $this->topics->get_topic(false, $request->topic_id);
            $request->requester = $this->users->get_user(false, false, array('user_id' => $request->user_id));
            
            //update the invite if ever there is already an invite
            $this->notifs->update_invite($request->topic_id, $request->user_id);
            
            $data = array('user_id' => $request->requester->user_id,
                'first_name' => $request->requester->first_name,
                'last_name' => $request->requester->last_name,
                'topic_id' => $request->topic->topic_id,
                'topic_name' => $request->topic->topic_name);
        } else if ($type === "invite") {
            //INVITE
            $this->notifs->respond_invite($id, 1);

            $invite = $this->notifs->get_invite($id);
            $invite->topic = $this->topics->get_topic(false, $invite->topic_id);
            $invite->inviter = $this->users->get_user(false, false, array('user_id' => $invite->inviter_id));
            
            //update the invite if ever there is already an invite
            $this->notifs->update_request($invite->topic_id, $invite->invited_id);
            
            $data = array('user_id' => $invite->inviter->user_id,
                'first_name' => $invite->inviter->first_name,
                'last_name' => $invite->inviter->last_name,
                'topic_id' => $invite->topic->topic_id,
                'topic_name' => $invite->topic->topic_name);
        }

        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

    public function decline() {
        $type = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $this->load->model("notification_model", "notifs");
        $this->load->model("topic_model", "topics");
        $this->load->model("user_model", "users");

        if ($type === "request") {
            //REQUEST
            $this->notifs->respond_request($id, -1);

            $request = $this->notifs->get_request($id);
            $request->topic = $this->topics->get_topic(false, $request->topic_id);
            $request->requester = $this->users->get_user(false, false, array('user_id' => $request->user_id));

            $data = array('user_id' => $request->requester->user_id,
                'first_name' => $request->requester->first_name,
                'last_name' => $request->requester->last_name,
                'topic_id' => $request->topic->topic_id,
                'topic_name' => $request->topic->topic_name);
        } else if ($type === "invite") {
            //INVITE
            $this->notifs->respond_invite($id, -1);

            $invite = $this->notifs->get_invite($id);
            $invite->topic = $this->topics->get_topic(false, $invite->topic_id);
            $invite->inviter = $this->users->get_user(false, false, array('user_id' => $invite->inviter_id));

            $data = array('user_id' => $invite->inviter->user_id,
                'first_name' => $invite->inviter->first_name,
                'last_name' => $invite->inviter->last_name,
                'topic_id' => $invite->topic->topic_id,
                'topic_name' => $invite->topic->topic_name);
        }

        $this->output->set_content_type('application/json');
        echo json_encode($data);
    }

}
