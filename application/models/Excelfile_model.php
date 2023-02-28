<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excelfile_model extends CI_Model {


	public function customerList() {
		
		$this->db->select(array('customer_id', 'firstname', 'lastname','email'));
		$this->db->from('customer');
		$query = $this->db->get();
		return $query->result_array();
	}

}
?>
