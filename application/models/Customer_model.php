<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends CI_Model {

  function getUserDetails(){
 
    $response = array();
 
    // Select record
    $this->db->select('customer_id,firstname,lastname');
    $q = $this->db->get('customer');
    $response = $q->result_array();
 
    return $response;
  }


}
