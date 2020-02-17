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

            else if ($logged_user->role_id === '2') //child
            {
                $this->load->model('post_model', 'posts');
                $data['posts'] = $this->posts->get_home_posts($logged_user->user_id);

                $this->db->select('*');
                $this->db->from('tbl_usertimes');
                $this->db->where(array('tbl_usertimes.user_id' => $user_id));
                
                $query = $this->db->get();
                
                // echo print_r($query->result());

                if(!empty($query->result()))
                {
                    return $query;
                }    

                else
                {
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
                }

                $this->load->view('pages/home_page', $data);

                // $this->load->model('user_model', 'user');

                // $usertimes = $this->user->get_usertimes($logged_user->user_id);
                // echo print_r($usertimes->result());
                // date_default_timezone_set('Asia/Manila');

                // if ($usertimes) 
                // {
                //     $restrict = 0;

                //     // echo "<b>Successful query!</b><br><b>Allowed times:</b>";
                //     foreach ($usertimes->result() as $row)
                //     {
                //         $restrict = 0;
                //         // echo "<br>" . (int) $row->start_hour . ":" . $row->start_minute . "-" . $row->end_hour . ":" . $row->end_minute;
                        
                //         if
                //         (   ((int) date("G") > (int) $row->start_hour && (int) date("G") < (int) $row->end_hour) ||
                //             ((int) date("G") == (int) $row->start_hour && (int) date("i") > (int) $row->start_minute) ||
                //             ((int) date("G") == (int) $row->end_hour && (int) date("i") < (int) $row->end_minute)
                //         )
                //         {
                //             $restrict = 0;
                //             break;
                //         }

                //         else
                //         {
                //             $restrict = 1;
                //             echo "<br> You cannot use<br>";
                //             break;
                //         }

                //     }

                //     echo "<br><b>Current time:</b> " . (int) date("G") . ": " . date("i")  ;
                //     //set default timezone to Manila
                    
                //     // echo "<br><br>The current server timezone is: " . date_default_timezone_get();
                //     // echo "<br>Date/time is " . date('m/d/Y h:i:s a', time()) . "<br>";
                // } 

                // else
                //     echo 0;
                
            }
            
            else if ($logged_user->role_id === '3') //Parent login
            { 
                $this->load->model('user_model', 'users');
                $data1['users'] = $this->users->get_users();
                $this->load->view('pages/parent_page', $data1);

                $this->load->model('user_model', 'users');
                $children = $this->users->view_child($logged_user->user_id);
                // echo print_r($children);

                
                // echo "<b>Successful query!</b><br><br><b>Children:</b>";
                // foreach ($children->result() as $row)
                // {
                //     // $restrict = 0;
                //     echo "<br>" . $row->first_name . " " . $row->last_name ;
                    
                // }

                // echo "<br><b>Current time:</b> " . (int) date("G") . ": " . date("i")  ;
                //set default timezone to Manila
                
                // echo "<br><br>The current server timezone is: " . date_default_timezone_get();
                // echo "<br>Date/time is " . date('m/d/Y h:i:s a', time()) . "<br>";
               
            } 
        } 

        else 
        {
            //formerly $this->load->view('errors/html/error_general');
            $homeURL = base_url('');
            header("Location: $homeURL");
            die();
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

            else if ($logged_user->role_id === '2' || $logged_user->role_id === '3') 
            {
                echo "Restricted Access!";
            }
        } 

        else 
        {
            //change error - not logged in
            $this->load->view('signin');
        }
    }
}
