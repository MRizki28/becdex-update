<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Location_Survey extends CI_Model
{
    public function showAllLocationSurveyBySubmission($id)
    {

        $this->db->select('*');
        $this->db->from('survey');
        $this->db->where('submission_id', $id);
        $this->db->order_by('datetime', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addLocationSurvey($id)
    {
        $field = array(
            'submission_id' => $id,
            'keterangan' => $this->input->post('keterangan'),
            'datetime' => $this->input->post('date') . " " . $this->input->post('time'),
            'link' => $this->input->post('link')

        );
        $this->db->insert('survey', $field);

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
