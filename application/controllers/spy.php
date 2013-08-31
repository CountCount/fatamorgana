<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('System_model');
	}
	
	public function town($tid = 0) {
		$data['main_content'] = 'map_view';
		$data['gamemap'] = $this->generateTownData($tid);
		$data['debug'] = $data['secureKey'] = '';
		$data['bookmark'] = 'http://dieverdammten.net/fatamorgana/spy/town/'.$tid;
		$data['qrcode'] = 'Als Spion steht Dir leider kein QR Code zur Verfügung.';
		
		$this->load->view('includes/template', $data);
	}
	
	public function generateTownData($gid) {
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
		$data['system']['owner_name'] = 'Spion';
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
			
		return json_encode($data);
	}
}

/* End of file spy.php */
/* Location: ./application/controllers/spy.php */