<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mailer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('form');
    }

    public function send()
    {
        // $this->load->config('email');
        $this->load->library('email');

        $from = 'pthummar@patoliyainfotech.com';
        $to = $this->input->post('to');

        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject('Codelgniter Email');
		$this->email->message(
			
			"<h2>Welcome, ${from}</h2>" .
			"<h3> Thank you ," . "<br>" . " visit our site and stay with us</h3>"
		
		);

        if ($this->email->send()) {
            echo 'Sent with success!';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}


?>
