<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin
 *
 * @author Arces
 */
class Admin extends CI_Controller {

    public function view_user() {
        $user_id = $this->uri->segment(3);

        $this->load->model('user_model', 'users');
        $data['user'] = $this->users->get_user(false, false, array('user_id' => $user_id));
        $data['record'] = $this->users->get_user_records($user_id);
        $this->load->view('modals/user_record_modal', $data);
    }

    public function network() {
        $this->load->view('pages/network_page');
    }

    public function load_network() {
        $this->load->model('network_model', 'net');
        $this->load->model('topic_model', 'topics');
        $topics = $this->topics->get_topics();

        $data = new stdClass();
        $data->users = $this->net->get_general_network();
        $data->topics = $topics;

        echo json_encode($data);
    }

    public function user_network() {
        $user_id = $this->uri->segment(3);

        $this->load->model('network_model', 'net');

        $user = $this->net->get_user_network($user_id);

        echo json_encode($user);
    }

    public function topic_network() {
        $topic_id = $this->uri->segment(3);

        $this->load->model('network_model', 'net');

        $topic = $this->net->get_topic_network($topic_id);

        echo json_encode($topic);
    }

    public function within_topic() {
        $topic_id = $this->uri->segment(3);

        $this->load->model('network_model', 'net');
        $this->load->model('topic_model', 'topics');
        $topic = $this->topics->get_topic(false, $topic_id);
        $topic->users = $this->net->get_within_topic($topic_id);

        echo json_encode($topic);
    }

    public function user_topic() {
        $user_id = $this->uri->segment(3);
        $topic_id = $this->uri->segment(4);

        $this->load->model('network_model', 'net');

        $user = $this->net->get_user_topic($user_id, $topic_id);
        
        echo json_encode($user);
    }

}
