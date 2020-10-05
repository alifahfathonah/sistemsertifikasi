<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_mahasiswa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Jika ada session user umum maka diblok
		if (isset($this->session->userdata['email'])) {
			$this->session->set_flashdata('message', 'Maaf anda sedang login sebagai umum !');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('home'));
		}
		// Jika ada session user admin maka diblok
	}

	public function index()
	{
		if (isset($this->session->userdata['npm'])) 
		{
            redirect(base_url('home'));
        }

		$data = [
			'view'	=> 'akun/mahasiswa/login'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function akun()
	{
		if (!isset($this->session->userdata['npm'])) 
		{
            redirect(base_url('akun_mahasiswa'));
        }

		$data = [
			'view'	=> 'akun/mahasiswa/profile'
		];

		$this->load->view('template/wrapper', $data);
	}

	public function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');


		if ($this->form_validation->run() == FALSE) 
		{
			$this->session->set_flashdata('message', 'Mohon isi dengan benar');
			$this->session->set_flashdata('tipe', 'error');
			redirect(base_url('akun_mahasiswa'));
		} 
		else 
		{
            //Login API
			$data = [
				'username'          => $this->input->post('username'),
				'password'          => $this->input->post('password')
			];

			$data_json = json_encode($data);

			$curl = curl_init('http://apps.uib.ac.id/portal/api/v2/login');

			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($data_json)
			));

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

			$result = curl_exec($curl);

			curl_close($curl);

			$data = json_decode($result);

			if (isset($data->id)) 
			{
				$sess['npm']        = $data->id;
				$sess['nama']       = $data->name;
				$sess['jurusan']    = $data->major;

				$this->session->set_userdata($sess);
				$this->session->set_flashdata('message', 'Hello ' . $data->name);
				$this->session->set_flashdata('tipe', 'success');
				redirect(base_url('home'));
			} 
			else 
			{
				$this->session->set_flashdata('message', 'Username atau Password Salah');
				$this->session->set_flashdata('tipe', 'error');
				redirect(base_url('akun_mahasiswa'));
			}
		}
	}

}

/* End of file Akun_mahasiswa.php */
/* Location: ./application/controllers/Akun_mahasiswa.php */