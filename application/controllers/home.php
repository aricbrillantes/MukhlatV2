<?php

class Home extends CI_Controller 
{


    public function index() 
    {
        $logged_user = $_SESSION['logged_user'];

        if (!empty($logged_user)) 
        {
            if ($logged_user->role_id === '1') //Admin login
            { 
                $this->load->model('user_model', 'users');
                $data['users'] = $this->users->get_users();
                $this->load->view('pages/admin_page', $data);
            } 

            else if ($logged_user->role_id === '2') 
            {
                $this->load->model('post_model', 'posts');
                $data['posts'] = $this->posts->get_home_posts($logged_user->user_id);
                $this->load->view('pages/home_page', $data);
            }
            
            else if ($logged_user->role_id === '3') //Parent login
            { 
                $this->load->model('user_model', 'users');
                $data['users'] = $this->users->get_users();
                $this->load->view('pages/parent_page', $data);
            } 


        } 

        else 
        {
            //formerly $this->load->view('errors/html/error_general');
            $homeURL = base_url('');
            header("Location: $homeURL");
        }


        $this->load->model('user_model', 'user');

        $usertimes = $this->user->get_usertimes(39);
        // echo print_r($usertimes->result());
        date_default_timezone_set('Asia/Manila');

        if ($usertimes) 
        {
            // echo "<b>Successful query!</b><br><b>Allowed times:</b>";
            $restrict = 0;

            foreach ($usertimes->result() as $row)
            {
                $restrict = 0;
                // echo "<br>" . (int) $row->start_hour . ":" . $row->start_minute . "-" . $row->end_hour . ":" . $row->end_minute;
                
                if
                (
                    ((int) date("G") > (int) $row->start_hour && (int) date("G") < (int) $row->end_hour) ||
                    ((int) date("G") == (int) $row->start_hour && (int) date("i") > (int) $row->start_minute) ||
                    ((int) date("G") == (int) $row->end_hour && (int) date("i") < (int) $row->end_minute)
                )
                {
                    $restrict = 0;
                    break;
                }

                else
                {
                    $restrict = 1;
                    echo "<br> You cannot use<br>";
                    break;
                }

                
                    
                
            }

            echo "<br><b>Current time:</b> " . (int) date("G") . ": " . date("i")  ;
            //set default timezone to Manila
            
            // echo "<br><br>The current server timezone is: " . date_default_timezone_get();
            // echo "<br>Date/time is " . date('m/d/Y h:i:s a', time()) . "<br>";

            //current timestamp based on Manila timezone
            
        } 

        else
        {
            echo 0;
        }
        
        $this->load->library('user_agent');
        global $mobile;
        $mobile=$this->agent->is_mobile();

        if(!$mobile)
        {
            // echo "<script type='text/javascript'>alert('desktop');</script>";
        }   

        else
        {
            // echo "<script type='text/javascript'>alert('mobile');</script>";
        }


        
    }

    /* ADMIN FUNCTIONS */

    public function account() 
    {
        $this->load->model("user_model", "users");
        $logged_user = $_SESSION['logged_user'];
        if (!empty($logged_user)) 
        {
            if ($logged_user->role_id === '1') 
            { //Admin Login
                $this->users->toggle_account($this->input->post("user_id"));
            } 

            else if ($logged_user->role_id === '2') 
            {
                echo "Restricted Access!";
            }
        } 

        else 
        {
            //change error - not logged in
            $this->load->view('errors/html/error_general');
        }
    }
}
