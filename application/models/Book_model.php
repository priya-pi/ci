<?php

class Book_model extends CI_Model
{

    public function getbook_data($limit, $start, $column, $order)
    {
        $loginUserId = $this->session->userdata('user_id');

        $this->db->select('*');
        $this->db->from('book');
        $this->db->where('user_id', $loginUserId);
        $this->db->order_by($column, $order);
        $this->db->limit($limit, $start);
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
            ->order_by($column, $order)
            ->limit($limit, $start)
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

    public function bookSearch_total($search)
    {

        $loginUserId = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('book');
        $this->db->where('user_id', $loginUserId);
        $this->db->like('id', $search, 'both')
            ->or_like('name', $search, 'both')
            ->or_like('no_of_page', $search, 'both')
            ->or_like('author', $search, 'both')
            ->or_like('category', $search, 'both')
            ->or_like('price', $search, 'both')
            ->or_like('released_year', $search, 'both');
        $query = $this->db->get();
        return $query->num_rows();

    }

    public function insert_book($data)
    {
        return $this->db->insert('book', $data);
    }

    public function delete_book($id)
    {
        return $this->db->delete('book', array('id' => $id));
    }

    public function edit_book($id)
    {

        $edit = $this->db->where('id', $id)->get('book')->row();
        return $edit;
    }

    public function update_book($id, $data)
    {
        return $this->db->where('id', $id)->update('book', $data);
    }

    public function update_status($id, $status)
    {
        return $this->db->set('status', $status)->where('id', $id)->update('book');
    }
}
