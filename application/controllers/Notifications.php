<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Notifications extends CI_Controller {

    public function index() {
        $logged_user = $_SESSION['logged_user'];

        if ($logged_user) {
            $this->load->model("notification_model", "notifs");

            $this->notifs->update_user_notifs($logged_user);
        }

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

    public function read() {
        $logged_user = $_SESSION['logged_user'];
        $this->load->model("notification_model", "notifs");
        $this->notifs->read_user_notifications($logged_user->user_id);
    }

}
