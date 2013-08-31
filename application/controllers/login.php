<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('System_model');
		$check = $this->System_model->check();
		if ($check) {
			redirect('map');
		}
	}
	
	public function skey($key) {
		$data = array(
			'user_skey' => $key,
			'logged_in' => true,
		);
		$this->session->set_userdata($data);
		redirect('map');
	}
	
	public function index()
	{
		$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);
	}
	
	public function validate()
	{
		$this->load->model('Citizen_model');
		$q = $this->Citizen_model->load_user();
		
		if ($q) {
			$data = array(
				'user_name' => $this->input->post('user_name'),
				'user_okey' => $this->input->post('user_okey'),
				'user_skey' => $this->input->post('user_skey'),
				'logged_in' => true,
			);
			
			$this->session->set_userdata($data);
			redirect('map');
		}
		else {
			$data['main_content'] = 'login_form_fail';
			$this->load->view('includes/template', $data);
		}
		
		
	}
}