<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_certificate extends CI_Model
{
    public function showAllCertificate()
    {
        $this->db->select('*');
        $this->db->from('certificate');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function editCertificate()
    {
        $id = $this->input->get('id');
        $this->db->where('id_certificate', $id);
        $query = $this->db->get('certificate');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deleteCertificate()
    {
        $id = $this->input->get('id');
        $this->db->where('id_certificate', $id);
        $this->db->delete('certificate');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
