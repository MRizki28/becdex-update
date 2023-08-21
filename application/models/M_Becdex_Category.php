<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Becdex_Category extends CI_Model
{
    public function showAllBecdex_Category()
    {

        $this->db->select('*');
        $this->db->from('becdex_cat');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
