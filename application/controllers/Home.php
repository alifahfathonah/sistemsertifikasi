<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('seminar_model');
		$this->load->model('batchsertifikasi_model');
		$this->load->model('jadwalsubsertifikasi_model');
	}

	public function index()
	{
		$data = [
			'batch'     => $this->jadwalsubsertifikasi_model->jadwal_batch(),
			'seminar'   => $this->seminar_model->listseminar(),
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

	public function detail($id_batch)
	{
		$cek = $this->batchsertifikasi_model->listbatchbyidhome($id_batch);
		$data = [
			'batch'     => $cek,
			'view'	=> 'detail-batch'
		];

		$this->load->view('template/wrapper', $data);
	}
}
