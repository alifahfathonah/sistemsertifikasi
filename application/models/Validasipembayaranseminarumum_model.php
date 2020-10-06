<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validasipembayaranseminarumum_model extends CI_Model {

	public $table = 'ssc_seminar_umum';
	
	function list()
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_umum.su_seminar');
		return $this->db->get($this->table);
	}

	function listbyid($seminar, $email)
	{
		$this->db->join('ssc_seminar', 'ssc_seminar.smr_id = ssc_seminar_umum.su_seminar');
		$this->db->where('su_seminar', $seminar);
		$this->db->where('su_peserta', $email);
		return $this->db->get($this->table)->row();
	}

	function cekstatus($seminar, $email)
	{
		$this->db->where('su_seminar', $seminar);
		$this->db->where('su_peserta', $email);
		$this->db->where('su_status', 'Menunggu Pembayaran');
		return $this->db->get($this->table)->row();
	}

	function setLunas($seminar, $email, $data)
	{
		$this->db->where('su_seminar', $seminar);
		$this->db->where('su_peserta', $email);
		return $this->db->update($this->table, $data);
	}

	function setTolak($seminar, $email, $data)
	{
		$this->db->where('su_seminar', $seminar);
		$this->db->where('su_peserta', $email);
		return $this->db->update($this->table, $data);
	}

	function update_collectiveumum($umum, $seminar, $data)
	{
		$this->db->where('su_seminar', $seminar);
		foreach($umum as $id)
		{
			$this->db->where('su_peserta', $id);
			$this->db->update($this->table, $data[$id]);
		}
		return TRUE;
	}
	

}

/* End of file Validasipembayaranseminarumum_model.php */
/* Location: ./application/models/Validasipembayaranseminarumum_model.php */