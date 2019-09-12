<?php

class User extends CI_Controller {

    public function index() {
        $this->load->view('pages/user_page');
    }

    public function profile() {
        $user_id = $this->uri->segment(3);

        if ($user_id) {
            $this->load->model("user_model", "users");

            $data['user'] = $this->users->get_user(true, true, array('user_id' => $user_id));

            $this->load->view('pages/user_page', $data);
        } else {
            $this->load->view('errors/error_404');
        }
    }

    public function update() {
        $user = $_SESSION['logged_user'];
        
        if (!file_exists('./uploads/user_profiles')) {
            mkdir('./uploads/user_profiles/', 0777, true);
        }
        $config['upload_path'] = './uploads/user_profiles/';
        $config['encrypt_name'] = TRUE;
        $config['allowed_types'] = '*';
        $config['maxsize'] = '0';
        
        $this->load->library('upload', $config);
        $path = $user->profile_url ? $user->profile_url : null;

        if ($_FILES['profile_picture']['name']) {
            if (!$this->upload->do_upload('profile_picture')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();
                $path = 'uploads/user_profiles/' . $upload_data['file_name'];
                $user->profile_url = $path;
            }
        }

        $this->load->model('user_model', 'users');
        $input = $this->input;
        $firstname = utf8_encode(htmlspecialchars($input->post('edit_first')));
        $lastname = utf8_encode(htmlspecialchars($input->post('edit_last')));
        $password = $input->post('edit_pass');
        $email = utf8_encode(htmlspecialchars($input->post('edit_email')));
        $description = utf8_encode(htmlspecialchars($input->post('edit_description')));

        $edit_pass = (empty($password) ? $user->password : $password);
        $data = array('first_name' => $firstname,
            'last_name' => $lastname,
            'password' => $edit_pass,
            'description' => $description,
            'email' => $email,
            'profile_url' => $path,
        );

        $this->users->update_profile($user->user_id, $data);

        $_SESSION['logged_user'] = $this->users->get_user(true, false, array('user_id' => $user->user_id));
        $this->load->model("notification_model", "notifs");

        $this->notifs->update_user_notifs($_SESSION['logged_user']);

        redirect(base_url('user/profile/' . $user->user_id));
    }
}
