<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{	
		if(isset($this->session->userdata['username']))
		{
			redirect('dashboard');
		}

		$this->load->view('admin/login');
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');
		$this->form_validation->set_message('required', '{field} harus diisi');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('message', 'Mohon isi sesuai dengan format!');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('auth'));
		}
		else
		{
			$email    = $this->input->post('email') . "@uib.ac.id";
			$password = $this->input->post('password');

			$ldapconn = ldap_connect("uib.ac.id");

			if($ldapconn)
			{
				$ldapbind = @ldap_bind($ldapconn, $email, $password);

				if($ldapbind)
				{
					$cek = $this->login_model->cek($email);

					if($cek->num_rows() > 0)
					{
						foreach($cek->result() as $acc)
						{
							if($acc->usr_isaktif == 'y')
							{
								$sess['username']  = $acc->usr_email;
								$sess['nama']      = $acc->usr_nama;
								$sess['group']     = $acc->usr_group;
								$sess['prodi']     = $acc->usr_prodi;
								$sess['status']    = $acc->usr_isaktif;

								$this->session->set_userdata($sess);
								$this->session->set_flashdata('message', 'Selamat datang' .' '. $acc->usr_nama);
								$this->session->set_flashdata('tipe', 'success');
								redirect(base_url('dashboard'));
							}
							else
							{
								$this->session->set_flashdata('message', 'Email belum diaktivasi atau diblokir oleh admin');
								$this->session->set_flashdata('tipe', 'error');
								redirect(base_url('auth'));
							}
						}
					}
					else
					{
						$this->session->set_flashdata('message', 'Email belum Terdaftar');
						$this->session->set_flashdata('tipe', 'error');
						redirect(base_url('auth'));
					}
				}
				else
				{
					$this->session->set_flashdata('message', 'username atau password salah !');
					$this->session->set_flashdata('tipe', 'error');
					redirect(base_url('auth'));
				}
			}
			else
			{
				$this->session->set_flashdata('message', 'terjadi masalah pada server!');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('auth'));
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth'));		
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */