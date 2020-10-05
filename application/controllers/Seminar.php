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
		if(!isset($this->session->userdata['username']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}
		$data = [
			'title'	=> 'Seminar',
			'model'      => $this->modelsertifikat_model->listmodelsertifikat(),
			'view'	=> 'admin/seminar/tambah'
		];
		$this->load->view('admin/template/wrapper', $data);
	}

	public function simpan()
	{
		$this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
		$this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksanaan', 'required|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('nama_moderator', 'Nama Moderator', 'required');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required');
		$this->form_validation->set_rules('biaya_umum', 'Biaya umum', 'required');
		$this->form_validation->set_rules('model_sertifikat', 'Model sertifikat', 'required');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim');

		if($_FILES['gambar']['name'] == "")
		{
			$this->form_validation->set_rules('gambar', 'Banner Seminar', 'required');
		}

		$this->form_validation->set_message('required', '{field} harus diisi');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->tambah();
		} else {

			$namafile = $this->seminar_model->seminarkode();

			$config['upload_path']          = './assets/banner_seminar/';
			$config['allowed_types']        = 'gif|jpeg|jpg|png';
			$config['file_name']            = $namafile . '_' . "Banner";
			$config['overwrite']            = true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar'))
			{
				$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
				$this->session->set_flashdata('tipe', 'warning');
				$this->tambah();
			}
			else
			{

				$data = [
					'smr_acara'                => $this->input->post('nama_seminar'),
					'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
					'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
					'smr_jam_mulai'            => $this->input->post('jam_mulai'),
					'smr_jam_selesai'          => $this->input->post('jam_selesai'),
					'smr_moderator'            => $this->input->post('nama_moderator'),
					'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
					'smr_biaya_umum'           => $this->input->post('biaya_umum'),
					'smr_link_online'          => $this->input->post('link'),
					'smr_banner'               => $this->upload->data('file_name'),
					'smr_keterangan'           => $this->input->post('keterangan'),
					'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
					'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
					'smr_userupdate'           => $this->session->userdata('username'),
					'smr_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->insert($data)) {
					$this->session->set_flashdata('message', 'Data berhasil ditambah');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('seminar'));
				} else {
					$this->session->set_flashdata('message', 'Data gagal ditambah');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('seminar'));
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

		$row = $this->seminar_model->listseminarbyid($id);

		if($row)
		{
			$data = [
				'title'	=> 'Seminar',
				'seminar'	=> $row,
				'model'      => $this->modelsertifikat_model->listmodelsertifikat(),
				'view'	=> 'admin/seminar/ubah'
			];

			$this->load->view('admin/template/wrapper', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'Data tidak ada');
			$this->session->set_flashdata('tipe', 'error');
			redirect(site_url('seminar'));
		}
		
	}

	public function simpan_perubahan()
	{
		$this->form_validation->set_rules('nama_seminar', 'Nama Seminar', 'required');
		$this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksanaan', 'required');
		$this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksanaan', 'required|required');
		$this->form_validation->set_rules('jam_mulai', 'Jam Mulai', 'required');
		$this->form_validation->set_rules('jam_selesai', 'Jam Selesai', 'required');
		$this->form_validation->set_rules('nama_moderator', 'Nama Moderator', 'required|trim');
		$this->form_validation->set_rules('biaya_mhs', 'Biaya Mahasiswa', 'required|trim');
		$this->form_validation->set_rules('biaya_umum', 'Biaya umum', 'required|trim');
		$this->form_validation->set_rules('jumlah_max_peserta', 'Jumlah Max Peserta', 'required|trim');
		$this->form_validation->set_rules('model_sertifikat', 'Model sertifikat', 'required');

		$this->form_validation->set_message('required', '{field} harus diisi');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', 'Mohon isi data sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			$this->update($this->input->post('seminar_id'));
		} else {

			if($_FILES['gambar']['name'] != "")
			{
				$namafile = $this->input->post('seminar_id') . '_' . "Banner";

				$getid = $this->modelsertifikat_model->getid();
				$config['upload_path']          = './assets/banner_seminar/';
				$config['allowed_types']        = 'gif|jpeg|jpg|png';
				$config['file_name']            = $namafile;
				$config['overwrite']            = true;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('gambar'))
				{
					$this->session->set_flashdata('message', $this->upload->display_errors('<p>', '</p>'));
					$this->session->set_flashdata('tipe', 'warning');
					$this->ubah($this->input->post('model_id'));
				}
				else
				{
					$data = [
						'smr_acara'                => $this->input->post('nama_seminar'),
						'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
						'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
						'smr_jam_mulai'            => $this->input->post('jam_mulai'),
						'smr_jam_selesai'          => $this->input->post('jam_selesai'),
						'smr_moderator'            => $this->input->post('nama_moderator'),
						'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
						'smr_biaya_umum'           => $this->input->post('biaya_umum'),
						'smr_link_online'          => $this->input->post('link'),
						'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
						'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
						'smr_banner'               => $this->upload->data('file_name'),
						'smr_keterangan'           => $this->input->post('keterangan'),
						'smr_userupdate'           => $this->session->userdata('username'),
						'smr_lastupdate'           => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->update($this->input->post('seminar_id'), $data)) 
					{
						$this->session->set_flashdata('message', 'Data berhasil diubah');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('seminar'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Data gagal diubah');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			}
			else
			{
				$data = [
					'smr_acara'                => $this->input->post('nama_seminar'),
					'smr_tanggal'              => $this->input->post('tanggal_pelaksanaan'),
					'smr_tempat'               => $this->input->post('tempat_pelaksanaan'),
					'smr_jam_mulai'            => $this->input->post('jam_mulai'),
					'smr_jam_selesai'          => $this->input->post('jam_selesai'),
					'smr_moderator'            => $this->input->post('nama_moderator'),
					'smr_biaya_mhs'            => $this->input->post('biaya_mhs'),
					'smr_biaya_umum'           => $this->input->post('biaya_umum'),
					'smr_link_online'          => $this->input->post('link'),
					'smr_model_sertifikat'     => $this->input->post('model_sertifikat'),
					'smr_jumlahmax'            => $this->input->post('jumlah_max_peserta'),
					'smr_banner'               => $this->input->post('oldfile'),
					'smr_keterangan'           => $this->input->post('keterangan'),
					'smr_userupdate'           => $this->session->userdata('username'),
					'smr_lastupdate'           => date('Y-m-d H:i:s')
				];

				if ($this->seminar_model->update($this->input->post('seminar_id'), $data)) 
				{
					$this->session->set_flashdata('message', 'Data berhasil diubah');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('seminar'));
				} 
				else 
				{
					$this->session->set_flashdata('message', 'Data gagal diubah');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('seminar'));
				}
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

		if ($this->seminar_model->delete($id)) 
		{
			$this->session->set_flashdata('message', 'Data berhasil dihapus');
			$this->session->set_flashdata('tipe', 'success');
			redirect(base_url('seminar'));
		} 
		else 
		{
			$this->session->set_flashdata('message', 'Data gagal dihapus');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('seminar'));
		}
	}

	public function daftar_umum($id)
	{
		if (!isset($this->session->userdata['email'])) 
		{
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_seminar/' . $id));
		} 
		else 
		{
			$cek = $this->seminar_model->cek($this->session->userdata['email']);
			if ($cek->num_rows() > 0) 
			{
				$this->session->set_flashdata('message', 'Anda sudah mendaftar');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_seminar/' . $id));
			} 
			else 
			{

                //Total Jumlah Peserta
				$umum           = $this->seminar_model->listseminarumum()->row(); 
				$jumlah_mhs     = $this->seminar_model->jumlahpesertamhs($id);
				$jumlah_umum    = $this->seminar_model->jumlahpesertaumum($umum->su_seminar);
				$total          = $jumlah_mhs->jumlah_mahasiswa + $jumlah_umum->jumlah;
				$seminar        = $this->seminar_model->getjumlahmaxseminar($id)->row();
				$jumlahmax      = $seminar->smr_jumlahmax;

				if($total >= $seminar->smr_jumlahmax )
				{
					$this->session->set_flashdata('message', 'Maaf Pendaftaran sudah penuh!');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('home/detail_seminar/' . $id));
				}
				else
				{
					$data = [
						'su_seminar'        => $id,
						'su_peserta'        => $this->session->userdata['email'],
						'su_tanggaldaftar'  => date('Y-m-d H:i:s'),
						'su_status'         => "Menunggu Pembayaran",
						'su_userupdate'     => $this->session->userdata('email'),
						'su_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->daftar_seminar_umum($data)) 
					{
						$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_umum/akun'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Anda gagal mendaftar');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			}
		}
	}

	public function daftar_mahasiswa($id)
	{
		if (!isset($this->session->userdata['npm'])) 
		{
			$this->session->set_flashdata('message', 'Anda belum login! Silahkan login terlebih dahulu');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home/detail_seminar/' . $id));
		} 
		else 
		{
			$cek = $this->seminar_model->cekmahasiswa($id, $this->session->userdata['npm']);
			if ($cek->num_rows() > 0) 
			{
				$this->session->set_flashdata('message', 'Anda sudah mendaftar');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('home/detail_seminar/' . $id));
			} 
			else 
			{
                //Total Jumlah Peserta
				$umum           = $this->seminar_model->listseminarumum()->row(); 
				$jumlah_mhs     = $this->seminar_model->jumlahpesertamhs($id);
				$jumlah_umum    = $this->seminar_model->jumlahpesertaumum($umum->su_seminar);
				$total          = $jumlah_mhs->jumlah_mahasiswa + $jumlah_umum->jumlah;
				$seminar        = $this->seminar_model->getjumlahmaxseminar($id)->row();
				$jumlahmax      = $seminar->smr_jumlahmax;

				if($total >= $seminar->smr_jumlahmax )
				{
					$this->session->set_flashdata('message', 'Maaf Pendaftaran sudah penuh!');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('home/detail_seminar/' . $id));
				}
				else
				{
					$data = [
						'smhs_seminar'        => $id,
						'smhs_mahasiswa'      => $this->session->userdata['npm'],
						'smhs_tanggaldaftar'  => date('Y-m-d H:i:s'),
						'smhs_status'         => "Menunggu Pembayaran",
						'smhs_userupdate'     => $this->session->userdata('npm'),
						'smhs_lastupdate'     => date('Y-m-d H:i:s')
					];

					if ($this->seminar_model->daftar_seminar_mahasiswa($data)) 
					{
						$this->session->set_flashdata('message', 'Anda Berhasil mendaftar');
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('akun_mahasiswa/akun'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Anda gagal mendaftar');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('seminar'));
					}
				}
			}
		}
	}

}

/* End of file Seminar.php */
/* Location: ./application/controllers/Seminar.php */