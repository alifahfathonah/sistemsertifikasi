<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_umum extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('seminar_model');
		$this->load->model('sertifikasi_model');
		// Jika ada session user mahasiswa maka diblok

		if (isset($this->session->userdata['npm'])) {
			$this->session->set_flashdata('message', 'Maaf anda sedang login sebagai mahasiswa !');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home'));
		}
		
	}

	public function index()
	{
		if (isset($this->session->userdata['email'])) {
			redirect(base_url('home'));
		}

		$data = [
			'view'			=> 'akun/umum/login',
		];

		$this->load->view('template/wrapper', $data);
	}

	public function akun()
	{
		if (!isset($this->session->userdata['email'])) 
		{
			redirect(base_url('akun_umum'));
		}

		$data = [
			'nama'          => $this->session->userdata['nama'],
			'email'         => $this->session->userdata['email'],
			'ktp'           => $this->session->userdata['ktp'],
			'wa'            => $this->session->userdata['wa'],
			'asal'          => $this->session->userdata['asal'],
			'seminar'       => $this->seminar_model->listseminarbyuser($this->session->userdata['email']),
			'cert'          => $this->sertifikasi_model->listsertifikasibyuser2($this->session->userdata['email']),
			'view'			=> 'akun/umum/profile'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function detailsertifikasi($id_sertifikasi)
	{
		if (!isset($this->session->userdata['email'])) 
		{
			redirect(base_url('akun_umum'));
		}

		$data = [
			'nama'          => $this->session->userdata['nama'],
			'email'         => $this->session->userdata['email'],
			'ktp'           => $this->session->userdata['ktp'],
			'wa'            => $this->session->userdata['wa'],
			'asal'          => $this->session->userdata['asal'],
			'sertifikasi'   => $this->sertifikasi_model->listsertifikasibyuserdetail($id_sertifikasi),
			'view'			=> 'akun/umum/profile-detail'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi dengan benar');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun_umum'));
		} 
		else 
		{
			$email          = $this->input->post('email');
			$password       = md5($this->input->post('password'));

			$checkuser      = $this->users_model->cek($email, $password);

			if ($checkuser->num_rows() > 0) 
			{
				foreach ($checkuser->result() as $hasil) 
				{
					if ($hasil->pu_isaktif == "y") 
					{
						$sess['email']      = $hasil->pu_email;
						$sess['nama']       = $hasil->pu_nama;
						$sess['ktp']        = $hasil->pu_ktp;
						$sess['wa']         = $hasil->pu_wa;
						$sess['asal']       = $hasil->pu_asal_instansi;

						$this->session->set_userdata($sess);
						$this->session->set_flashdata('message', 'Hello ' . ucfirst($hasil->pu_nama));
						$this->session->set_flashdata('tipe', 'success');
						redirect(base_url('home'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Mohon untuk melakukan validasi akun pada email !');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('akun_umum'));
					}
				}
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Password atau email salah !');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('akun_umum'));
			}
		}
	}


	public function register()
	{
		if (isset($this->session->userdata['email'])) {
			redirect(base_url('home'));
		}

		$data = [
			'view'			=> 'akun/umum/register',
		];

		$this->load->view('template/wrapper', $data);
	}


	public function register_member()
	{
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('no_ktp', 'No. KTP', 'required|trim|min_length[16]');
		$this->form_validation->set_rules('no_wa', 'No. Whatsapp', 'required|trim|numeric');
		$this->form_validation->set_rules('asal_instansi', 'Asal Instansi', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]');

		$this->form_validation->set_message('required', '{field} harus diisi !');
		$this->form_validation->set_message('valid_email', 'Mohon Isi {field} dengan benar !');
		$this->form_validation->set_message('numeric', 'Isi {field} yang sesuai !');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi data dengan benar!');
			$this->session->set_flashdata('tipe', 'error');
			$this->register();
		} 
		else 
		{
			$cek = $this->users_model->checkemail($this->input->post('email', TRUE));
			$cek_ktp = $this->users_model->checkktp($this->input->post('no_ktp', TRUE));

			if ($cek->num_rows() > 0) 
			{
				$this->session->set_flashdata('message', 'Email sudah terdaftar!');
				$this->session->set_flashdata('tipe', 'error');
				$this->register();
			} 
			else 
			{
				if ($cek_ktp->num_rows() > 0) 
				{
					$this->session->set_flashdata('message', 'KTP sudah terdaftar!');
					$this->session->set_flashdata('tipe', 'error');
					$this->register();
				} 
				else 
				{
					$data = [
						'pu_email'          => $this->input->post('email'),
						'pu_password'       => md5($this->input->post('password')),
						'pu_nama'           => $this->input->post('nama_lengkap'),
						'pu_ktp'            => $this->input->post('no_ktp'),
						'pu_wa'             => $this->input->post('no_wa'),
						'pu_asal_instansi'  => $this->input->post('asal_instansi'),
						'pu_isaktif'        => 'n'
					];

					$hasil = $this->users_model->insert($data);

					if ($hasil == TRUE) 
					{
						$guardcode = md5($this->input->post('email', TRUE));
						$email = $this->input->post('email', TRUE);
						$nama = $this->input->post('nama_lengkap', TRUE);

						date_default_timezone_set('Asia/Jakarta');

						$bodymsg = '<h4>Konfirmasi Registrasi Akun :</h4> Email : ' . $email . ' <br/> Nama : ' . ucfirst($nama) . '<br/> Registrasi pada tanggal ' . date("d F Y") . '<br/> <a style="display: block;width: 300px;height: auto;background: #2A3955;padding: 10px;margin:10px;text-align: center;border-radius: 5px; color: #F8B600;font-weight: bold; text-decoration: none;" href="http://localhost/sistemsertifikasi/akun_umum/konfirmasi/' . $guardcode . '">Klik Untuk Konfirmasi Registrasi</a> atau <br/> Akses pada link : <a href="http://localhost/sistemsertifikasi/akun_umum/konfirmasi/' . $guardcode . '">http://localhost/sistemsertifikasi/akun_umum/konfirmasi/' . $guardcode . '</a>';

						$this->load->library('phpmailer_lib');
						$mail = $this->phpmailer_lib->load();

						$mail->setFrom('noreply@uib.ac.id', 'Universitas Internasional Batam');
						$mail->addAddress($email, ucfirst($nama));
						$mail->Subject = 'Konfirmasi Registrasi Akun';
						$mail->Body = $bodymsg;
						$mail->IsHTML(true);
						$mail->send();

						$this->session->set_flashdata('message', 'Registrasi berhasil mohon untuk melakukan konfirmasi pada email !');
						$this->session->set_flashdata('tipe', 'success');
						redirect(site_url('home'));
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Terjadi kegagalan saat mendaftar !');
						$this->session->set_flashdata('tipe', 'warning');
						$this->register();
					}
				}
			}
		}
	}


	public function konfirmasi($guardcode)
	{

		$data = [
			'guardkode' 	=> $guardcode,
			'view'			=> 'akun/umum/konfirmasi',
		];

		$this->load->view('template/wrapper', $data);
	}

	function kirim_konfirmasi()
	{
		$this->form_validation->set_rules('guardkode', 'Guard Code', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format !');
			$this->session->set_flashdata('tipe', 'error');
			$this->konfirmasi(trim($this->input->post('guardkode', TRUE)));
		} 
		else 
		{
			$check = $this->users_model->checkemail(trim($this->input->post('email', TRUE)));

			if ($check->num_rows() > 0) 
			{
				foreach ($check->result() as $checkr) 
				{
					$email = $checkr->pu_email;
					$validasi = md5($checkr->pu_email);

					if ($validasi == trim($this->input->post('guardkode', TRUE))) 
					{
						$data = array(
							'pu_isaktif' => 'y'
						);

						if ($this->users_model->update($email, $data) == TRUE) 
						{
							$this->session->set_flashdata('message', 'Akun berhasil diaktivasi !');
							$this->session->set_flashdata('tipe', 'success');
							redirect(site_url('akun_umum'));
						} 
						else 
						{
							$this->session->set_flashdata('message', 'Terjadi kegagalan saat mengkonfirmasi akun !');
							$this->session->set_flashdata('tipe', 'error');
							$this->konfirmasi(trim($this->input->post('guardkode', TRUE)));
						}
					} 
					else 
					{
						$this->session->set_flashdata('message', 'Email tidak terdaftar !');
						$this->session->set_flashdata('tipe', 'error');
						$this->konfirmasi(trim($this->input->post('guardkode', TRUE)));
					}
				}
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Email tidak terdaftar !');
				$this->session->set_flashdata('tipe', 'error');
				$this->konfirmasi(trim($this->input->post('guardkode', TRUE)));
			}
		}
	}

	public function ganti_password()
	{
		if (!isset($this->session->userdata['email'])) {
			redirect(base_url('home'));
		}

		$data = [
			'email'			=> $this->session->userdata('email'),
			'view'			=> 'akun/umum/ganti_password',
		];

		$this->load->view('template/wrapper', $data);
	}

	public function konfirmasi_perubahan_password()
	{
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format !');
			$this->session->set_flashdata('tipe', 'error');
			$this->ganti_password();
		}
		else
		{
			$data = [
				'pu_password' => md5($this->input->post('password'))
			];

			if($this->users_model->ubah_password($this->input->post('email'), $data))
			{
				$this->session->set_flashdata('message', 'Password berhasil diubah!');
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('akun_umum/akun'));
			}
			else
			{
				$this->session->set_flashdata('message', 'Password gagal diubah!');
				$this->session->set_flashdata('tipe', 'error');
				$this->ganti_password();
			}
		}
		
	}

	public function lupa_password()
	{
		$data = [
			'view'			=> 'akun/umum/reset_password',
		];

		$this->load->view('template/wrapper', $data);
	}


	public function konfirmasi_reset_password()
	{
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format !');
			$this->session->set_flashdata('tipe', 'error');
			$this->lupa_password();
		}
		else
		{
			$check = $this->users_model->checkemail(trim($this->input->post('email', TRUE)));
			$checkemail = $check->row();

			if(!$checkemail)
			{
				$this->session->set_flashdata('message', 'Email tidak terdaftar!');
				$this->session->set_flashdata('tipe', 'error');
				$this->lupa_password();
			}
			else
			{
				$data = [
					'pu_email'    => $this->input->post('email'),
					'pu_password' => md5($this->input->post('password'))
				];

				if($this->users_model->ubah_password($this->input->post('email'), $data))
				{
					$this->session->set_flashdata('message', 'Password berhasil direset!');
					$this->session->set_flashdata('tipe', 'success');
					redirect(base_url('akun_umum'));
				}
				else
				{
					$this->session->set_flashdata('message', 'Password gagal direset!');
					$this->session->set_flashdata('tipe', 'error');
					$this->lupa_password();
				}
			}
			
		}
	}

	public function modelsertifikat()
	{
		if(!isset($this->session->userdata['email']))
		{
			$this->session->set_flashdata('message', 'Anda Belum Login!');
			$this->session->set_flashdata('tipe', 'error');
			redirect('auth');
		}

		$seminar = $this->input->post('id_seminar');
		$peserta = $this->input->post('id_peserta');

		$row = $this->seminar_model->cetaksertifikatseminarumum($seminar, $peserta);


		if($row)
		{
			$data = [
				'list'         => $row
			];
			
			$this->load->view('admin/seminar/template_sertifikat/template_umum', $data);
		}
		else
		{
			$this->session->set_flashdata('message', 'User ini tidak ada atau belum pernah mendaftar!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun'));
		}
	}

}

/* End of file Akun_umum.php */
/* Location: ./application/controllers/Akun_umum.php */