<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_question extends CI_Model
{
    public function showAllQuestion()
    {

        $this->db->select('*');
        $this->db->from('question');
        $this->db->join('indicator', 'indicator.id_indicator = question.indicator_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showAllQuestionByIndicator($id)
    {

        $this->db->select('*');
        $this->db->from('question');
        $this->db->join('indicator', 'indicator.id_indicator = question.indicator_id');
        $this->db->where('indicator_id = ', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

  
    public function addQuestion()
    {
        $field = array(
            'indicator_id' => ucfirst($this->input->post('indicator_id')),
            'text' => nl2br(strip_tags(ucfirst($this->input->post('text'))))
        );
        $this->db->insert('question', $field);
    
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    

    public function editQuestion()
    {
        $id = $this->input->get('id');
        $this->db->where('id_question', $id);
        $query = $this->db->get('question');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

     public function updateQuestion()
    {
        $id = $this->input->post('Id');
        $field = array(
            'indicator_id' => ucfirst($this->input->post('indicator_id')),
            'text' => nl2br(strip_tags(ucfirst($this->input->post('text'))))
        );
        $this->db->where('id_question', $id);
        $this->db->update('question', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteQuestion()
    {
        $id = $this->input->get('id');
        $this->db->where('id_question', $id);
        $this->db->delete('question');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file M_submission.php */
/* Location: ./application/models/M_submission.php */