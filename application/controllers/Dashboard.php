<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index()
	{
		if(!isset($this->session->userdata['username']))
        {
            $this->session->set_flashdata('message', 'Anda Belum Login!');
            $this->session->set_flashdata('tipe', 'error');
            redirect('auth');
        }

		$data = [
			'title'	=> 'Dashboard',
			'totaldaftar' => $this->dashboard_model->gettotalpendaftar(),
			'totalseminar' => $this->dashboard_model->gettotalseminar(),
			'totallulus' => $this->dashboard_model->gettotalmhslulus(),
			'totaltidaklulus' => $this->dashboard_model->gettotalmhstidaklulus(),
			'view'	=> 'admin/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */