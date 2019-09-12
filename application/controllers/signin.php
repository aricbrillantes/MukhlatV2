<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function index() {
        //load roles
        $this->load->model('role_model', 'roles');
        $data['roles'] = $this->roles->get_roles();
        $this->load->view('pages/sign_in_page', $data);
    }

    public function signup() {
        $input = $this->input;
        $this->load->model('user_model', 'user');

        $fields = array('email' => $input->post('sign_up_email'));
        $user = $this->user->get_user(false, false, $fields);
        if (!$user) {
            $data = array(
                'first_name' => utf8_encode(htmlspecialchars($input->post('first_name', TRUE))),
                'last_name' => utf8_encode(htmlspecialchars($input->post('last_name', TRUE))),
                'email' => htmlspecialchars($input->post('sign_up_email', TRUE)),
                'password' => hash('sha256', htmlspecialchars($input->post('sign_up_password', TRUE))),
                'birthdate' => htmlspecialchars($input->post('sign_up_birthday', TRUE)),
                'role_id' => htmlspecialchars($input->post('sign_up_role', TRUE)),
                'is_enabled' => false,
            );
            $this->db->insert('tbl_users', $data);
            
            echo 1;
        } else{
            echo 0;
        }
    }

    public function login() {
        $this->load->model('user_model', 'user');
        $fields = array('email' => $this->input->post('log_in_email'),
            'password' => hash('sha256', $this->input->post('log_in_password', TRUE)),
            'is_enabled' => true);

        $user = $this->user->get_user(true, false, $fields);

        if ($user) {
            $this->load->model("notification_model", "notifs");

            $this->notifs->update_user_notifs($user);

            $_SESSION['logged_user'] = $user;

            echo 1;
        } else {
            echo 0;
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('signin', 'refresh');
    }

}
