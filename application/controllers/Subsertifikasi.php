<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subsertifikasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('sertifikasi_model');
		
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function index($id)
	{
		$this->session->set_userdata('sertifikasi', $id);

		$sertifikasi = $this->sertifikasi_model->get_sertifikasi($id);

		$data = [
			'title'	=> 'Sub Sertifikasi',
			'sub_sertifikasi'	=> $this->sertifikasi_model->get_sub_sertifikasi_by_main($id),
			'view'	=> 'admin/subsertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	function kembali()
	{
		$this->session->unset_userdata('sertifikasi');
		redirect(base_url('sertifikasi'));
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Sub Sertifikasi',
			'id_sertifikasi' => $this->session->userdata('sertifikasi'),
			'sertifikasi'	=> $this->sertifikasi_model->get_all_sertifikasi(),
			'view'	=> 'admin/subsertifikasi/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama', 'Nama Sub-Sertifikasi', 'required');
		$this->form_validation->set_rules('sertifikasi', 'Sertifikasi', 'required');
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
				'scert_subsertifikasi'	=> $this->input->post('nama'),
				'scert_sertifikasi'	=> $this->input->post('sertifikasi'),
				'scert_isaktif'		=> $this->input->post('status'),
				'scert_userupdate'	=> $this->session->userdata['username'],
				'scert_lastupdate'	=> date('Y-m-d H:i:s'),
			];
			if ($this->sertifikasi_model->insert_sub_sertifikasi($data)) 
			{
				$this->session->set_flashdata('message', 'Sub Sertifikasi Berhasil Disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('subsertifikasi/index/' . $this->input->post('sertifikasi')));
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Sub Sertifikasi Gagal Disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('subsertifikasi/index/' . $this->input->post('sertifikasi')));
			}
		}
	}

	function ubah($id)
	{
		$data_sertifikasi = $this->sertifikasi_model->get_sub_sertifikasi($id);
		$data = [
			'title'	=> 'Sub Sertifikasi',
			'nama'	=> $data_sertifikasi->scert_subsertifikasi,
			'status' => $data_sertifikasi->scert_isaktif,
			'id_sub_sertifikasi'	=> $data_sertifikasi->scert_id,
			'id_sertifikasi'	=> $this->session->userdata('sertifikasi'),
			'sertifikasipil'	=> $data_sertifikasi->scert_sertifikasi,
			'sertifikasi'	=> $this->sertifikasi_model->get_all_sertifikasi(),
			'view'	=> 'admin/subsertifikasi/ubah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama', 'Nama Sub-Sertifikasi', 'required');
		$this->form_validation->set_rules('sertifikasi', 'Sertifikasi', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} ini harus diisi !');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == false) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('id_subsertifikasi'));
		} 
		else 
		{
			$data = [
				'scert_subsertifikasi'	=> $this->input->post('nama'),
				'scert_sertifikasi'	=> $this->input->post('sertifikasi'),
				'scert_isaktif'		=> $this->input->post('status'),
				'scert_userupdate'	=> $this->session->userdata['username'],
				'scert_lastupdate'	=> date('Y-m-d H:i:s'),
			];
			if ($this->sertifikasi_model->update_sub_sertifikasi($this->input->post('id_subsertifikasi'), $data)) {
				$this->session->set_flashdata('message', 'Sub-Sertifikasi Berhasil Diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('subsertifikasi/index/' . $this->input->post('sertifikasi')));
			} else {
				$this->session->set_flashdata('message', 'Sub-Sertifikasi Gagal Diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('subsertifikasi/index/' . $this->input->post('sertifikasi')));
			}
		}
	}

	function delete($id)
	{
		if ($this->sertifikasi_model->delete_sub_sertifikasi($id)) {
			$this->session->set_flashdata('message', 'Sub-Sertifikasi Berhasil Dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('subsertifikasi/index/' . $this->session->userdata('sertifikasi')));
		} else {
			$this->session->set_flashdata('message', 'Sub-Sertifikasi Gagal Dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('subsertifikasi/index/' . $this->session->userdata('sertifikasi')));
		}
	}
}

/* End of file Subsertifikasi.php */
/* Location: ./application/controllers/Subsertifikasi.php */