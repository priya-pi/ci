<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customer_model extends CI_Model
{
    function __construct()
    {
        $this->table = 'customer';
    }

    function getUserDetails()
    {
        $response = [];

        // Select record
        $this->db->select('customer_id,firstname,lastname,email');
        $q = $this->db->get('customer');
        $response = $q->result_array();

        return $response;
    }

    function getRows($params = [])
    {
        $this->db->select('*');
        $this->db->from($this->table);

        if (array_key_exists('where', $params)) {
            foreach ($params['where'] as $key => $val) {
                $this->db->where($key, $val);
            }
        }

        if (
            array_key_exists('returnType', $params) &&
            $params['returnType'] == 'count'
        ) {
            $result = $this->db->count_all_results();
        } else {
            if (array_key_exists('customer_id', $params)) {
                $this->db->where('customer_id', $params['customer_id']);
                $query = $this->db->get();
                $result = $query->row_array();
            } else {
                $this->db->order_by('customer_id', 'asc');
                if (
                    array_key_exists('start', $params) &&
                    array_key_exists('limit', $params)
                ) {
                    $this->db->limit($params['limit'], $params['start']);
                } elseif (
                    !array_key_exists('start', $params) &&
                    array_key_exists('limit', $params)
                ) {
                    $this->db->limit($params['limit']);
                }

                $query = $this->db->get();
                $result =
                    $query->num_rows() > 0 ? $query->result_array() : false;
            }
        }

        // Return fetched data
        return $result;
    }

    public function insert($data = [])
    {
        if (!empty($data)) {
            // Add created and modified date if not included
            if (!array_key_exists('created', $data)) {
                $data['created'] = date('Y-m-d H:i:s');
            }
            if (!array_key_exists('modified', $data)) {
                $data['modified'] = date('Y-m-d H:i:s');
            }

            // Insert member data
            $insert = $this->db->insert($this->table, $data);

            // Return the status
            return $insert ? $this->db->insert_id() : false;
        }
        return false;
    }

    public function update($data, $condition = [])
    {
        if (!empty($data)) {
            // Add modified date if not included
            if (!array_key_exists('modified', $data)) {
                $data['modified'] = date('Y-m-d H:i:s');
            }

            // Update member data
            $update = $this->db->update($this->table, $data, $condition);

            // Return the status
            return $update ? true : false;
        }
        return false;
    }

}
