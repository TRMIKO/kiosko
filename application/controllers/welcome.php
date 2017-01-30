<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}
	public function index()
	{	
		if (!$this->tank_auth->is_logged_in()) {
			redirect('welcome/inicio');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('inicio', $data);
		}
	}
	function inicio()
	{
		$this->load->view('inicio');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */