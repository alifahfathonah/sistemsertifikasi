<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_sertifikasi extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('batchsertifikasi_model');
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
			'title'	=> 'Batch Sertifikasi',
			'batch'     => $this->batchsertifikasi_model->listbatch(),
			'view'	=> 'admin/batchsertifikasi/index'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function detail($id)
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$data = [
			'title'	=> 'Batch Sertifikasi',
			'batch'     => $this->batchsertifikasi_model->listbatchbyid($id),
			'view'	=> 'admin/batchsertifikasi/detail'
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
			'title'	=> 'Batch Sertifikasi',
			'subsertifikasi'     => $this->sertifikasi_model->get_all_sub_sertifikasi(),
			'view'	=> 'admin/batchsertifikasi/tambah'
		];

		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('sub_sertifikasi', 'Sub Sertifikasi', 'required');
		$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required');
		$this->form_validation->set_rules('tanggal_terakhir', 'Tanggal Terakhir', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim|numeric');
		$this->form_validation->set_rules('biaya_umum', 'Biaya Umum', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_min_peserta', 'Jumlah Min Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_pertemuan', 'Jumlah Pertemuan', 'required|trim|numeric');
		if(empty($_FILES['banner']['name']))
		{
			$this->form_validation->set_rules('banner', 'Gambar Banner', 'required');
		}
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		}
		else
		{
            //Penamaan file upload Gambar
			$nama = $this->batchsertifikasi_model->batchsertifikasikode();
			$config['upload_path']          = './assets/banner_batchsertifikasi/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $nama . '_' . "Banner";
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (!$this->upload->do_upload('banner')) 
			{
				$this->upload->display_errors();
				die;
			}
			else 
			{
				$upload_data = $this->upload->data();
				$namafile = $upload_data['file_name'];
				$data = [
					'bs_subsertifikasi'         => $this->input->post('sub_sertifikasi'),
					'bs_mulai_daftar'           => $this->input->post('tanggal_daftar'),
					'bs_terakhir_daftar'        => $this->input->post('tanggal_terakhir'),
					'bs_biaya_mhs'              => $this->input->post('biaya_mhs'),
					'bs_biaya_umum'             => $this->input->post('biaya_umum'),
					'bs_banner'                 => $namafile,
					'bs_keterangan'             => $this->input->post('keterangan'),
					'bs_jumlahmax'              => $this->input->post('jumlah_max_peserta'),
					'bs_jumlahmin'              => $this->input->post('jumlah_min_peserta'),
					'bs_userupdate'             => $this->session->userdata('username'),
					'bs_jumlahpertemuan'        => $this->input->post('jumlah_pertemuan'), 
					'bs_lastupdate'             => date('Y-m-d H:i:s')
				];

				if($this->batchsertifikasi_model->insert($data))
				{
					$jumlah = $this->input->post('jumlah_pertemuan');

					for($i = 1; $i <= $jumlah; $i++ )
					{
						$absen[$i] = [
							'as_batch'      => $this->db->insert_id(),
							'as_nama_absen' => "Pertemuan Ke ",
							'as_userupdate' => $this->session->userdata('username'),
							'as_lastupdate' => date('Y-m-d H:i:s')
						];
					}
					$this->batchsertifikasi_model->simpan_absen($absen);

					$this->session->set_flashdata('message', 'Data berhasil disimpan');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('batch_sertifikasi'));
				}
				else
				{
					$this->session->set_flashdata('message', 'Data gagal disimpan');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('batch_sertifikasi'));
				}
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

		$row = $this->batchsertifikasi_model->listbatchbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'Batch Sertifikasi',
				'subsertifikasi'     => $this->sertifikasi_model->get_all_sub_sertifikasi(),
				'list'               => $row,
				'view'	=> 'admin/batchsertifikasi/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('batch_sertifikasi');
		}
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('sub_sertifikasi', 'Sub Sertifikasi', 'required');
		$this->form_validation->set_rules('tanggal_daftar', 'Tanggal Daftar', 'required');
		$this->form_validation->set_rules('tanggal_terakhir', 'Tanggal Terakhir', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim');
		$this->form_validation->set_rules('biaya_umum', 'Biaya Umum', 'required');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('jumlah_min_peserta', 'Jumlah Min Peserta', 'required|trim|numeric');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
		$this->form_validation->set_rules('jumlah_pertemuan', 'Jumlah Pertemuan', 'required|trim|numeric');

		$this->form_validation->set_message('required', '{field} harus diisi');
		$this->form_validation->set_message('numeric', '{field} harus diisi dengan angka');
		$this->form_validation->set_error_delimiters('<small class="text-danger">','</small>');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon Isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->ubah($this->input->post('batch_id'));
		}
		else
		{
			$config['upload_path']          = './assets/banner_batchsertifikasi/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['file_name']            = $this->input->post('batch_id') . '_' . "Banner";
			$config['overwrite']            = true;

			$this->upload->initialize($config);

			if (!empty($_FILES['banner']['name'])) {
				if (!$this->upload->do_upload('banner')) 
				{
					$this->upload->display_errors();
					die;    
				}
				else
				{

				}
			}   

			if (!empty($_FILES['banner']['name'])) {
				$namafile = $this->upload->data('file_name');
			} else {
				$namafile = $this->input->post('oldfile');
			}

			$data = [
				'bs_subsertifikasi'         => $this->input->post('sub_sertifikasi'),
				'bs_mulai_daftar'           => $this->input->post('tanggal_daftar'),
				'bs_terakhir_daftar'        => $this->input->post('tanggal_terakhir'),
				'bs_biaya_mhs'              => $this->input->post('biaya_mhs'),
				'bs_biaya_umum'             => $this->input->post('biaya_umum'),
				'bs_banner'                 => $namafile,
				'bs_keterangan'             => $this->input->post('keterangan'),
				'bs_jumlahmax'              => $this->input->post('jumlah_max_peserta'),
				'bs_jumlahmin'              => $this->input->post('jumlah_min_peserta'),
				'bs_jumlahpertemuan'        => $this->input->post('jumlah_pertemuan'), 
				'bs_userupdate'             => $this->session->userdata('username'),
				'bs_lastupdate'             => date('Y-m-d H:i:s')
			];

			if($this->batchsertifikasi_model->update($this->input->post('batch_id'),$data))
			{
				$cekjumlah = $this->batchsertifikasi_model->cekjumlahtabel($this->input->post('batch_id'));
				$jumlah = $this->input->post('jumlah_pertemuan');
				$cekid = $this->batchsertifikasi_model->cekid($this->input->post('batch_id'));

				if($jumlah > $cekjumlah)
				{
					$total = $jumlah - $cekjumlah;

					for($i = 1; $i <= $total; $i++ )
					{
						$absen[$i] = [
							'as_batch'      => $this->input->post('batch_id'),
							'as_nama_absen' => "Pertemuan Ke",
							'as_userupdate' => $this->session->userdata('username'),
							'as_lastupdate' => date('Y-m-d H:i:s')
						];
					}
					$this->batchsertifikasi_model->simpan_absen($absen);
				}
				else
				{
                    //Parameter awal
					$i = 1;
					$jumlahpertemuan = $this->input->post('jumlah_pertemuan');

					$detail = $this->batchsertifikasi_model->detailabsen($this->input->post('batch_id'));

					foreach($detail as $d)
					{
						if ($i <= $jumlahpertemuan)
						{
                            //jika jumlahpertemuan lebih kecil dari $i
						}
						else
						{ 
                            //jika jumlahpertemuan lebih dari $i maka akan loop
							$this->batchsertifikasi_model->delete_absen($d->as_id);
						}
						$i++;
					}
				}
				$this->session->set_flashdata('message', 'Data berhasil diubah');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('batch_sertifikasi'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Data gagal diubah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('batch_sertifikasi'));
			}
		}
	}

	public function delete($id)
	{
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		if($this->batchsertifikasi_model->delete($id))
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('batch_sertifikasi'));
		}
		else
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('batch_sertifikasi'));
		}
	}

}

/* End of file Batch_sertifikasi.php */
/* Location: ./application/controllers/Batch_sertifikasi.php */