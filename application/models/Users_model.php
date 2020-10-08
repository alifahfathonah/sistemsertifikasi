<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public $id          = 'pu_email';
	public $table       = 'ssc_peserta_umum';


	function cek($email, $password)
	{
		$this->db->select('*');
		$this->db->where("pu_email", $email);
		$this->db->where("pu_password", $password);
		return $this->db->get($this->table);
	}

	function checkemail($email)
	{
		$this->db->select('*');
		$this->db->where("pu_email", $email);
		return $this->db->get($this->table);
	}

	function ubah_password($email, $data)
	{
		$this->db->where("pu_email", $email);
		return $this->db->update($this->table, $data);
	}

	function detail($email)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where("pu_email", $email);
		return $this->db->get()->result();
	}

	function checkktp($ktp)
	{
		$this->db->select('*');
		$this->db->where("pu_ktp", $ktp);
		return $this->db->get($this->table);
	}

	function insert($data)
	{
		try {
			return $this->db->insert($this->table, $data);
		} catch (Exception $e) {
			return FALSE;
		}
	}

    // Merubah data kedalam database
	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		return $this->db->update($this->table, $data);
	}

    // Menghapus data kedalam database
	function delete($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->delete($this->table);
	}

	function listusers($user)
	{
		$this->db->where('pu_email', $user);
		return $this->db->get('ssc_peserta_umum')->row();
	}

}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */