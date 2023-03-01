<?php defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
		$output_file_name = 'csv_export_ci.csv';
        header('Content-Description: File Transfer');
        header("Content-Disposition: attachment; filename=$output_file_name");
        header('Content-Type: application/csv; ');
		
        $usersData = $this->Customer_model->getUserDetails();
        $file = fopen('php://output', 'w');
        $header = ['Sr No.', 'firstname', 'lastname', 'email'];
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

        $fileName = 'excel_export_ci.xlsx';
        $employeeData = $this->Excelfile_model->customerList();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Sr No.');
        $sheet->setCellValue('B1', 'FirstName');
        $sheet->setCellValue('C1', 'LastName');
        $sheet->setCellValue('D1', 'Email');
		
        $rows = 2;
        foreach ($employeeData as $key => $val) {
			$sheet->setCellValue('A' . $rows, $key+1);
            $sheet->setCellValue('B' . $rows, $val['firstname']);
            $sheet->setCellValue('C' . $rows, $val['lastname']);
            $sheet->setCellValue('D' . $rows, $val['email']);
            $rows++;
        }
		
		$sheet->getStyle('A1:D1')->applyFromArray([
			'fill' => [
				'type' => Fill::FILL_SOLID,
				'color' => ['rgb' => 'E5E4E2'],
			],
			'font' => [
				'bold' => true,
			],
		]);
		foreach (range('A6','D6') as $col) {
			$sheet->getColumnDimension($col)->setAutoSize(true); 	 
		}
		
        $writer = new Xlsx($spreadsheet);
        $writer->save('upload/' . $fileName);
        header('Content-Type: application/vnd.ms-excel');
        redirect(base_url() . '/upload/' . $fileName);
    }
}

?>
