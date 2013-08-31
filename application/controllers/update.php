<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Update extends CI_Controller {

	public $key = null;

	public function __construct() {
		parent::__construct();
		#$this->load->controller('Login');
		if (!$this->key = $this->input->post('key')) {
			$this->key = $this->input->get('key');
		}
		#$this->Login_controller->skey($this->key);
		$this->load->model('System_model');
	}
	
	public function mapindex() {
		$data['main_content'] = 'map_view';
		$data['secureKey'] = $this->key;
		$data['user_name'] = $this->session->userdata('user_name');
		$data['gamemap'] = $this->generateData();
		$data['debug'] = $this->debug;
		$data['qrcode'] = $this->generateQR('http://dv.sindevel.com/fm/login/skey/'.$this->key);
		
		$this->load->view('includes/template', $data);
	}
	public function index() {
		/*
		if ( $xml = $this->System_model->retrieveXMLsecure($this->key) ) {
			$game = $xml->headers->game;
			$day = (int) $game['days'];
		
			$this->load->view('includes/xtemplate', array('response' => var_export($day,true)));
		}
		else {
			$this->load->view('includes/xtemplate', array('response' => $this->key));
		}
		#*/
		#/*
		$xml = $this->System_model->retrieveXMLsecure($this->key);
		$game = $xml->headers->game;
		$day = (int) $game['days'];
		$gid = (int) $game['id'];
		$owner = $xml->headers->owner->citizen;
		$username = (string) $owner['name'];
		$userid = (string) $owner['id'];
		$x = (string) $owner['x'];
		$y = (string) $owner['y'];
		$city = $xml->data->city;
		$cityx = (string) $city['x'];
		$cityy = (string) $city['y'];
		$myzone = $xml->headers->owner->myZone;
		$data['system']['hard'] = $hard = (int) $city['hard'];
		$data['system']['chaos'] = $chaos = (int) $city['chaos'];
		
		#$this->dm($myzone);
		
		if ( $data = $this->System_model->getTownData($gid) ) {
			if ( $hard == 0 && $chaos == 0 ) {
				// regeneration
				$data['map']['y'.$y]['x'.$x]['dried'] = (int) $myzone['dried'];
				// zombies
				$data['map']['y'.$y]['x'.$x]['z'] = (int) $myzone['z'];
				// items
				$items = array();
				if ( count((array) $myzone->item) > 0 ) {
					foreach ( $myzone->item AS $item ) {
						$items[] = array(
							'id' => ((int) $item['broken'] == 1 ? ((-1) * ((int) $item['id'])) : ((int) $item['id'])),
							'count' => (int) $item['count'],
							'broken' => (int) $item['broken'],
						);
					}
				}
				$data['map']['y'.$y]['x'.$x]['items'] = $items;
				// user
				$data['map']['y'.$y]['x'.$x]['updatedOn'] = time();
				$data['map']['y'.$y]['x'.$x]['updatedBy'] = $username;

				// save 2 db
				$this->System_model->saveTowndata($gid,$data['system']['day'],$userid,serialize($data));
				
				// response
				$response = 'Fata Morgana wurde aktualisiert.';
			}
			else {
				$response = 'Pandemonium town or in chaos mode! Please log in to update manually!';
			}
		}
		else {
			$response = 'Game data not found! Please log in first!';
		}

		$this->load->view('includes/xtemplate', array('response' => $response));
		#*/
	}
	
	public function manual() {
		$xml = $this->System_model->retrieveXMLsecure($this->key);
		$owner = $xml->headers->owner->citizen;
		$username = (string) $owner['name'];
		$userid = (string) $owner['id'];
		$x = (string) $owner['x'];
		$y = (string) $owner['y'];
		$game = $xml->headers->game;
		$gid = (int) $game['id'];
		 
		$append = '';
		if ( $data = $this->System_model->getTownData($gid) ) {
			// MANUAL UPDATE
			$item_stat = false;
			$item_file = dirname(dirname(dirname( __FILE__ ))) . '/data/common/items';
			if ( file_exists($item_file) ) {
				$item_stat = stat($item_file);
				$item_data = unserialize(file_get_contents($item_file));
			}
			
			$transfer = explode(';',(string) $_GET['gil']);
			$gil = $items = array();
			foreach ($transfer AS $timg) {
				$broken = 0;
				if (substr($timg,0,7) == 'broken-') {
					$timg = substr($timg,7);
					$broken = 1;
				}
				foreach ($item_data AS $i => $d) {
					if ($i < 1) { continue; }
					if ( $d['image'] == $timg ) {
						$iid = $d['id'];
						if ( $broken == 1 ) { $iid *= -1; }
						if (isset($gil[$iid])) {
							$gil[$iid]++;
						}
						else {
							$gil[$iid] = 1;
						}
						break;
					}
				}
			}
			$msg = 'Es wurden folgende Gegenstände registriert:\n';
			foreach ( $gil AS $id => $count ) {
				$msg .= $count . 'x ' . str_replace("'",'`',$item_data[$id]['name']) . ($id < 0 ? ' (kaputt)' : '') . '\n';
				$items[] = array(
						'id' => $id,
						'count' => $count,
						'broken' => ($id < 0 ? 1 : 0),
					);
			}			
			$msg .= '\n';
			
			$msg .= 'Die Zone wurde als '.((int) $_GET['d'] == 1 ? 'nicht ' : '').'buddelbar markiert.\n';
			$msg .= (int) $_GET['z'] . ' Zombie(s) wurden eingetragen.';
			
			$data['map']['y'.((int) $owner['y'])]['x'.((int) $owner['x'])]['items'] = $items;
			$data['map']['y'.((int) $owner['y'])]['x'.((int) $owner['x'])]['dried'] = (int) $_GET['d'];
			$data['map']['y'.((int) $owner['y'])]['x'.((int) $owner['x'])]['z'] = (int) $_GET['z'];
			$data['map']['y'.((int) $owner['y'])]['x'.((int) $owner['x'])]['updatedOn'] = time();
			$data['map']['y'.((int) $owner['y'])]['x'.((int) $owner['x'])]['updatedBy'] = (string) $owner['name'];
			
			if ( $this->System_model->saveTowndata($data['system']['gameid'],$data['system']['day'],$userid,serialize($data)) ) {
				$msg .= '\n\nAktualisierung erfolgreich.';
			}
			else {
				$msg .= '\n\nFehler beim Schreiben der Daten.';
			}
		}
		else {
			$msg = 'Die Stadtdaten konnten nicht korrekt geladen werden.\nBitte versuche es erneut oder besuche die Fata Morgana.';
		}
		
		$data['msg'] = $msg;
		header('Content-type: text/javascript');
		$this->load->view('manualupdate', $data);
	}

	public function dm($var) {
		mail('ovaloffice.dv@googlemail.com', 'Debug', '<html><body>Debug message<br><pre>'.var_export($var,true).'</pre></body></html>', "From: fm@sindevel.com\nContent-Type: text/html; charset=utf-8");
	}
}

/* End of file update.php */
/* Location: ./application/controllers/update.php */