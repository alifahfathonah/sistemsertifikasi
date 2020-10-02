<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index()
	{
		if (!isset($this->session->userdata['username'])) {
			redirect(base_url('auth'));
		}

		$data = [
			'view'	=> 'admin/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */