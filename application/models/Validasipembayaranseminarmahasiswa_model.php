<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasipembayaranseminarmahasiswa_model extends CI_Model {

	public $table = 'ssc_seminar_mahasiswa';
	
	function list()
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_mahasiswa.smhs_seminar');
		return $this->db->get($this->table);
	}

	function listbyid($npm, $seminar)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_mahasiswa.smhs_seminar');
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->get($this->table)->row();
	}

	function cekstatus($npm, $seminar)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		$this->db->where('smhs_status', 'Menunggu Pembayaran');
		return $this->db->get($this->table)->row();
	}

	function setLunas($npm, $seminar, $data)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->update($this->table, $data);
	}

	function setTolak($npm, $seminar, $data)
	{
		$this->db->where('smhs_mahasiswa', $npm);
		$this->db->where('smhs_seminar', $seminar);
		return $this->db->update($this->table, $data);
	}

	function update_collectivemahasiswa($mhs, $seminar, $data)
	{
		$this->db->where('smhs_seminar', $seminar);
		foreach($mhs as $id)
		{
			$this->db->where('smhs_mahasiswa', $id);
			$this->db->update($this->table, $data[$id]);
		}
		return TRUE;
	}

}

/* End of file Validasipembayaranseminarmahasiswa_model.php */
/* Location: ./application/models/Validasipembayaranseminarmahasiswa_model.php */