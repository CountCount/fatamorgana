<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('System_model');
	}
	
	public function index() {
		$data['api'] = json_encode(array('error' => 'Invalid mode'));
		header('Content-type: text/javascript');
		$this->load->view('api', $data);
	}
	
	public function town($tid = 0, $key = null) {
		if ( $tid == 0 || !is_numeric($tid) ) {
			$data['api'] = json_encode(array('error' => 'Invalid game ID'));
		}
		else {
			if ( $this->validateKey($key) ) {
				$data['api'] = $this->generateData($tid, 'town');
			}
			else {
				$data['api'] = json_encode(array('error' => 'Invalid key'));
			}
		}		
		header('Content-type: text/javascript');
		$this->load->view('api', $data);
	}
	
	public function map($tid = 0, $key = null) {
		if ( $tid == 0 || !is_numeric($tid) ) {
			$data['api'] = json_encode(array('error' => 'Invalid game ID'));
		}
		else {
			if ( $this->validateKey($key) ) {
				$data['api'] = $this->generateData($tid, 'map');
			}
			else {
				$data['api'] = json_encode(array('error' => 'Invalid key'));
			}
		}
		header('Content-type: text/javascript');
		$this->load->view('api', $data);
	}
	
	private function validateKey($key = null) {
		$keys = array(
			'verdammtentabellen' => '3225-4f2e-8fc4',
			'geheimeruine' => 'b740-41f3-9111',
			'nobbz' => '281e-5be4-7125',
			'zombietranslator' => '5073-f970-ddb5',
		);
		if ( in_array($key, $keys) ) {
			return true;
		}
		return false;
	}
	
	public function generateData($gid, $mode = 'town') {
		if ( $data = $this->System_model->getTownData($gid) ) {
			// continue
		}
		else {
			// fail
			$data = array();
		}
		
		$item_stat = false;
		$item_file = dirname(dirname(dirname( __FILE__ ))) . '/data/common/items';
		if ( file_exists($item_file) ) {
			$item_stat = stat($item_file);
			$item_data = unserialize(file_get_contents($item_file));
		}
		
		// owner update
		$data['system']['owner_name'] = 'API';
		$data['system']['owner_id'] = 0;
		$data['system']['autoUpdateEnabled'] = 0;
		$data['spy'] = 1;
		if ( isset($data['tx']) ) {
			$data['ox'] = $data['tx'];
			$data['oy'] = $data['ty'];
		}
		else {
			$data['ox'] = 0;
			$data['oy'] = 0;
		}
		if ( $mode == 'town' ) {	
			return json_encode($data);
		}
		elseif ( $mode == 'map' ) {	
			return json_encode($data['map']);
		}
	}
}

/* End of file spy.php */
/* Location: ./application/controllers/spy.php */