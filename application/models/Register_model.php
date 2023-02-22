<?php


class Register_model extends CI_Model
{


    public function form_insert_data($data)
    {
        if($data != null)
        {
             $this->db->insert('user',$data);
            return true;
        }
        return false;
    }


}