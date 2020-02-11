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
class Afk extends CI_Controller 
{
    public function index() 
    {
        if(isset($_SESSION['logged_user']))
        {
            $logged_user = $_SESSION['logged_user'];

            if($logged_user->role_id != 2 || $logged_user == null)
            {
                $homeURL = base_url('home');
                header("Location: $homeURL");
            }

            else if($logged_user->role_id == 2)
            {
                $this->load->view('pages/afk_page');
            }
        }

        else
        {
            $homeURL = base_url('home');
            header("Location: $homeURL");
        }
    }    
}
