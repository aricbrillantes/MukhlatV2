<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Admin extends CI_Controller {

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

    public function network() 
    {
        $this->load->view('pages/network_page');
    }

    public function activity() 
    {
        $user_id = $this->uri->segment(3);

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
                    $tempID = $infractions->row()->id;
                    $data = array
                    (
                        'id' => $tempID,
                        'user_id' => $user_id,
                        'last_total' => $currentWeekInfractions,
                        'current_total' => 0,
                        'updated' => date('Y-m-d')
                    );

                    $this->db->delete('tbl_infractions', array('user_id' => $user_id)); 

                    $this->db->insert('tbl_infractions', $data);
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

        $this->load->view('pages/admin_activity');
    }

    public function parent() 
    {
        $this->load->view('pages/admin_parent_page');
    }

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