<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_score extends CI_Model
{
    public function initialScore($id)
    {
        $query = $this->db->query("SELECT SUM(value) FROM answer WHERE submission_id = '$id'")->row_array();
        $total_answer = count($this->db->query("SELECT * FROM answer WHERE submission_id = '$id'")->result());
        $initial_score =  $query["SUM(value)"] / $total_answer * 100;

        $this->db->set('initial_score', $initial_score);
        $this->db->where('id_submission', $id);
        $this->db->update('submission');

        if ($query) {
            return $initial_score;
        } else {
            return false;
        }
    }

    public function validScore($id)
    {
        $query = $this->db->query("SELECT SUM(valid_value) FROM answer WHERE submission_id = '$id'")->row_array();
        $total_answer = count($this->db->query("SELECT * FROM answer WHERE submission_id = '$id'")->result());
        $initial_score =  $query["SUM(valid_value)"] / $total_answer * 100;

        $this->db->set('valid_score', $initial_score);
        $this->db->where('id_submission', $id);
        $this->db->update('submission');

        if ($query) {
            return $initial_score;
        } else {
            return false;
        }
    }
}

/* End of file M_score.php */
/* Location: ./application/models/M_submission.php */