<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul_group extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modulgroup_model');
		$this->load->model('modul_model');
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function tambah($id_group)
	{        
		$modul_group = $this->modulgroup_model->getmodulgroup($id_group);
		$data = [
			'title'	=> 'Modul Group',
			'modul'         => $this->modul_model->list(),
			'modul_group'   => $modul_group,
			'id_group'      => $id_group,
			'view'	=> 'admin/modul_group/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$cek = $this->modulgroup_model->cek($this->input->post('id_group', TRUE), $this->input->post('modul', TRUE));

		if($cek == FALSE)
		{
			$this->session->set_flashdata('message', 'Modul Sudah ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('modul_group/tambah/' . $this->input->post('id_group', TRUE)));
		}
		else
		{
			$data = [
				'mg_usergroup'	=> $this->input->post('id_group', TRUE),
				'mg_modul'	=> $this->input->post('modul', TRUE),
			];

			if ($this->modulgroup_model->insert($data)) 
			{
				$this->session->set_flashdata('message', 'Data berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(site_url('modul_group/tambah/' . $this->input->post('id_group', TRUE)));
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Data gagal disimpan');
				$this->session->set_flashdata('tipe', 'warning');
				redirect(site_url('modul_group/tambah/' . $this->input->post('id_group', TRUE)));
			}
		}
	}

	public function delete($id, $group_id)
	{

		if ($this->modulgroup_model->delete($id, $group_id)) 
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(site_url('modul_group/tambah/' . $group_id));
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'warning');
			redirect(site_url('modul_group/tambah/' . $group_id));
		}
	}

}

/* End of file Modul_group.php */
/* Location: ./application/controllers/Modul_group.php */