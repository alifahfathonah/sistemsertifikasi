<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public $table = 'ssc_user';
	public $id   = 'usr_email';

	function cek($email)
	{
		$this->db->select('*');
		$this->db->where("usr_email", $email);
		return $this->db->get($this->table);
	}	

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */