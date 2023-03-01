<?php defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Import_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Customer_model');
        $this->load->library('form_validation');
        $this->load->helper('file');
    }

    public function index()
    {
        $data = [];
        if ($this->session->userdata('success_msg')) {
            $data['success_msg'] = $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg');
        }
        if ($this->session->userdata('error_msg')) {
            $data['error_msg'] = $this->session->userdata('error_msg');
            $this->session->unset_userdata('error_msg');
        }

        $data['members'] = $this->Customer_model->getRows();
        $this->load->view('customer/import', $data);
    }

    public function importExcel()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $status = $this->createExcel();
			
            if ($status == true) {

                $filename = 'upload/' . $status;
                $filetype = \PhpOffice\PhpSpreadsheet\IOFactory::identify(
                    $filename
                );
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(
                    $filetype
                );
				
                $spreadsheet = $reader->load($filename);
                $sheet = $spreadsheet->getSheet(0);

                $count_row = 0;
                foreach ($sheet->getRowIterator() as $row) {
                    $customer_id = $spreadsheet
                        ->getActiveSheet()
                        ->getCell('A' . $row->getRowIndex());
                    $firstname = $spreadsheet
                        ->getActiveSheet()
                        ->getCell('B' . $row->getRowIndex());
                    $lastname = $spreadsheet
                        ->getActiveSheet()
                        ->getCell('C' . $row->getRowIndex());
                    $email = $spreadsheet
                        ->getActiveSheet()
                        ->getCell('D' . $row->getRowIndex());

                    $data = [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                    ];

                    $this->db->insert_batch('customer', $data);
                    $count_row++;
                }
                $this->session->set_flashdata('success', 'data inserted');
                redirect('import');


            } else {
                $this->session->set_flashdata('error', 'data not uploaded');
                redirect('import');
            }
        } else {
            $this->load->view('customer/import');
        }
    }


    public function createExcel()
    {
        $uploadPath = 'upload/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file')) {
            $file = $this->upload->data();
            return $file['file_name'];
        } else {
            return false;
        }
    }

    public function file_check($str)
    {
        $allowed_mime_types = [
            'text/x-comma-separated-values',
            'text/comma-separated-values',
            'application/octet-stream',
            'application/vnd.ms-excel',
            'application/x-csv',
            'text/x-csv',
            'text/csv',
            'application/csv',
            'application/excel',
            'application/vnd.msexcel',
            'text/plain',
        ];
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if ($ext == 'csv' && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message(
                    'file_check',
                    'Please select only CSV file to upload.'
                );
                return false;
            }
        } else {
            $this->form_validation->set_message(
                'file_check',
                'Please select a CSV file to upload.'
            );
            return false;
        }
    }

    public function importCSV()
    {
        $data = [];
        $memData = [];

        if ($this->input->post('importSubmit')) {

            $this->form_validation->set_rules(
                'file',
                'CSV file',
                'callback_file_check'
            );

            // Validate submitted form data
            if ($this->form_validation->run() == true) {

                $rowCount = $notAddCount = 0;
                // If file uploaded
                if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->load->library('CSVReader');
                    $csvData = $this->csvreader->parse_csv($_FILES['file']['tmp_name']);

                    if (!empty($csvData)) {
                        foreach ($csvData as $row) {
                           
							$rowCount++;
                            $memData[] = [
                                'firstname' => $row['firstname'],
                                'lastname' => $row['lastname'],
                                'email' => $row['email'],
                            ];
                            // Check whether email already exists in the database
                            $con = [
                                'where' => [
                                    'email' => $row['email'],
                                ],
                                'returnType' => 'count',
                            ];
                            $prevCount = $this->Customer_model->getRows($con);
						}
						if($prevCount > 0)
						{
							$condition = "email";
							$updated  = $this->Customer_model->update($memData,$condition);

						}else{

							$inserted = $this->Customer_model->insert($memData);
						}			
                        // Status message with imported data count
                        $notAddCount = $rowCount - ($insertCount + $updateCount);
                        $successMsg =
                            'Members imported successfully. Total Rows (' . $rowCount .
                            ') | Inserted (' .($inserted ?? 0).
                            ') | Updated (' .($updated ?? 0 ).') 
							| Not Inserted (' . $notAddCount .')';
                        $this->session->set_userdata('success_msg',$successMsg);
                    }
                } else {
                    $this->session->set_userdata(
                        'error_msg',
                        'Error on file upload, please try again.'
                    );
                }
            } else {
                $this->session->set_userdata(
                    'error_msg',
                    'Invalid file, please select only CSV file.'
                );
            }
        }
        redirect('import');
    }
}

?>
