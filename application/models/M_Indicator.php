<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_indicator extends CI_Model
{
    public function showAllIndicator()
    {
        $this->db->select('*');
        $this->db->from('indicator');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
