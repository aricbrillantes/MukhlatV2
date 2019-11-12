<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of topic
 *
 * @author Aric
 */
class Restrict extends CI_Controller {

    public function index() 
    {
        if(isset($_SESSION['logged_user']))
        {
            if(isset($_SESSION['logged_user']))
            $logged_user = $_SESSION['logged_user'];

            if (!empty($logged_user)) 
            {
                $this->load->view('pages/child_restrict_page');
            }
        }

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
         
    }

    

}
