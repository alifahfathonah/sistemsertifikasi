<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_nilai_sertifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('inputnilaisertifikasi_model');
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
	}

	public function nilai_umum($id_batch)
	{
		$data = [
			'title'	=> 'Input Nilai Sertifikasi Umum',
			'list'           => $this->inputnilaisertifikasi_model->listsertifikasiumum($id_batch),
			'view'	=> 'admin/nilai_sertifikasi/nilaisertifikasiumum/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function input_nilai_umum($id_subsertifikasiumum, $id_sertifikasiumum, $id_batch)
	{
		$data = [
			'title'	=> 'Input Nilai Sertifikasi Umum',
			'list'           => $this->inputnilaisertifikasi_model->list_nilaiumum($id_subsertifikasiumum, $id_sertifikasiumum, $id_batch),
			'view'	=> 'admin/nilai_sertifikasi/nilaisertifikasiumum/inputnilaiumum'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan_umum()
	{
		$this->form_validation->set_rules('skor', 'Skor', 'required|trim|numeric');
		$this->form_validation->set_rules('tanggal_sertifikasi', 'Tanggal Sertifikasi', 'required');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', 'Mohon isi {field} dengan angka saja!');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->input_nilai_umum($this->input->post('id_subsertifikasiumum'), $this->input->post('id_sertifikasiumum'), $this->input->post('id_batch'));
		}
		else
		{
			$data = [
				'ssu_skor'                    => $this->input->post('skor'),
				'ssu_tanggal_sertifikasi'     => $this->input->post('tanggal_sertifikasi'),
				'ssu_userupdate'              => $this->session->userdata('username'),
				'ssu_lastupdate'              => date('Y-m-d H:i:s')
			];

			if($this->inputnilaisertifikasi_model->update($this->input->post('id_subsertifikasiumum'), $this->input->post('id_sertifikasiumum'), $this->input->post('id_batch'), $data))
			{
				$this->session->set_flashdata('message', 'Data nilai berhasil disimpan');
				$this->session->set_flashdata('tipe', 'success');
				redirect('input_nilai_sertifikasi/nilai_umum/' . $this->input->post('id_batch'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data nilai gagal disimpan');
				$this->session->set_flashdata('tipe', 'error');
				redirect('input_nilai_sertifikasi/nilai_umum/' . $this->input->post('id_batch'));
			}
		}
	}

	public function nilai_mahasiswa($id_batch)
	{
		$listmhs = array();
		$mahasiswa = $this->inputnilaisertifikasi_model->listsertifikasimahasiswa($id_batch);

		foreach($mahasiswa as $m)
		{
			$data_mhs = $this->inputnilaisertifikasi_model->getnama($m->sm_mahasiswa);
			$listmhs[$m->sm_mahasiswa] = $data_mhs->name;
		}

		$data = [
			'title'	=> 'Input Nilai Sertifikasi Mahasiswa',
			'list'  => $mahasiswa,
			'nama_mhs'	=> $listmhs,
			'view'	=> 'admin/nilai_sertifikasi/nilaisertifikasimahasiswa/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function input_nilai_mahasiswa($id_subsertifikasimahasiswa, $id_sertifikasimahasiswa, $id_batch)
	{
		$data = [
			'title'	=> 'Input Nilai Sertifikasi Mahasiswa',
			'list'  => $this->inputnilaisertifikasi_model->list_nilaimahasiswa($id_subsertifikasimahasiswa, $id_sertifikasimahasiswa, $id_batch),
			'view'	=> 'admin/nilai_sertifikasi/nilaisertifikasimahasiswa/inputnilaimahasiswa'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

}

/* End of file Input_nilai_sertifikasi.php */
/* Location: ./application/controllers/Input_nilai_sertifikasi.php */