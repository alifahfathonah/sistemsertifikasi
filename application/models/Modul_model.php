<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Modul_model extends CI_Model 
{
    public $table = 'ssc_modul';
    public $id    = 'mdl_id';
    
    function list()
    {
        return $this->db->get($this->table)->result();
    }

    function listbyid($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function mainmenu()
	{
		$this->db->where('mdl_mainmenu =', 0);
		return $this->db->get($this->table)->result();
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
                        
/* End of file Modul_model.php */
    
                        