<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('usergroup_model');

		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index()
	{
		$data = [
			'title'	=> 'User',
			'list'  => $this->user_model->list(),
			'view'	=> 'admin/user/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'User',
			'usergroup'   => $this->usergroup_model->list(),
			'view'	=> 'admin/user/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */