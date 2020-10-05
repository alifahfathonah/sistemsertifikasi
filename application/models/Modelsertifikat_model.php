<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelsertifikat_model extends CI_Model {

	public $table = 'ssc_model_sertifikat';
	public $id    = 'ms_id';


	function listmodelsertifikat()
	{
		return $this->db->get($this->table)->result();
	}

	function listmodelsertifikatbyid($id)
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
		return $this->db->update($this->table, $data);
	}

	function delete($id)
	{
		$this->db->where($this->id, $id);
		return $this->db->delete($this->table);
	}

	function getid()
	{
		$this->db->select_max('ms_id');
		$query = $this->db->get('ssc_model_sertifikat')->row();
		$id = $query->ms_id;
		if ($id) {
			$id = $id + 1;
		} else {
			$id = 1;
		}
		return $id;
	}

}

/* End of file Modelsertifikat_model.php */
/* Location: ./application/models/Modelsertifikat_model.php */