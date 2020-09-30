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
		$data = [
			'view'	=> 'akun/choice'
		];

		$this->load->view('template/wrapper', $data);
	}
}
