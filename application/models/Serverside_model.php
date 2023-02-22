<?php

class Serverside_model extends CI_Model
{

    public function get_data($limit, $start, $column, $order)
    {

        $loginUserId = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('book');
        $this->db->where('user_id', $loginUserId);
        $this->db->limit($limit, $start);
        $this->db->order_by($column, $order);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function book_search($limit, $start, $search, $column, $order)
    {
        $query = $this->db->like('id', $search)
            ->or_like('name', $search)
            ->or_like('description', $search)
            ->or_like('no_of_page', $search)
            ->or_like('author', $search)
            ->or_like('category', $search)
            ->or_like('price', $search)
            ->or_like('released_year', $search)
            ->limit($limit, $start)
            ->order_by($column, $order)
            ->get('book');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function count_all()
    {
        $loginUserId = $this->session->userdata('user_id');
        
        $this->db->where('user_id', $loginUserId);
        $query = $this->db->get('book');
        return $query->num_rows();
    }

    public function book_search_count($search)
    {
        $loginUserId = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('book');
        $this->db->where('user_id', $loginUserId);
        $query = $this->db->like('id', $search)
            ->or_like('name', $search)
            ->or_like('description', $search)
            ->or_like('no_of_page', $search)
            ->or_like('author', $search)
            ->or_like('category', $search)
            ->or_like('price', $search)
            ->or_like('released_year', $search)
            ->get();

        return $query->num_rows();
    }

    public function insertBook($data)
    {
        return $this->db->insert('book', $data);
    }

    public function deleteBook($id)
    {
        return $this->db->delete('book', array('id' => $id));
    }

    public function editBook($id)
    {
        return $this->db->get_where('book', array('id' => $id))->row();
    }

    public function updateBook($id, $data)
    {
        return $this->db->where('id', $id)->update('book', $data);
    }

    public function update_status($id, $status)
    {
        return $this->db->set('status', $status)->where('id', $id)->update('book');
    }
}
