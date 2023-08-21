<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_becdex extends CI_Model
{
    public function showAllAspect()
    {
        $this->db->select('*');
        $this->db->from('aspect');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function editAspect()
    {
        $id = $this->input->get('id');
        $this->db->where('id_aspect', $id);
        $query = $this->db->get('aspect');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateAspect()
    {
        $id = $this->input->post('Id');
        $field = array(
            'aspect_name' => ucfirst($this->input->post('aspect_name'))
        );
        $this->db->where('id_aspect', $id);
        $this->db->update('aspect', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllOutcome()
    {

        $this->db->select('*');
        $this->db->from('outcome');
        $this->db->join('aspect', 'aspect.id_aspect = outcome.aspect_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function editOutcome()
    {
        $id = $this->input->get('id');
        $this->db->where('id_outcome', $id);
        $query = $this->db->get('outcome');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateOutcome()
    {
        $id = $this->input->post('Id');
        $field = array(
            'outcome_name' => ucfirst($this->input->post('outcome_name')),
            'aspect_id' => $this->input->post('aspect_id')
        );
        $this->db->where('id_outcome', $id);
        $this->db->update('outcome', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllPrinciple()
    {

        $this->db->select('*');
        $this->db->from('principle');
        $this->db->join('outcome', 'outcome.id_outcome = principle.outcome_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function editPrinciple()
    {
        $id = $this->input->get('id');
        $this->db->where('id_principle', $id);
        $query = $this->db->get('principle');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updatePrinciple()
    {
        $id = $this->input->post('Id');
        $field = array(
            'principle_name' => ucfirst($this->input->post('principle_name')),
            'outcome_id' => $this->input->post('outcome_id')
        );
        $this->db->where('id_principle', $id);
        $this->db->update('principle', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showAllIndicator($id_submission = null)
    {
        if($id_submission == null){
            $this->db->select('*');
            $this->db->from('indicator');
            $this->db->join('principle', 'principle.id_principle = indicator.principle_id');
            $this->db->order_by('indicator.id_indicator', 'asc');
            $query = $this->db->get();
        } else {
            $this->db->select('*');
            $this->db->from('indicator');
            $this->db->join('submission_per_indicator', 'submission_per_indicator.indicator_id = indicator.id_indicator');
            $this->db->join('answer', 'answer.question_id = indicator.id_indicator');
            $this->db->join('principle', 'principle.id_principle = indicator.principle_id');
            $this->db->where('answer.submission_id', $id_submission);
            $this->db->where('submission_per_indicator.submission_id', $id_submission);
            $this->db->order_by('indicator.id_indicator', 'asc');
            $query = $this->db->get();
        }
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function editIndicator()
    {
        $id = $this->input->get('id');
        $this->db->where('id_indicator', $id);
        $query = $this->db->get('indicator');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function updateIndicator()
    {
        $id = $this->input->post('Id');
        $field = array(
            'indicator_name' => ucfirst($this->input->post('indicator_name')),
            'principle_id' => $this->input->post('principle_id'),
           'indicator_desc' => nl2br(strip_tags($this->input->post('indicator_desc'))) // ubah baris baru ke tag HTML <br>
        );
        $this->db->where('id_indicator', $id);
        $this->db->update('indicator', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function detailIndicator()
    {
        $id = $this->input->get('id');
        $this->db->where('id_indicator', $id);
        $query = $this->db->get('indicator');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}

/* End of file M_submission.php */
/* Location: ./application/models/M_submission.php */