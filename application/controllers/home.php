<?php

class Home extends CI_Controller {
    public function index() {
        $logged_user = $_SESSION['logged_user'];
        if (!empty($logged_user)) {
            if ($logged_user->role_id === '1') { //Admin Login
                $this->load->model('user_model', 'users');
                $data['users'] = $this->users->get_users();
                $this->load->view('pages/admin_page', $data);
            } else if ($logged_user->role_id === '2') {
                $this->load->model('post_model', 'posts');
                $data['posts'] = $this->posts->get_home_posts($logged_user->user_id);
                $this->load->view('pages/home_page', $data);
            }
        } else {
            //change error - not logged in
            $this->load->view('errors/html/error_general');
        }
    }

    /* ADMIN FUNCTIONS */

    public function account() {
        $this->load->model("user_model", "users");
        $logged_user = $_SESSION['logged_user'];
        if (!empty($logged_user)) {
            if ($logged_user->role_id === '1') { //Admin Login
                $this->users->toggle_account($this->input->post("user_id"));
            } else if ($logged_user->role_id === '2') {
                echo "Restricted Access!";
            }
        } else {
            //change error - not logged in
            $this->load->view('errors/html/error_general');
        }
    }
}
