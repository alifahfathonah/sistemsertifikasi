<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulgroup_model extends CI_Model {

	public $table = 'ssc_modul_group';

	function getmodulgroup($id_group)
	{
		$this->db->join('ssc_modul', 'ssc_modul.mdl_id = ssc_modul_group.mg_modul');
		$this->db->where('mg_usergroup', $id_group);
		return $this->db->get($this->table)->result();
	}

	function cek($id_group,$id_modul) 
	{
		$this->db->where('mg_modul',$id_modul);
		$this->db->where('mg_usergroup', $id_group);
		$query = $this->db->get('ssc_modul_group')->row();
		if($query) {
			return false;
		}else {
			return true;
		}
	}
	
	function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	function delete($id, $group_id)
	{
		$this->db->where('mg_id', $id);
		$this->db->where('mg_usergroup', $group_id);
		return $this->db->delete($this->table);
	}

}

/* End of file Modulgroup_model.php */
/* Location: ./application/models/Modulgroup_model.php */