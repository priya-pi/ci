<?php defined('BASEPATH') or exit('No direct script access allowed');


require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Customer_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		
        $this->load->model('Customer_model');
        $this->load->model('Excelfile_model');

    }

    public function index()
    {
        $data['usersData'] = $this->Customer_model->getUserDetails();
        $this->load->view('customer/add', $data);
    }

    // Export data in CSV format
    public function exportCSV()
    {
        // file name
        $filename = 'users_' . date('Ymd') . '.csv';
        header('Content-Description: File Transfer');
        header("Content-Disposition: attachment; filename=$filename");
        header('Content-Type: application/csv; ');

        // get data
        $usersData = $this->Customer_model->getUserDetails();

        // file creation
        $file = fopen('php://output', 'w');

        $header = ['customer_id', 'firstname', 'lastname','email'];
        fputcsv($file, $header);
        foreach ($usersData as $key => $line) {
            fputcsv($file, $line);
        }
        fclose($file);
        exit();
    }

    // Export data in Excel format
    public function createExcel()
    {
        $fileName = 'customer.xlsx';

        $employeeData = $this->Excelfile_model->customerList();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'FirstName');
        $sheet->setCellValue('C1', 'LastName');
        $sheet->setCellValue('D1', 'Email');
        $rows = 2;

        foreach ($employeeData as $val) {
            $sheet->setCellValue('A' . $rows, $val['customer_id']);
            $sheet->setCellValue('B' . $rows, $val['firstname']);
            $sheet->setCellValue('C' . $rows, $val['lastname']);
            $sheet->setCellValue('C' . $rows, $val['email']);

            $rows++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('upload/' . $fileName);
        header('Content-Type: application/vnd.ms-excel');
        redirect(base_url() . '/upload/' . $fileName);
    }

}

?>
