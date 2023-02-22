<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Serverside_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Serverside_model', 'serverside');
    }

    public function index()
    {
        $this->load->view('serverside/display');
    }

    public function get_data()
    {
        $columns = array(

            0 => "id",
            1 => "name",
            2 => "description",
            3 => "no_of_page",
            4 => "author",
            5 => "category",
            6 => "price",
            7 => "released_year",
            8 => "status"

        );

        $limit = $this->input->post('length'); // 5
        $start = $this->input->post('start'); // 0
        $column = $columns[$this->input->post('order')[0]['column']]; //id
        $order = $this->input->post('order')[0]['dir']; //asc

        $totalData = $this->serverside->count_all(); //26
        $totalFiltered = $totalData; // record assign

        if (empty($this->input->post('search')['value'])) {

            $books = $this->serverside->get_data($limit, $start, $column, $order);
        } else {

            $search = $this->input->post('search')['value'];
            $books =  $this->serverside->book_search($limit, $start, $search, $column, $order);
            $totalFiltered = $this->serverside->book_search_count($search);                         // record update
        }

        $data = array();
        if (!empty($books)) {
            foreach ($books as $book) {

                $row = array();
                $row['id'] = $book->id;
                $row['name'] = $book->name;
                $row['description'] = $book->description;
                $row['no_of_page'] = $book->no_of_page;
                $row['author'] = $book->author;
                $row['category'] = $book->category;
                $row['price'] = $book->price;
                $row['released_year'] = $book->released_year;
                $row['status'] = $book->status;

                $row['status'] = '<div class="form-switch"><input type="checkbox" class="form-check-input" onchange="statusData(' . $row['id'] . ',' . $row['status'] . ')" id="' . $row['id'] . '" value="' . $row['status'] . '" ' . ($row['status'] == "1" ? "checked" : "") . '/></div>';
                $row['action'] = '<a onclick="deleteData(' . $row['id'] . ')" class="deleteBtn"><i class="fa-solid fa-trash-can"></i></a>
                                  <a onclick="editData(' . $row['id'] . ')" class="editBtn"><i class="fa-solid fa-pen"></i></a>';
                $data[] = $row;
            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function insert()
    {
        
        $this->form_validation->set_rules("name", "name", "required|alpha_check");
        $this->form_validation->set_rules("desc", "description", "required");
        $this->form_validation->set_rules("no_of_page", "no_of_page", "required|numeric");
        $this->form_validation->set_rules("author", "author", "required|alpha_check");
        $this->form_validation->set_rules("category", "category", "required|alpha_check");
        $this->form_validation->set_rules("price", "price", "required|numeric");
        $this->form_validation->set_rules("released_year", "released_year", "required|numeric");

        if ($this->form_validation->run() == FALSE) {

            $errorArray = array(

                'error'   => true,
                'nameError' => form_error('name'),
                'descError' => form_error('desc'),
                'no_of_pageError' => form_error('no_of_page'),
                'authorError' => form_error('author'),
                'categoryError' => form_error('category'),
                'priceError' => form_error('price'),
                'released_yearError' => form_error('released_year'),

            );
            echo json_encode($errorArray);
            return;
        }

        $data = array(

            "user_id" => $this->session->userdata('user_id'),
            "name" => $this->input->post('name'),
            "description" => $this->input->post('desc'),
            "no_of_page" => $this->input->post('no_of_page'),
            "author" => $this->input->post('author'),
            "category" => $this->input->post('category'),
            "price" => $this->input->post('price'),
            "released_year" => $this->input->post('released_year'),
            "status" => $this->input->post('status'),

        );

        $insert = $this->serverside->insertBook($data);
        $res['error'] = true;
        $res['message'] = 'something wrong...';

        if ($insert) {
            $res['error'] = false;
            $res['message'] = 'Data Inserted Successfully';
        }
        echo json_encode($res);
    }



    public function delete($id)
    {
        $delete = $this->serverside->deleteBook($id);
        echo json_encode($delete);
    }

    public function edit($id)
    {
        $edit = $this->serverside->editBook($id);
        echo json_encode($edit);
    }

    public function update($id)
    {

    
        $this->form_validation->set_rules("name", "name", "required|alpha_check");
        $this->form_validation->set_rules("desc", "description", "required");
        $this->form_validation->set_rules("no_of_page", "no_of_page", "required|numeric");
        $this->form_validation->set_rules("author", "author", "required|alpha_check");
        $this->form_validation->set_rules("category", "category", "required|alpha_check");
        $this->form_validation->set_rules("price", "price", "required|numeric");
        $this->form_validation->set_rules("released_year", "released_year", "required|numeric");

        if ($this->form_validation->run() == FALSE) {

            $errorArray = array(

                'error'   => true,
                'nameError' => form_error('name'),
                'descError' => form_error('desc'),
                'no_of_pageError' => form_error('no_of_page'),
                'authorError' => form_error('author'),
                'categoryError' => form_error('category'),
                'priceError' => form_error('price'),
                'released_yearError' => form_error('released_year'),

            );
            echo json_encode($errorArray);
            return;
        }
        $data = array(

            "name" => $this->input->post('name'),
            "description" => $this->input->post('desc'),
            "no_of_page" => $this->input->post('no_of_page'),
            "author" => $this->input->post('author'),
            "category" => $this->input->post('category'),
            "price" => $this->input->post('price'),
            "released_year" => $this->input->post('released_year'),

        );

        $update = $this->serverside->updateBook($id, $data);
        $res['error'] = true;
        $res['message'] = 'something wrong...';

        if($update)
        {
            $res['error'] = false;
            $res['message'] = 'Data Updated Successfully';
        }
        echo json_encode($res);
    }

    public function updateStatus($id, $status)
    {
       try{

           $status = $this->serverside->update_status($id, $status);
           echo json_encode($status);

       }catch (Exception $e) {
            log_message('error: ',$e->getMessage());
            return;
    }
    }
}
