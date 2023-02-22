<?php
defined('BASEPATH') or exit('No direct script access allowed');
ini_set('display_errors', 0);  

class Book_controller extends CI_Controller
{
    public $book_item;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Book_model');
        $this->book_item = new Book_model;
    }

    public function get_books()
    {

        if ($this->session->has_userdata('user_id')) {

            $columns = array('id', 'name', 'description', 'no_of_page', 'author', 'category', 'price', 'released_year');
            $column = $this->input->get('column') && in_array($this->input->get('column'), $columns) ? $this->input->get('column') : $columns[0];
            $order = $this->input->get('order') && $this->input->get('order') == 'desc' ? 'desc' : 'asc';
            $up_or_down = str_replace(array('asc', 'desc'), array('up', 'down'), $order);
            $asc_or_desc = $order == 'asc' ? 'desc' : 'asc';

            $search = $this->input->get('search');
            $limit = $this->input->get('length') ? $this->input->get('length') : 5;
            $page = $this->uri->segment(3) ?? 1;

            $totalRow = $this->book_item->count_all();
            $totalfiltered = $this->book_item->bookSearch_total($search);
            $totalfiltered = $totalRow;
            $start = ($page - 1) * $limit;
            $totalpage = ceil($totalfiltered / $limit);

            $config['base_url'] = base_url() . 'crud_demo/dashboard';
            $config['total_rows'] = $totalfiltered;
            $config['per_page'] = $limit;
            $config['use_page_numbers'] = true;
            $config["num_links"] = $totalpage;

            $data['up_or_down'] = $up_or_down;
            $data['asc_or_desc'] = $asc_or_desc;
            $data['limit'] = $limit;
            $data['start'] = $start;
            $data['column'] = $column;
            $data['order'] = $order;
            $data['search'] = $search;
            $data['page'] = $page;

            if (empty($search)) {
                $data['data'] = $this->book_item->getbook_data($limit, $start, $column, $order);
            } else {
                
                $data['data'] = $this->book_item->book_search($limit, $start, $search, $column, $order);
                $config['total_rows'] = $this->book_item->bookSearch_total($search); // record update
            }
            $this->pagination->initialize($config);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('crud/dashboard', $data);

        } else {

            redirect(base_url() . 'crud_demo/login');
        }
    }

    public function store()
    {
        $this->form_validation->set_rules("name", "name", "required|alpha_check");
        $this->form_validation->set_rules("description", "description", "required");
        $this->form_validation->set_rules("no_of_page", "no_of_page", "required|numeric");
        $this->form_validation->set_rules("author", "author", "required|alpha_check");
        $this->form_validation->set_rules("category", "category", "required|alpha_check");
        $this->form_validation->set_rules("price", "price", "required|numeric");
        $this->form_validation->set_rules("released_year", "released_year", "required|numeric");
        $this->form_validation->set_rules("status", "status", "required");

        if ($this->form_validation->run() == false) {
            $this->load->view('crud/add');
        } else {

            $data = array(

                "name" => $this->input->post('name'),
                "user_id" => $this->session->userdata('user_id'),
                "description" => $this->input->post('description'),
                "no_of_page" => $this->input->post('no_of_page'),
                "author" => $this->input->post('author'),
                "category" => $this->input->post('category'),
                "price" => $this->input->post('price'),
                "released_year" => $this->input->post('released_year'),
                "status" => $this->input->post('status'),

            );

            $this->book_item->insert_book($data);
            $this->session->set_flashdata('success', 'Book Inserted successfully');
            redirect(base_url('crud_demo/dashboard'));
        }
    }

    public function delete($id)
    {

        if ($id != null && is_numeric($id)) {
            $delete = $this->book_item->delete_book($id);
            $this->session->set_flashdata('delete', 'Book Deleted successfully');
            echo json_encode($delete);

        } else {
            redirect(base_url('crud_demo/dashboard'));
        }

    }

    public function edit($id)
    {

        if ($id != null && is_numeric($id)) {
            $book = $this->book_item->edit_book($id);
            echo json_encode($book);

        } else {
            redirect(base_url('crud_demo/dashboard'));
        }
    }

    public function update($id)
    {

        if ($id != null && is_numeric($id)) {

            $this->form_validation->set_rules("name", "name", "required|alpha_check");
            $this->form_validation->set_rules("desc", "desc", "required");
            $this->form_validation->set_rules("no_of_page", "no_of_page", "required|numeric");
            $this->form_validation->set_rules("author", "author", "required|alpha_check");
            $this->form_validation->set_rules("category", "category", "required|alpha_check");
            $this->form_validation->set_rules("price", "price", "required|numeric");
            $this->form_validation->set_rules("released_year", "released_year", "required|numeric");

            if ($this->form_validation->run() == false) {

                $errorArray = array(

                    'error' => true,
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

            $update = $this->book_item->update_book($id, $data);
            $this->session->set_flashdata('success', 'Book Updated successfully');
            echo json_encode($update);

        } else {
            redirect(base_url('crud_demo/dashboard'));
        }
    }

    public function updateStatus($id, $status)
    {

        if ($id != null && is_numeric($id) && $status != null && is_numeric($status)) {
            $this->session->set_flashdata('success', 'Status Updated successfully');
            $status = $this->book_item->update_status($id, $status);
            echo json_encode($status);
        } else {
            redirect(base_url('crud_demo/dashboard'));
        }
    }    


}
