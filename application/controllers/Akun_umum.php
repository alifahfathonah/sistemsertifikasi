<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_umum extends CI_Controller {

	public function index()
	{
		$data = [
			'view'	=> 'akun/umum/login'
		];

		$this->load->view('template/wrapper', $data);
	}

}

/* End of file Akun_umum.php */
/* Location: ./application/controllers/Akun_umum.php */