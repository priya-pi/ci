<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Migrate extends CI_Controller { 

    public function index()
    {
        // load migration library
        $this->load->library('migration');

        if ( $this->migration->current() === false)
        {
             show_error($this->migration->error_string());
        } else {
            echo 'Migrations run successfully!';
        }   
    }    

   
}





  
