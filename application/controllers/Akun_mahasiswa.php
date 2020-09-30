<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_mahasiswa extends CI_Controller {

	public function index()
	{
		$data = [
			'view'	=> 'akun/mahasiswa/login'
		];

		$this->load->view('template/wrapper', $data);
	}

}

/* End of file Akun_mahasiswa.php */
/* Location: ./application/controllers/Akun_mahasiswa.php */