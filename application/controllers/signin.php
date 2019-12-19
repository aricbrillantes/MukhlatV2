<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    public function index() {
        //load roles
        $this->load->model('role_model', 'roles');
        $data['roles'] = $this->roles->get_roles();
        $this->load->view('pages/sign_in_page', $data);
    }

    public function signup() 
    {
        $input = $this->input;
        $this->load->model('user_model', 'user');

        $fields = array('email' => $input->post('sign_up_email'));
        $user = $this->user->get_user(false, false, $fields);

        $parentEmail = $input->post('sign_up_email_parent', TRUE);

        $parentExists = $this->db->select('*')
            ->from('tbl_users')
            ->where('email', $parentEmail)
            ->where('role_id', "3");

        /*
            0 email taken
            1 or 2 success
            3
            4 birthday empty
            5 parent email is blank or doesnt exist
            6
            7
            8
            9 
        */

        if($user || !empty($user))
        {
            echo 0;
            return 0;
        }

        else if ((!$user || empty($user)) && $input->post('sign_up_role', TRUE == 2)) 
        {
            if(empty($parentExists->get()->result()) || empty($input->post('sign_up_email_parent', TRUE)) || $input->post('sign_up_email_parent', TRUE) == '')
            {
                echo 5;
                return 5;
            }

            if(empty($input->post('sign_up_birthday', TRUE)))
            {
                echo 4;
                return 4;
            }

            else if(empty($user))
            {
                $data = array
                (
                    'first_name' => utf8_encode(htmlspecialchars($input->post('first_name', TRUE))),
                    'last_name' => utf8_encode(htmlspecialchars($input->post('last_name', TRUE))),
                    'email' => htmlspecialchars($input->post('sign_up_email', TRUE)),
                    'password' => hash('sha256', htmlspecialchars($input->post('sign_up_password', TRUE))),
                    'birthdate' => htmlspecialchars($input->post('sign_up_birthday', TRUE)),
                    'parent' => htmlspecialchars($input->post('sign_up_email_parent', TRUE)),
                    'role_id' => htmlspecialchars($input->post('sign_up_role', TRUE)),
                    'is_enabled' => false,
                );

                $this->db->insert('tbl_users', $data);

                echo 1;
                return 1;
            }

            else
            {
                echo 0;
                return 0;
            }
        } 

        else if (!$user && $input->post('sign_up_role', TRUE == 1) || $input->post('sign_up_role', TRUE == 3)) 
        {
            $data = array(
                'first_name' => utf8_encode(htmlspecialchars($input->post('first_name', TRUE))),
                'last_name' => utf8_encode(htmlspecialchars($input->post('last_name', TRUE))),
                'email' => htmlspecialchars($input->post('sign_up_email', TRUE)),
                'password' => hash('sha256', htmlspecialchars($input->post('sign_up_password', TRUE))),
                'role_id' => htmlspecialchars($input->post('sign_up_role', TRUE)),
                'is_enabled' => false,
            );
            $this->db->insert('tbl_users', $data); 

            echo 2;
            return 2;
        } 

        else
        {
            echo 0;
            return ($this->db->affected_rows() != 1) ? 0 : 1;
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

            date_default_timezone_set('Asia/Manila');
            $_SESSION['login_time'] = date('H:i');

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
