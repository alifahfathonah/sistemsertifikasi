<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
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
			'title'	=> 'User Group',
			'list'  => $this->usergroup_model->list(),
			'view'	=> 'admin/user_group/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'User Group',
			'list'  => $this->usergroup_model->list(),
			'view'	=> 'admin/user_group/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_group', 'Nama Group', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		}
		else
		{
			$data = [
				'ug_group'          => $this->input->post('nama_group'),
				'ug_keterangan'     => $this->input->post('keterangan'),
				'ug_isaktif'        => $this->input->post('status'),
				'ug_userupdate'     => $this->session->userdata('username'),
				'ug_lastupdate'     => date('Y-m-d H:i:s')
			];

			if($this->usergroup_model->insert($data))
			{
				$this->session->set_flashdata('message', 'Data berhasil ditambah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('usergroup'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal ditambah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('usergroup'));
			}
		}
	}

	public function ubah($id)
	{
		$row = $this->usergroup_model->listbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'User Group',
				'list'			=> $row,
				'view'	=> 'admin/user_group/ubah'
			];
			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('usergroup'));
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_group', 'Nama Group', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
		$this->form_validation->set_rules('status', 'Status', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('usergroup_id'));
		}
		else
		{
			$data = [
				'ug_group'          => $this->input->post('nama_group'),
				'ug_keterangan'     => $this->input->post('keterangan'),
				'ug_isaktif'        => $this->input->post('status'),
				'ug_userupdate'     => $this->session->userdata('email'),
				'ug_lastupdate'     => date('Y-m-d H:i:s')
			];

			if($this->usergroup_model->update($this->input->post('usergroup_id'), $data))
			{
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('usergroup'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('usergroup'));
			}
		}
	}

	public function delete($id)
	{
		if($this->usergroup_model->delete($id))
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('usergroup'));
		}
		else
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('usergroup'));
		}
	}

}

/* End of file Usergroup.php */
/* Location: ./application/controllers/Usergroup.php */