<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup_model extends CI_Model {

	public $table = 'ssc_user_group';
	public $id    = 'ug_id';

	function list()
	{
		return $this->db->get($this->table)->result();
	}

	function listbyid($id)
	{
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
		return $this->db->update($this->table,$data);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->delete($this->table);
	}
	

}

/* End of file Usergroup_model.php */
/* Location: ./application/models/Usergroup_model.php */