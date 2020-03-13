<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Parents extends CI_Controller {

    // $this->load->library('user_agent');
    // global $mobile;
    // $mobile=$this->agent->is_mobile();

    // if(!$mobile)
    // {
    //     echo "<script type='text/javascript'>alert('desktop');</script>";
    // }   

    // else
    // {
    //     echo "<script type='text/javascript'>alert('mobile');</script>";
    // }

    public function view_user() 
    {
        $user_id = $this->uri->segment(3);

        $this->load->model('user_model', 'users');
        $data['user'] = $this->users->get_user(false, false, array('user_id' => $user_id));
        $data['record'] = $this->users->get_user_records($user_id);
        $this->load->view('modals/user_record_modal', $data);
    }

    // PARENT NOTE FUNCTION
   
    public function note() 
    {
        $input = $this->input;

        $this->load->helper('url');
        $child_id = $this->uri->segment(3);

        if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

        date_default_timezone_set('Asia/Manila');

        $data = array
        (
            'child_id' => $child_id,
            'parent_id' => $logged_user->user_id,
            'note' => utf8_encode(htmlspecialchars($input->post('note_content'))),
            'date' => date('Y-m-d H:i:s')
        );

        $this->db->insert("tbl_notes", $data);

        redirect('parents/activity/' . $child_id);
    }

    public function activity() 
    {
        $user_id = $this->uri->segment(3);

        if(!$user_id)
        {
            redirect('home');
        }
        

        $this->db->select('*');
        $this->db->from('tbl_infractions');
        $this->db->where(array('tbl_infractions.user_id' => $user_id));

        $infractions = $this->db->get();

        if(!empty($infractions->result()))
        {
            $currentWeekInfractions = $infractions->row()->current_total;
            $overallInfractions = $infractions->row()->overall_total;

            $lastDate=date_create($infractions->row()->updated);
            $curDate=date_create(date('Y-m-d'));

            $satLastWeek = date_create(date("Y-m-d", strtotime('saturday last week')));  
            $sunLastWeek = date_create(date("Y-m-d", strtotime('sunday last week')));  
            $sunThisWeek = date_create(date("Y-m-d", strtotime('sunday this week')));           

            //if table was updated last week, update for both stats for this week and last week
            if($lastDate < $sunThisWeek)
            {
                
                if($lastDate <= $satLastWeek)
                {
                    $data = array
                    (
                        'user_id' => $user_id,
                        'last_total' => $currentWeekInfractions,
                        'current_total' => 0,
                        'updated' => date('Y-m-d')
                    );

                    $this->db->select('*');
                    $this->db->from('tbl_infractions');
                    $this->db->where('user_id', $user_id);
                    $this->db->update('tbl_infractions', $data); 
                }
                
                else if($lastDate < $sunLastWeek)
                {
                    $data = array
                    (
                        'user_id' => $user_id,
                        'last_total' => 0,
                        'current_total' => 0,
                        'updated' => date('Y-m-d')
                    );

                    $this->db->select('*');
                    $this->db->from('tbl_infractions');
                    $this->db->where('user_id', $user_id);
                    $this->db->update('tbl_infractions', $data); 
                }
            }
        } 

        else if(empty($infractions->result()))
        {
            $data = array
            (
                'user_id' => $user_id,
                'current_total' => 0,
                'overall_total' => 0,
                // 'current_avg' => 0/7,
                'updated' => date('Y-m-d')
            );

            $this->db->insert('tbl_infractions', $data);
            // header("Refresh:0");
        }

        $this->load->view('pages/child_activity');
    }

    public function network() 
    {
        $this->load->view('pages/child_network');
    }

    public function settings() 
    {
        $user_id = $this->uri->segment(3);

        if(!$user_id)
        {
            redirect('home');
        }

        $this->db->select('*');
        $this->db->from('tbl_usertimes');
        $this->db->where(array('tbl_usertimes.user_id' => $user_id));
        
        $query = $this->db->get();
        
        if(empty($query->result()))
        {
            // $settings = 'cell71-A cell72-A cell73-A cell74-A cell75-A cell78-A cell79-A cell80-A cell81-A cell82-A cell85-A cell86-A cell87-A cell88-A cell89-A cell92-A cell93-A cell94-A cell95-A cell96-A cell99-A cell100-A cell101-A cell102-A cell103-A cell106-A cell107-A cell108-A cell109-A cell110-A cell113-A cell114-A cell115-A cell116-A cell117-A cell118-A cell119-A cell120-A cell121-A cell122-A cell123-A cell124-A cell125-A cell126-A cell127-A cell128-A cell129-A cell130-A cell131-A cell132-A cell133-A cell134-A cell135-A cell136-A cell137-A cell138-A cell139-A cell140-A cell141-A cell142-A cell143-A cell144-A cell145-A cell148-A cell149-A cell150-A cell151-A cell152-A cell155-A cell156-A cell157-A cell158-A cell159-A cell162-A cell163-A cell164-A cell165-A cell166-A cell169-A cell170-A cell171-A cell172-A cell173-A cell176-A cell177-A cell178-A cell179-A cell180-A cell183-A cell184-A cell185-A cell186-A cell187-A cell190-A cell191-A cell192-A cell193-A cell194-A cell197-A cell198-A cell199-A cell200-A cell201-A cell204-A cell205-A cell206-A cell207-A cell208-A cell211-A cell212-A cell213-A cell214-A cell215-A cell216-A cell217-A cell218-A cell219-A cell220-A cell221-A cell222-A cell223-A cell224-A cell225-A cell226-A cell227-A cell228-A cell229-A cell230-A cell231-A cell232-A cell233-A cell234-A cell235-A cell236-A cell237-A cell238-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell260-A cell261-A cell262-A cell263-A cell264-A cell267-A cell268-A cell269-A cell270-A cell271-A';
           $settings = 'cell133-A cell140-A cell147-A cell154-A cell161-A cell168-A cell188-A cell195-A cell202-A cell209-A cell216-A cell223-A cell230-A cell237-A cell239-A cell240-A cell241-A cell242-A cell243-A cell244-A cell245-A cell246-A cell247-A cell248-A cell249-A cell250-A cell251-A cell252-A cell253-A cell254-A cell255-A cell256-A cell257-A cell259-A cell260-A cell261-A cell262-A cell263-A cell264-A cell266-A cell281-A cell282-A cell283-A cell284-A cell285-A cell286-A cell293-A';
           // $warning = '30';
            $keep = '1';
            $limit = '90';

            $data = array
            (
                'user_id' => $user_id,
                'time_setting'=> $settings,
                // 'warning' => $warning,
                'keep' => $keep,
                'use_limit' => $limit
            );

            $this->db->insert('tbl_usertimes',$data);
        }

        $this->load->view('pages/child_settings');
    }

    // public function advanced() 
    // {
    //     $this->load->view('pages/child_advanced');
    // }

    public function load_network() 
    {
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
