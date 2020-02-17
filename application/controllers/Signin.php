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

        else if ((!$user || empty($user)) && $input->post('sign_up_role', TRUE) == 2)
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

                $settings = 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A';
                   
                // $warning = '30';
                $keep = '1';
                $limit = '120';

                $data = array
                (
                    'user_id' => $user_id,
                    'time_setting'=> $settings,
                    // 'warning' => $warning,
                    // 'keep' => $keep,
                    // 'use_limit' => $limit
                );

                $this->db->insert('tbl_usertimes',$data);  
                
                

                if(!empty($query->result()))
                {
                    return $query;
                }    

                else
                {
                     
                }

                echo 1;
                return 1;
            }

            else
            {
                echo 0;
                return 0;
            }
        }

        else if (!$user && $input->post('sign_up_role', TRUE) == 1 || $input->post('sign_up_role', TRUE) == 3)
        {
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
        $this->load->model('User_model', 'user');
        $fields = array('email' => $this->input->post('log_in_email'),
            'password' => hash('sha256', $this->input->post('log_in_password', TRUE)),
            'is_enabled' => true);

        $user = $this->user->get_user(true, false, $fields);

        if ($user) {
            $this->load->model("Notification_model", "notifs");

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
