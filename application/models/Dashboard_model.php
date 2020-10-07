<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	function gettotalpendaftar()
	{
		$query = $this->db->get('ssc_peserta_umum');

		return $query->num_rows();
	}

	function gettotalseminar()
	{
		$query = $this->db->get('ssc_seminar');

		return $query->num_rows();
	}

	function gettotalmhslulus()
	{
		$this->db->where('sm_status', 'Lulus');

		$query = $this->db->get('ssc_sertifikasi_mahasiswa');

		return $query->num_rows();
	}

	function gettotalmhstidaklulus()
	{
		$this->db->where('sm_status', 'Tidak Lulus');

		$query = $this->db->get('ssc_sertifikasi_mahasiswa');

		return $query->num_rows();
	}

}

/* End of file Dashboard_model.php */
/* Location: ./application/models/Dashboard_model.php */