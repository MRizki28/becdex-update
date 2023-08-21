<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_answer extends CI_Model
{
    public function showAllAnswer($id)
    {
        $this->db->select('*');
        $this->db->from('answer');
        $this->db->join('question', 'question.id_question = answer.question_id');
        $this->db->join('submission', 'submission.id_submission = answer.submission_id');
        $this->db->join('indicator', 'indicator.id_indicator = question.indicator_id');
        $this->db->join('submission_per_indicator', 'submission_per_indicator.indicator_id = indicator.id_indicator');
        $this->db->where("answer.submission_id = '$id' ");
        $this->db->where("submission_per_indicator.submission_id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function answerYes()
    {
        $id = $this->input->get('id');
        $this->db->set('value', '1');
        $this->db->where('id_answer', $id);
        $this->db->update('answer');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validAnswerYes()
    {
        $id = $this->input->get('id');
        $this->db->set('valid_value', '1');
        $this->db->where('id_answer', $id);
        $this->db->update('answer');

        $this->db->select('*');
        $this->db->from('answer');
        $this->db->join('question', 'question.id_question = answer.question_id');
        $this->db->join('indicator', 'indicator.id_indicator = question.indicator_id');
        $this->db->where("answer.id_answer = '$id' ");
        $query = $this->db->get()->row_array();

        $this->db->set('status', '3');
        $this->db->where('indicator_id', $query['indicator_id']);
        $this->db->where('submission_id', $query['submission_id']);
        $this->db->update('submission_per_indicator');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function answerNo()
    {
        $id = $this->input->get('id');
        $this->db->set('value', '0');
        $this->db->where('id_answer', $id);
        $this->db->update('answer');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validAnswerNo()
    {
        $id = $this->input->POST('Id');
        $this->db->set('valid_value', '0');
        $this->db->where('id_answer', $id);
        $this->db->update('answer');

        $this->db->select('*');
        $this->db->from('answer');
        $this->db->join('question', 'question.id_question = answer.question_id');
        $this->db->join('indicator', 'indicator.id_indicator = question.indicator_id');
        $this->db->where("answer.id_answer = '$id' ");
        $query = $this->db->get()->row_array();

        $this->db->set('status', '4');
        $this->db->set('comment', $this->input->post('comment'));
        $this->db->where('indicator_id', $query['indicator_id']);
        $this->db->where('submission_id', $query['submission_id']);
        $this->db->update('submission_per_indicator');

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file M_submission.php */
/* Location: ./application/models/M_submission.php */