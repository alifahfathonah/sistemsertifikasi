<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {


	public function index()
	{
		if(!isset($this->session->userdata['username']))
        {
            $this->session->set_flashdata('message', 'Anda Belum Login!');
            $this->session->set_flashdata('tipe', 'error');
            redirect('auth');
        }

		$data = [
			'view'	=> 'admin/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */