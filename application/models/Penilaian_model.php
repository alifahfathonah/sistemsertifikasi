<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian_model extends CI_Model {
    
    public $table = 'ssc_penilaian';
    public $id    = 'pn_id';

    function list()
    {
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_penilaian.pn_sertifikasi');
        return $this->db->get($this->table)->result();
    }

    function listbyid($id)
    {
        $this->db->join('ssc_sertifikasi', 'ssc_sertifikasi.cert_id = ssc_penilaian.pn_sertifikasi');
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

/* End of file Penilaian_model.php */

