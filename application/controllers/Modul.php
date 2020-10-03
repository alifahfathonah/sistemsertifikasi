<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('modul_model');

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
			'title'	=> 'Modul',
			'list'      => $this->modul_model->list(),
			'view'	=> 'admin/modul/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Modul',
			'mainmenu'      => $this->modul_model->list(),
			'menuutama'     => $this->modul_model->mainmenu(),
			'view'	=> 'admin/modul/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_modul', 'Nama Modul', 'required|trim');
		$this->form_validation->set_rules('url', 'Url', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');
		$this->form_validation->set_rules('mainmenu', 'Main Menu', 'required');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi!');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'warning');
			$this->tambah();
		} 
		else 
		{
			$data = [
				'mdl_modul'	=> $this->input->post('nama_modul', TRUE),
				'mdl_link'	=> $this->input->post('url', TRUE),
				'mdl_icon'	=> $this->input->post('icon', TRUE),
				'mdl_mainmenu' => $this->input->post('mainmenu', TRUE)
			];

			if ($this->modul_model->insert($data)) {
				$this->session->set_flashdata('message', 'Data berhasil ditambah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(site_url('modul'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal ditambah');
				$this->session->set_flashdata('tipe', 'warning');
				redirect(site_url('modul'));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->modul_model->listbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'Modul',
				'mainmenu'      => $this->modul_model->list(),
				'menuutama'     => $this->modul_model->mainmenu(),
				'list'			=> $row,
				'view'	=> 'admin/modul/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('modul'));
		}
		
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_modul', 'Nama Modul', 'required|trim');
		$this->form_validation->set_rules('url', 'Url', 'required|trim');
		$this->form_validation->set_rules('icon', 'Icon', 'required|trim');
		$this->form_validation->set_rules('mainmenu', 'Main Menu', 'required');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi!');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'warning');
			$this->ubah($this->input->post('modul_id'));
		} 
		else 
		{
			$data = [
				'mdl_modul'	=> $this->input->post('nama_modul', TRUE),
				'mdl_link'	=> $this->input->post('url', TRUE),
				'mdl_icon'	=> $this->input->post('icon', TRUE),
				'mdl_mainmenu' => $this->input->post('mainmenu', TRUE)
			];

			if ($this->modul_model->update($this->input->post('modul_id'), $data)) {
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(site_url('modul'));
			} else {
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'warning');
				redirect(site_url('modul'));
			}
		}
	}

	public function delete($id)
	{
		if ($this->modul_model->delete($id)) {
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(site_url('modul'));
		} else {
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'warning');
			redirect(site_url('modul'));
		}
	}



}

/* End of file Modul.php */
/* Location: ./application/controllers/Modul.php */