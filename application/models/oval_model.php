<?php

class Oval_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	
	public function check() {
		// Check login status
		$logged_in = $this->session->userdata('logged_in');
		return (isset($logged_in) && $logged_in == true);
	}
	
	public function status() {
		$okey = $this->session->userdata('user_okey');
		$skey = $this->session->userdata('user_skey');
		
		$status = array();
		
		if (isset($okey) && $okey != '') {
			$status[0] = 'Your standard external ID is present, open XML stream is available.';
		}
		else {
			$status[0] = 'Your standard external ID is <strong>not</strong> present, open XML stream is <strong>not</strong> available.';
		}
		
		if (isset($skey) && $skey != '') {
			$status[1] = 'Your secure Oval Office ID is present, secure XML stream is available.';
		}
		else {
			$status[1] = 'Your secure Oval Office ID is <strong>not</strong> present, secure XML stream is <strong>not</strong> available.';
		}
		
		return $status;
	}
	
	public function getXMLstamp() {
		$okey = $this->session->userdata('user_okey');
		$skey = $this->session->userdata('user_skey');
		
		#$status = simplexml_load_file('http://www.die2nite.com/xml/status');
		return time();
	}


}