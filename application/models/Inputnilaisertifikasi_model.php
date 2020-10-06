<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inputnilaisertifikasi_model extends CI_Model {

	function listsertifikasiumum($id_batch)
	{
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('ssu_batch', $id_batch);
		$this->db->where('ssu_status', 'Lunas');
		return $this->db->get('ssc_subsertifikasi_umum')->result();
	}

	function list_nilaiumum($id_subsertifikasiumum, $id_sertifikasiumum, $id_batch)
	{
		$this->db->join('ssc_sertifikasi_umum', 'ssc_sertifikasi_umum.srtu_id = ssc_subsertifikasi_umum.ssu_sertifikasi_umum');
		$this->db->join('ssc_peserta_umum', 'ssc_peserta_umum.pu_email = ssc_sertifikasi_umum.srtu_peserta');
		$this->db->where('ssu_id', $id_subsertifikasiumum);
		$this->db->where('ssu_sertifikasi_umum', $id_sertifikasiumum);
		$this->db->where('ssu_batch', $id_batch);
		return $this->db->get('ssc_subsertifikasi_umum')->row();
	}

	public function update($id_subsertifikasiumum, $id_sertifikasiumum, $id_batch, $data)
	{
		$this->db->where('ssu_id', $id_subsertifikasiumum);
		$this->db->where('ssu_sertifikasi_umum', $id_sertifikasiumum);
		$this->db->where('ssu_batch', $id_batch);
		return $this->db->update('ssc_subsertifikasi_umum', $data);
	}
    // Mahasiswa
	function listsertifikasimahasiswa($id_batch)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_batch', $id_batch);
		$this->db->where('ssm_status', 'Lunas');
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->result();
	}

	function list_nilaimahasiswa($id_subsertifikasimahasiswa, $id_sertifikasimahasiswa, $id_batch)
	{
		$this->db->join('ssc_sertifikasi_mahasiswa', 'ssc_sertifikasi_mahasiswa.sm_id = ssc_subsertifikasi_mahasiswa.ssm_sertifikasi_mahasiswa');
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_sertifikasi_mahasiswa', $id_sertifikasimahasiswa);
		$this->db->where('ssm_batch', $id_batch);
		return $this->db->get('ssc_subsertifikasi_mahasiswa')->row();
	}

	public function update_mahasiswa($id_subsertifikasimahasiswa, $id_sertifikasimahasiswa, $id_batch, $data)
	{
		$this->db->where('ssm_id', $id_subsertifikasimahasiswa);
		$this->db->where('ssm_sertifikasi_mahasiswa', $id_sertifikasimahasiswa);
		$this->db->where('ssm_batch', $id_batch);
		return $this->db->update('ssc_subsertifikasi_mahasiswa', $data);
	}

	function getnama($npm)
	{
		$data_mhs = [
			'npm'  => $npm,
		];

		$data_json = json_encode($data_mhs);
		$curl = curl_init('http://apps.uib.ac.id/portal/api/v2/myprofile');

		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'content-type:application/json',
			'Content-Length: ' . strlen($data_json)
		));

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);

		$result = curl_exec($curl);
		$data_mahasiswa = json_decode($result);

		curl_close($curl);
		return $data_mahasiswa;
	}

}

/* End of file Inputnilaisertifikasi_model.php */
/* Location: ./application/models/Inputnilaisertifikasi_model.php */