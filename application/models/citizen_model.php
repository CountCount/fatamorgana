<?php

class Citizen_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function load_user_by_skey($key) {
		$this->db->where('skey', $key);
		$q = $this->db->get('citizen');
		
		if ($q->num_rows == 1) {
			return $q;
		}
		return false;
	}
	
	public function save_user_from_xml() {
		$this->db->where('skey', $this->input->post('user_name'));
		$q = $this->db->get('citizen');
		
		if ($q->num_rows == 1) {
			// exists -> update
			return true;
		}
		else {
			// new -> insert
		}
	}
	
	public function load_user() {
		$this->db->where('name', $this->input->post('user_name'));
		$this->db->where('okey', $this->input->post('user_okey'));
		$q = $this->db->get('citizen');
		
		if ($q->num_rows == 1) {
			return true;
		}
		return false;
	}
	
	public function save_user() {
		$this->db->where('name', $this->input->post('user_name'));
		$q = $this->db->get('citizen');
		
		if ($q->num_rows == 1) {
			// exists -> update
			return true;
		}
		else {
			// new -> insert
		}
	}

}