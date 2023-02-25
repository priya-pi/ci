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

	function insertRecord($record){
 
    if(count($record) > 0){
 
      // Check user
      $this->db->select('*');
      $this->db->where('customer_id', $record[0]);
      $q = $this->db->get('customer');
      $response = $q->result_array();
 
      // Insert record
      if(count($response) == 0){
        $newuser = array(
          "customer_id" => trim($record[0]),
          "firstname" => trim($record[1]),
          "lastname" => trim($record[2]),
        );

        $this->db->insert('customer', $newuser);
      }
 
    }
 
  }
}
