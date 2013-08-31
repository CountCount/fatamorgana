<?php

class System_model extends CI_Model {

	public $secureXML = null;
	
	public function __construct() {
		parent::__construct();
	}
	
	public function check() {
		// Check login status
		$logged_in = $this->session->userdata('logged_in');
		return (isset($logged_in) && $logged_in == true ? $this->session->userdata('user_skey') : false);
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
			$status[1] = 'Your secure ID is present, secure XML stream is available.';
		}
		else {
			$status[1] = 'Your secure ID is <strong>not</strong> present, secure XML stream is <strong>not</strong> available.';
		}
		
		return $status;
	}
	
	public function getXMLstamp() {
		$okey = $this->session->userdata('user_okey');
		$skey = $this->session->userdata('user_skey');
		
		#$status = simplexml_load_file('http://www.die2nite.com/xml/status');
		return time();
	}
	
	public function getXMLsecure() {
		if ( $this->secureXML !== null ) {
			return $this->secureXML;
		}
		else {
			return $this->retrieveXMLsecure();
		}
	}
	
	public function retrieveXMLsecure($skey = null) {
		if ( is_null($skey) ) {
			$skey = $this->session->userdata('user_skey');
		}
		$sk = '0e84fc3f18639132a9988a3c25539ff1';
		$xml = simplexml_load_file('http://www.zombinoia.com/xml/?k='.$skey.';sk='.$sk);
		$this->secureXML = $xml;
		return $xml;
	}
	
	public function getTownData($tid) {
		$sql = "SELECT data FROM towndata WHERE tid = ? ORDER BY timestamp DESC LIMIT 1"; 
		$q = $this->db->query($sql, array($tid));
		if ($q->num_rows() > 0) {
			 $row = $q->row(); 
			 return unserialize($row->data);
		}
		return false;
	}
	public function saveTownData($tid,$day,$uid,$data) {
		$sql = "INSERT INTO towndata VALUES (?,?,?,?,?) ON DUPLICATE KEY UPDATE data = ?, timestamp = ?"; 
		$q = $this->db->query($sql, array($tid,$day,$uid,$data,time(),$data,time()));
		return $q;
	}


}