<?php

class User extends CI_Controller {

    public function index() 
    {
        $this->load->view('pages/user_page');
        $this->load->library('user_agent');
        global $mobile;
        $mobile=$this->agent->is_mobile();

        if(!$mobile)
        {
            // echo "<script type='text/javascript'>alert('topic desktop');</script>";
        }   

        else
        {
            // echo "<script type='text/javascript'>alert('topic mobile');</script>";
        }
    }

    public function profile() {
        $user_id = $this->uri->segment(3);

        if ($user_id) {
            $this->load->model("user_model", "users");

            $data['user'] = $this->users->get_user(true, true, array('user_id' => $user_id));

            $this->load->view('pages/user_page', $data);
        } 

        else 
        {
            // $this->load->view('errors/error_404');
            // $this->load->view('errors/error_404');
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
    }

    public function update() 
    {
        
        if(isset($_SESSION['logged_user']))
            $user = $_SESSION['logged_user'];

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
        
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

        if($input->post('edit_pass', TRUE)!="" && $input->post('edit_pass', TRUE)!=NULL)
        {
            $password = hash('sha256', htmlspecialchars($input->post('edit_pass', TRUE)));
            $edit_pass = $password;
        }    

        else
        {
            $edit_pass = $user->password;
        }    

        // $email = utf8_encode(htmlspecialchars($input->post('edit_email')));
       
        if($user->role_id=='2')
        {
            $parent = utf8_encode(htmlspecialchars($input->post('edit_parent_email')));
            $description = utf8_encode(htmlspecialchars($input->post('edit_description')));

            $data = array
            (   
                'first_name' => $firstname,
                'last_name' => $lastname,
                'password' => $edit_pass,
                'description' => $description,
                // 'email' => $email,
                'parent' => $parent,
                'profile_url' => $path
            );
        }

        else if($user->role_id=='1' || $user->role_id=='3')
        {
            $data = array
            (   
                'first_name' => $firstname,
                'last_name' => $lastname,
                'password' => $edit_pass,
                // 'email' => $email,
                'profile_url' => $path
            );
        }


        $this->users->update_profile($user->user_id, $data);

        $_SESSION['logged_user'] = $this->users->get_user(true, false, array('user_id' => $user->user_id));
        $this->load->model("notification_model", "notifs");

        $this->notifs->update_user_notifs($_SESSION['logged_user']);

        redirect(base_url('user/profile/' . $user->user_id));
    }
}
