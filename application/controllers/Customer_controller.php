<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_controller extends CI_Controller {

	public function __construct(){

   parent::__construct();
   $this->load->model('Customer_model'); 
  } 

  public function index(){

   $data['usersData'] = $this->Customer_model->getUserDetails();
   $this->load->view('customer/add',$data); 
  }
 
  // Export data in CSV format 
  public function exportCSV(){ 
   // file name 
   $filename = 'users_'.date('Ymd').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // get data 
   $usersData = $this->Customer_model->getUserDetails();

   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("customer_id","firstname","lastname"); 
   fputcsv($file, $header);
   foreach ($usersData as $key=>$line){ 
     fputcsv($file,$line); 
   }
   fclose($file); 
   exit; 
  }
}

?>
