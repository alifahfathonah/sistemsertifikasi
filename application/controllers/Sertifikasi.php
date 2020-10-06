<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('sertifikasi_model');
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
			'title'	=> 'Sertifikasi',
			'sertifikasi'  =>  $this->sertifikasi_model->get_all_sertifikasi(),
			'view'	=> 'admin/sertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function tambah()
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Sertifikasi',
			'view'	=> 'admin/sertifikasi/tambah'
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
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

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
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

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

	public function buktibayarumum($id_subsertifikasi, $id_sertifikasi)
	{
		if(!isset($this->session->userdata['email']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('akun_umum');
		}
		$data = [
			'bukti'         =>  $this->sertifikasi_model->getdatasebelumbayar($id_subsertifikasi, $id_sertifikasi),
			'view'	=> 'akun/umum/buktibayarsertifikasi'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function upload_umum()
	{
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
		$this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->buktibayarumum($this->input->post('subsertifikasi_id'), $this->input->post('sertifikasi_id'));
		} 
		else 
		{
			if(empty($_FILES['buktibayar']['name']))
			{
				$data = [
					'ssu_bank'           => $this->input->post('nama_bank'),
					'ssu_norekening'     => $this->input->post('no_rek'),
					'ssu_namapemilik'    => $this->input->post('nama_pemilik'),
					'ssu_status'         => "Validasi Pembayaran",
					'ssu_userupdate'     => $this->session->userdata('email'),
					'ssu_lastupdate'     => date('Y-m-d H:i:s')
				];

				if($this->sertifikasi_model->updatebayarumum($this->input->post('subsertifikasi_id'), $data))
				{
					$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_umum/akun'));
				} 
				else 
				{
					$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_umum/akun'));
				}
			}
			else
			{
				$config['upload_path']          = './assets/buktitransfersertifikasiumum/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['file_name']            = $this->session->userdata('ktp') . '_' . $this->input->post('subsertifikasi_id');
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('buktibayar'))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->buktibayarumum($this->input->post('subsertifikasi_id'), $this->input->post('sertifikasi_id'));
				}
				else
				{
					$data = [
						'ssu_bank'           => $this->input->post('nama_bank'),
						'ssu_norekening'     => $this->input->post('no_rek'),
						'ssu_namapemilik'    => $this->input->post('nama_pemilik'),
						'ssu_bukti'          => $this->upload->data('file_name'),
						'ssu_status'         => "Validasi Pembayaran",
						'ssu_userupdate'     => $this->session->userdata('email'),
						'ssu_lastupdate'     => date('Y-m-d H:i:s')
					];

					if($this->sertifikasi_model->updatebayarumum($this->input->post('subsertifikasi_id'), $data))
					{
						$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					}
				}
			}
		}
	}

	public function buktibayarmahasiswa($id_subsertifikasi, $id_sertifikasi)
	{
		if(!isset($this->session->userdata['npm']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('akun_mahasiswa');
		}
		$data = [
			'bukti'         => $this->sertifikasi_model->getdatasebelumbayarmhs($id_subsertifikasi, $id_sertifikasi),
			'view'	=> 'akun/mahasiswa/buktibayarsertifikasi'
		];

		// header('content-type: application/json');
		// echo json_encode($data);
		// die;

		$this->load->view('template/wrapper', $data);
	}

	public function upload_mahasiswa()
	{
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');
		$this->form_validation->set_rules('no_rek', 'No Rekening', 'required|trim|numeric');
		$this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required|trim');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->buktibayarmahasiswa($this->input->post('subsertifikasi_id'), $this->input->post('sertifikasi_id'));
		} 
		else 
		{
			if(empty($_FILES['buktibayar']['name']))
			{
				$data = [
					'ssm_bank'           => $this->input->post('nama_bank'),
					'ssm_norekening'     => $this->input->post('no_rek'),
					'ssm_namapemilik'    => $this->input->post('nama_pemilik'),
					'ssm_status'         => "Validasi Pembayaran",
					'ssm_userupdate'     => $this->session->userdata('npm'),
					'ssm_lastupdate'     => date('Y-m-d H:i:s')
				];

				if($this->sertifikasi_model->updatebayarmhs($this->input->post('subsertifikasi_id'), $data))
				{
					$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_mahasiswa/akun'));
				} 
				else 
				{
					$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_mahasiswa/akun'));
				}
			}
			else
			{
				$config['upload_path']          = './assets/buktitransfersertifikasimahasiswa/';
				$config['allowed_types']        = 'jpeg|jpg|png';
				$config['file_name']            = $this->session->userdata('npm') . '_' . $this->input->post('subsertifikasi_id');
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('buktibayar'))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->buktibayarmahasiswa($this->input->post('subsertifikasi_id'), $this->input->post('sertifikasi_id'));
				}
				else
				{
					$data = [
						'ssm_bank'           => $this->input->post('nama_bank'),
						'ssm_norekening'     => $this->input->post('no_rek'),
						'ssm_namapemilik'    => $this->input->post('nama_pemilik'),
						'ssm_bukti'          => $this->upload->data('file_name'),
						'ssm_status'         => "Validasi Pembayaran",
						'ssm_userupdate'     => $this->session->userdata('npm'),
						'ssm_lastupdate'     => date('Y-m-d H:i:s')
					];

					if($this->sertifikasi_model->updatebayarmhs($this->input->post('subsertifikasi_id'), $data))
					{
						$this->session->set_flashdata('message', 'Bukti bayar berhasil diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Bukti bayar gagal diupload');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					}
				}
			}
		}
	}

}

/* End of file Sertifikasi.php */
/* Location: ./application/controllers/Sertifikasi.php */