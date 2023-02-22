<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('display_errors', 0);

class CurlBook_demo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('api/addbook');
    }

    public function store()
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://127.0.0.1:8000/api/books',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => [
                'user_id' => 3,
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'no_of_page' => $this->input->post('no_of_page'),
                'author' => $this->input->post('author'),
                'category' => $this->input->post('category'),
                'price' => $this->input->post('price'),
                'released_year' => $this->input->post('released_year'),
                'status' => $this->input->post('status'),
            ],
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTFjZjZmNTZjZTJjZjQzMDIxOWFjNWNhMWE5MDljYjhkOGZhYjkxMzdjNjkxZjZhNjVkYWM4NmQxZGNkNWIyYTVmZjBkMGY0NGE2MTBjNDgiLCJpYXQiOjE2NzYwOTIwMzkuMTg5NjI1LCJuYmYiOjE2NzYwOTIwMzkuMTg5NjM2LCJleHAiOjE3MDc2MjgwMzkuMTg0NjM1LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.PTv_7Vh3eBuRJuP380dmfHNDNYDrxRDvf8SItmyv990rpChpKEMenFhrQKA-iW8klzigEZImPV7nzKCLkCXheUM5TGLJj-ttIvHDxzds_e82__pAuN7PTr49W0HqJ_e5WGUVttOFRqiY3c0Vv0hz8yw2wT7r5B1oO1Viskhpgl4wg-dEp5fOsbRPjcGFGBaqlxjyvnwIWoX-XIJdZ0eJvjPsqHa4LtsScR7g6Rcz7CXPqgrvVtK2SKPMIFTdLxNOalzoHqS-DnPnK_mTxqEtEhjP5gZBJh8Fe3ucT3UxhpYN647_8jafC2zTzZndgVuiiwMHKaF146Kywn3bKCFTvuwTo_GkfHngJIzuHU0zueLj_UhhTpdEiTRlEnQ__WLfeZsyZhNPJa1XSQRVzFUI4QkV89CnSU_pXLxv-OscRvYBcURga49uqb4Yo3gROHRIokbeBUinU0SxXO9iBz8lvuY__xy0zGm0NkEMzjrm1qbZ83hu7XTMPZMNdJxoTTeer8fx06ocpG1LJ89LkiGcDRTD_71ydPp1YNbiw1Muml6Qo_oQvjVurow6o71bDoVCCxTQcELhF34Uc0RRo0z3fjoDAt8Dg7tYO8CXr-GDJ1DQjG5Ac9BViutuo9vOEtvvKjtHOdBMx-54DfiIaFyYdltdN-ejGRc_cdeMqjuxufM',
            ],
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

    public function delete()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://127.0.0.1:8000/api/books/7',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzFjN2FkM2JhYmE2YzIwMmI4MTBlM2E4MzU1YTdjNDVlZDAyNWE5NzY0NzQ0NWYzMzkwOTk0OThiNGM0NzIyNWI4YTQ4NTUyN2M2N2RjZDciLCJpYXQiOjE2NzY5NTk5MDUuOTU0NDYyLCJuYmYiOjE2NzY5NTk5MDUuOTU0NDgxLCJleHAiOjE3MDg0OTU5MDUuOTQ5MzEsInN1YiI6IjUiLCJzY29wZXMiOltdfQ.QxlBaDE6oMAtiEUJdaDDu6j01nrhfXmzmx0H_bCjezt8beOPqp0PnJ-hlGDIe-3cboKH14uM5dx7trysknAqttuhdnAI8oG0rJh4s63P5zecLgTKzSwyZ19nZha7hoqnPEN94SoXsUmmOnPXQ4_tGlG5Q5sTlGpYngFrQ8pUzaIYAxJwqChglgHfwahAacQVRkVc-yHLTQVJmFVNENwRYH8ojw5ozvLm65js3B7sIn7BauP_mwyO6jdM9jFDKB48-RzBubbL-M8a2AWtbWkkDwCeDnh8dP6NmHCX1M38l9TenYHsuZbHI5qUnvcGpXKUJphczukBMf5RkF4OEsSxAAJt8o7-nxhjZ8ygMuAS3pWhwAFDDLn1HGwziWp8aOnHJ7g1zKPQhR7nfQJ5AznHTEpEcVHMfQEYSkuGjkKUiWI4lYKzsEA6vI3x8Ae8YzrFw_XGn43i1oojIx6KdRIko_7MSHvIrpE_gsFTXWP_AdV-oMpv4dL78JUAS3zOs3z_YiwEqElOi2QMAnKQ4A8dtAfp1Zr98uCfteKDDk551c6Befcs9Vv8NoUik9yYvyXy-HJxiNX7U3UO3-lXnox6AgT3JcMne9-p2rju45OrJp0z0F5yPz1cAAbx9p8thd1CM2s5aIOY4TvTI02fwf7KGP-NcQLcWWafEYqKB07gEkA',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $response_data = json_decode($response);

        echo '<pre>';
        pr($response_data);
        echo '</pre>';
    }

    public function getdata()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://127.0.0.1:8000/api/books',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTFjZjZmNTZjZTJjZjQzMDIxOWFjNWNhMWE5MDljYjhkOGZhYjkxMzdjNjkxZjZhNjVkYWM4NmQxZGNkNWIyYTVmZjBkMGY0NGE2MTBjNDgiLCJpYXQiOjE2NzYwOTIwMzkuMTg5NjI1LCJuYmYiOjE2NzYwOTIwMzkuMTg5NjM2LCJleHAiOjE3MDc2MjgwMzkuMTg0NjM1LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.PTv_7Vh3eBuRJuP380dmfHNDNYDrxRDvf8SItmyv990rpChpKEMenFhrQKA-iW8klzigEZImPV7nzKCLkCXheUM5TGLJj-ttIvHDxzds_e82__pAuN7PTr49W0HqJ_e5WGUVttOFRqiY3c0Vv0hz8yw2wT7r5B1oO1Viskhpgl4wg-dEp5fOsbRPjcGFGBaqlxjyvnwIWoX-XIJdZ0eJvjPsqHa4LtsScR7g6Rcz7CXPqgrvVtK2SKPMIFTdLxNOalzoHqS-DnPnK_mTxqEtEhjP5gZBJh8Fe3ucT3UxhpYN647_8jafC2zTzZndgVuiiwMHKaF146Kywn3bKCFTvuwTo_GkfHngJIzuHU0zueLj_UhhTpdEiTRlEnQ__WLfeZsyZhNPJa1XSQRVzFUI4QkV89CnSU_pXLxv-OscRvYBcURga49uqb4Yo3gROHRIokbeBUinU0SxXO9iBz8lvuY__xy0zGm0NkEMzjrm1qbZ83hu7XTMPZMNdJxoTTeer8fx06ocpG1LJ89LkiGcDRTD_71ydPp1YNbiw1Muml6Qo_oQvjVurow6o71bDoVCCxTQcELhF34Uc0RRo0z3fjoDAt8Dg7tYO8CXr-GDJ1DQjG5Ac9BViutuo9vOEtvvKjtHOdBMx-54DfiIaFyYdltdN-ejGRc_cdeMqjuxufM',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $response_data = json_decode($response);

        echo '<pre>';
        pr($response_data);
        echo '</pre>';
    }

    public function edit()
    {
        $this->load->view('api/editbook');
    }

    public function update()
    {
        $curl = curl_init();
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'no_of_page' => $this->input->post('no_of_page'),
            'author' => $this->input->post('author'),
            'category' => $this->input->post('category'),
            'price' => $this->input->post('price'),
            'released_year' => $this->input->post('released_year'),
            'status' => $this->input->post('status'),
        ];
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://127.0.0.1:8000/api/books/13',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMzFjN2FkM2JhYmE2YzIwMmI4MTBlM2E4MzU1YTdjNDVlZDAyNWE5NzY0NzQ0NWYzMzkwOTk0OThiNGM0NzIyNWI4YTQ4NTUyN2M2N2RjZDciLCJpYXQiOjE2NzY5NTk5MDUuOTU0NDYyLCJuYmYiOjE2NzY5NTk5MDUuOTU0NDgxLCJleHAiOjE3MDg0OTU5MDUuOTQ5MzEsInN1YiI6IjUiLCJzY29wZXMiOltdfQ.QxlBaDE6oMAtiEUJdaDDu6j01nrhfXmzmx0H_bCjezt8beOPqp0PnJ-hlGDIe-3cboKH14uM5dx7trysknAqttuhdnAI8oG0rJh4s63P5zecLgTKzSwyZ19nZha7hoqnPEN94SoXsUmmOnPXQ4_tGlG5Q5sTlGpYngFrQ8pUzaIYAxJwqChglgHfwahAacQVRkVc-yHLTQVJmFVNENwRYH8ojw5ozvLm65js3B7sIn7BauP_mwyO6jdM9jFDKB48-RzBubbL-M8a2AWtbWkkDwCeDnh8dP6NmHCX1M38l9TenYHsuZbHI5qUnvcGpXKUJphczukBMf5RkF4OEsSxAAJt8o7-nxhjZ8ygMuAS3pWhwAFDDLn1HGwziWp8aOnHJ7g1zKPQhR7nfQJ5AznHTEpEcVHMfQEYSkuGjkKUiWI4lYKzsEA6vI3x8Ae8YzrFw_XGn43i1oojIx6KdRIko_7MSHvIrpE_gsFTXWP_AdV-oMpv4dL78JUAS3zOs3z_YiwEqElOi2QMAnKQ4A8dtAfp1Zr98uCfteKDDk551c6Befcs9Vv8NoUik9yYvyXy-HJxiNX7U3UO3-lXnox6AgT3JcMne9-p2rju45OrJp0z0F5yPz1cAAbx9p8thd1CM2s5aIOY4TvTI02fwf7KGP-NcQLcWWafEYqKB07gEkA',
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        $response_data = json_decode($response);

        echo '<pre>';
        pr($response_data);
        echo '</pre>';

        exit();
    }
}
