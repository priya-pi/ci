<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('display_errors', 0);

class Curl_demo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('api/register');
    }

    public function register()
    {
    
        $curl = curl_init();
        $cfile = new CURLFile(

        	$_FILES['image']['tmp_name'],
        	$_FILES['image']['type'],
        	$_FILES['image']['name']

        );

        $json = implode(',', $this->input->post('interests'));
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'gender' => $this->input->post('gender'),
            'interests' => $json,
            'image' => $cfile
        ];

        // curl_setopt($curl, CURLOPT_HTTPHEADER, [
        //     'Content-Type:application/json',
        // ]);
        // curl_setopt($curl, CURLOPT_HTTPHEADER, 'Content-Type:multipart/form-data');
		
        curl_setopt($curl, CURLOPT_URL,'http://127.0.0.1:8000/api/register' );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        $curlResponse = curl_exec($curl);
        if ($curlResponse == false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {
			curl_close($curl);
            redirect(base_url() . 'api/login');

        }
        exit();
    }

    public function loginView()
    {
        $this->load->view('api/login');
    }

    public function login()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [

            CURLOPT_URL => 'http://127.0.0.1:8000/api/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            ],
            // CURLOPT_HTTPHEADER => [
			// 	'Content-Type:application/json'
            // ],
        ]);

        $curlResponse = curl_exec($curl);
        if ($curlResponse == false) {
            echo 'Curl error: ' . curl_error($curl);
        } else {

            $jsonArrayResponse = json_decode($curlResponse);
            echo '<pre>';
            pr($jsonArrayResponse);
            echo '</pre>';
			curl_close($curl);

        }
        exit();
    }
}
