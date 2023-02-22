<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lang_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('home','german');
    }

    public function index(){

        //Get the selected language
        $language = $this->input->post('language');
        if($language == "german")
           $this->lang->load('home_lang','german');
        else
            $this->lang->load('home_lang','english');
       
        //Fetch the message from language file.
        $data['msg'] = $this->lang->line('msg');
       
        $data['language'] = $language;
        //Load the view file
        $this->load->view('localization',$data);
     }

}

?>