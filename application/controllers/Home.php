<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$data = [
			'view'	=> 'index'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function login()
	{
		if (isset($this->session->userdata['npm'])) 
		{
            redirect(base_url('home'));
        }

		$data = [
			'view'	=> 'akun/choice'
		];

		$this->load->view('template/wrapper', $data);
	}
}
