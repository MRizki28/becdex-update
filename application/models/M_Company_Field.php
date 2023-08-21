<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_company_field extends CI_Model
{
    public function showAllCompanyField()
    {
        $this->db->select('*');
        $this->db->from('company_field');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addCompanyField()
    {
        $field = array(
            'field_name' => ucfirst($this->input->post('name'))

        );
        $this->db->insert('company_field', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editCompanyField()
    {
        $id = $this->input->get('id');
        $this->db->where('id_company_field', $id);
        $query = $this->db->get('company_field');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateCompanyField()
    {
        $id = $this->input->post('Id');
        $field = array(
            'field_name' => ucfirst($this->input->post('name'))
        );
        $this->db->where('id_company_field', $id);
        $this->db->update('company_field', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCompanyField()
    {
        $id = $this->input->get('id');
        $this->db->where('id_company_field', $id);
        $this->db->delete('company_field');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}