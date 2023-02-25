<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_controller extends CI_Controller {

  public function __construct(){

   parent::__construct();
   $this->load->model('Customer_model'); 
  } 

  public function index() {

   $data['usersData'] = $this->Customer_model->getUserDetails();
   $this->load->view('add',$data);

  }
 
  // Export data in CSV format 
  public function exportCSV(){ 

   // file name 
   $filename = 'users_'. date('Ymd').'.csv'; 
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


	public function importCSV()
	{
			  // Check form submit or not 
				if($this->input->post('upload') != NULL ){ 
					$data = array(); 
					if(!empty($_FILES['file']['name'])){ 
						// Set preference 
						$config['upload_path'] = 'assets/files/'; 
						$config['allowed_types'] = 'csv'; 
						$config['max_size'] = '1000'; // max_size in kb 
						$config['file_name'] = $_FILES['file']['name'];
	 
						// Load upload library 
						$this->load->library('upload',$config); 
		
						// File upload
						if($this->upload->do_upload('file')){ 
							 // Get data about the file
							 $uploadData = $this->upload->data(); 
							 $filename = $uploadData['file_name'];
	 
							 // Reading file
							 $file = fopen("assets/files/".$filename,"r");
							 $i = 0;
							 $numberOfFields = 4; // Total number of fields
							 $importData_arr = array();
		
							 while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
									$num = count($filedata );
									
									if($numberOfFields == $num){
										 for ($c=0; $c < $num; $c++) {
												$importData_arr[$i][] = $filedata [$c];
										 }
									}
									$i++;
							 }
							 fclose($file);
							 $skip = 0;
	 
							 // insert import data
							 foreach($importData_arr as $userdata){
	 
									// Skip first row
									if($skip != 0){
										 $this->Customer_model->insertRecord($userdata);
									}
									$skip ++;
							 }
							 $data['response'] = 'successfully uploaded '.$filename; 
						}else{ 
							 $data['response'] = 'failed'; 
						} 
				 }else{ 
						$data['response'] = 'failed'; 
				 } 
				 // load view 
				 $this->load->view('import',$data); 
			 }else{
				 // load view 
				 $this->load->view('import'); 
			 }
				 
	}
}
?>
