<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_country extends CI_Model
{
    public function showAllCountry()
    {

        $this->db->select('*');
        $this->db->from('countries');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addCountry()
    {
        $field = array(
            'nicename' => ucfirst($this->input->post('nicename')),
            'iso' => strtoupper($this->input->post('iso'))

        );
        $this->db->insert('countries', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editCountry()
    {
        $id = $this->input->get('id');
        $this->db->where('id_country', $id);
        $query = $this->db->get('countries');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateCountry()
    {
        $id = $this->input->post('Id');
        $field = array(
            'nicename' => ucfirst($this->input->post('nicename')),
            'iso' => strtoupper($this->input->post('iso'))
        );
        $this->db->where('id_country', $id);
        $this->db->update('countries', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCountry()
    {
        $id = $this->input->get('id');
        $this->db->where('id_country', $id);
        $this->db->delete('countries');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}