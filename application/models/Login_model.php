<?php

class Login_model extends CI_Model
{

    public function login_user($email, $password)
    {
       
        $this->db->where('email', $email);
        $query =  $this->db->get('user');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $store_password = $this->encryption->decrypt($row->password);
                if ($password == $store_password) {

                    $this->session->set_userdata('user_id', $row->id);
                    return true;

                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function change_password($user_id, $new)
    {
        return  $this->db->set('password', $new)
            ->where('id', $user_id)
            ->update('user');
    }

    public function get_password($user_id, $old)
    {
        $query = $this->db->where('id', $user_id)->get('user');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                $store_password = $this->encryption->decrypt($row->password);
                if ($old == $store_password) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
}
