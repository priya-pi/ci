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

    function insert($memData)
    {
        if (!empty($memData)) {
            $insert = $this->db->insert_batch($this->table, $memData);
            return $insert;
        }
        return false;
    }

    public function update($memData, $condition)
    {
        if (!empty($memData)) {
            $update = $this->db->update_batch(
                $this->table,
                $memData,
                $condition
            );
            return $update;
        }
        return false;
    }
}
