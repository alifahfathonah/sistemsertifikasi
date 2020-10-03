<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public $table = 'ssc_user';
	public $id    = 'usr_email';

	function list()
	{
		$this->db->join('ssc_user_group', 'ssc_user_group.ug_id = ssc_user.usr_group');
		return $this->db->get($this->table)->result();
	}

	function listbyid($id)
	{
		$this->db->join('ssc_user_group', 'ssc_user_group.ug_id = ssc_user.usr_group');
		$this->db->where($this->id, $id);
		return $this->db->get($this->table)->row();
	}

	function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function update($id, $data)
	{
		$this->db->where($this->id, $id);
		return $this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->delete($this->table);
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */