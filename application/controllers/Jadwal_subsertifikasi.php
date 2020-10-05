<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_subsertifikasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('jadwalsubsertifikasi_model');
		$this->load->model('batchsertifikasi_model');
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
			'title'	=> 'Jadwal Ujian Sertifikasi',
			'jadwal'    => $this->jadwalsubsertifikasi_model->list(),
			'view'	=> 'admin/jadwal_subsertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		$data = [
			'title'	=> 'Jadwal Ujian Sertifikasi',
			'batch'     => $this->batchsertifikasi_model->listbatch(),
			'view'	=> 'admin/jadwal_subsertifikasi/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('batch_sertifikasi', 'Batch Sertifikasi', 'required|is_unique[ssc_jadwal_subsertifikasi.js_batch]');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('is_unique', '{field} ini sudah ada!');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		}
		else
		{
            //Cek tanggal dan jam mulai tidak boleh sama
			$tanggal = $this->input->post('tanggal_pelaksanaan');
			$jam = $this->input->post('jam_mulai');
			$cek_tanggal = $this->jadwalsubsertifikasi_model->cektanggal($tanggal, $jam);

			if($cek_tanggal->num_rows() > 0)
			{
				$this->session->set_flashdata('message', 'Tanggal Pelaksanaan atau Jam Mulai ini Sudah ada! Mohon isi Tanggal Pelaksanaan atau Jam Mulai lain');
				$this->session->set_flashdata('tipe', 'error');
				$this->tambah();
			}
			else
			{
				$data = [
					'js_batch'          => $this->input->post('batch_sertifikasi'),
					'js_tanggal'        => $this->input->post('tanggal_pelaksanaan'),
					'js_mulai'          => $this->input->post('jam_mulai'),
					'js_selesai'        => $this->input->post('jam_selesai'),
					'js_tempat'         => $this->input->post('tempat'),
					'js_link'           => $this->input->post('link'),
					'js_userupdate'     => $this->session->userdata('username'),
					'js_lastupdate'     => date('Y-m-d H:i:s')
				];

				if ($this->jadwalsubsertifikasi_model->insert($data)) 
				{
					$this->session->set_flashdata('message', 'Daftar berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('jadwal_subsertifikasi'));
				} 
				else 
				{
					$this->session->set_flashdata('message', 'Data gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('jadwal_subsertifikasi'));
				}
			}
		}
	}



}

/* End of file Jadwal_subsertifikasi.php */
/* Location: ./application/controllers/Jadwal_subsertifikasi.php */