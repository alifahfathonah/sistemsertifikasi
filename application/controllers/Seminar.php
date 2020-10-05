<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('seminar_model');
		$this->load->model('modelsertifikat_model');
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
			'title'	=> 'Seminar',
			'seminar'    => $this->seminar_model->listseminar(),
			'view'	=> 'admin/seminar/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Seminar',
			'view'	=> 'admin/seminar/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama', 'Nama Sertifikasi', 'required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} ini harus diisi !');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		} 
		else 
		{
			$data = [
				'cert_sertifikasi'	=> $this->input->post('nama'),
				'cert_prodi'		=> $this->input->post('prodi'),
				'cert_isaktif'		=> $this->input->post('status'),
				'cert_userupdate'	=> $this->session->userdata('username'),
				'cert_lastupdate'	=> date("Y-m-d H:i:s"),
			];
			if ($this->sertifikasi_model->insert_sertifikasi($data)) 
			{
				$this->session->set_flashdata('message', 'Sertifikasi Berhasil Disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('sertifikasi'));
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Sertifikasi Gagal Disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('sertifikasi'));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->sertifikasi_model->get_sertifikasi($id);

		if($row)
		{
			$data = [
				'title'	=> 'Sertifikasi',
				'list'			=> $row,
				'view'	=> 'admin/sertifikasi/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('sertifikasi'));
		}
		
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama', 'Nama Sertifikasi', 'required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} ini harus diisi !');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('id_sertifikasi'));
		} 
		else 
		{
			$data = [
				'cert_sertifikasi'	=> $this->input->post('nama'),
				'cert_prodi'		=> $this->input->post('prodi'),
				'cert_isaktif'		=> $this->input->post('status'),
				'cert_userupdate'	=> $this->session->userdata('username'),
				'cert_lastupdate'	=> date("Y-m-d H:i:s"),
			];
			if ($this->sertifikasi_model->update_sertifikasi($this->input->post('id_sertifikasi'),$data)) 
			{
				$this->session->set_flashdata('message', 'Sertifikasi Berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('sertifikasi'));
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Sertifikasi Gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('sertifikasi'));
			}
		}
	}

	function delete($id)
	{	
		if ($this->sertifikasi_model->delete_sertifikasi($id)) {
			$this->session->set_flashdata('message', 'Sertifikasi Berhasil Dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('sertifikasi'));
		} else {
			$this->session->set_flashdata('message', 'Sertifikasi Gagal Dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('sertifikasi'));
		}
	}

}

/* End of file Seminar.php */
/* Location: ./application/controllers/Seminar.php */