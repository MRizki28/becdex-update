<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_submission extends CI_Model
{
    public function showAllSubmissionById()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];
    
        $this->db->select('submission.*, user.*, submission_status.*, payment_users.*, survey.*');
        $this->db->from('submission');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('submission_status', 'submission_status.id_submission_status = submission.submission_status_id');
        $this->db->join('payment_users', 'payment_users.submission_id = submission.id_submission', 'left');
        $this->db->join('survey', 'survey.submission_id = submission.id_submission', 'left');
        $this->db->where("submission.user_id = '$id' ");
        $this->db->order_by('submission.date_started', 'DESC');
        $this->db->group_by('submission.id_submission');
        $this->db->query("SET sql_mode='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION';"); // set STRICT_TRANS_TABLES and NO_ENGINE_SUBSTITUTION
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    

    

    public function showAllSubmissionByIdSub($id)
    {

        $this->db->select('*');
        $this->db->from('submission_per_indicator');
        $this->db->join('indicator', 'indicator.id_indicator = submission_per_indicator.indicator_id');
        $this->db->where("submission_per_indicator.submission_id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showChosenSubmission($id)
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $user_id = $data['user']['id'];

        $this->db->select('*');
        $this->db->from('submission');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('submission_status', 'submission_status.id_submission_status = submission.submission_status_id');
        $this->db->where("submission.user_id = '$user_id' ");
        $this->db->where("submission.id_submission = '$id' ");
        $this->db->order_by('submission.date_started', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function showThisSubmission($id)
    {
        $this->db->select('*');
        $this->db->from('submission');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('submission_status', 'submission_status.id_submission_status = submission.submission_status_id');
        $this->db->where("submission.id_submission = '$id' ");
        $this->db->order_by('submission.date_started', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function showAllReadySubmission()
    {
        $this->db->select('*');
        $this->db->from('submission');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('submission_status', 'submission_status.id_submission_status = submission.submission_status_id');
        $this->db->where("submission.submission_status_id = '3' ");
        $this->db->or_where("submission.submission_status_id = '2' ");
        $this->db->or_where("submission.submission_status_id = '7' ");
        $this->db->or_where("submission.submission_status_id = '5' ");
        $this->db->order_by('submission.date_started', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function showAllCertifiedSubmission($id)
    {
        $this->db->select('*');
        $this->db->from('submission');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('submission_status', 'submission_status.id_submission_status = submission.submission_status_id');
        $this->db->where("submission.submission_status_id = '5' ");
        $this->db->where("submission.id_submission", $id);
        $this->db->order_by('submission.date_started', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return $query->row_array();
        }
    }

    public function addSubmission()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];
        $slug = substr(strtoupper(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['user']['name']))), 0, 5);
        $data['company_detail'] = $this->db->get_where('company_detail', ['user_id' => $id])->row_array();
        $date = date('Ymd');
        $id_submission = "BXSUB" . $slug . $date;

        $field = array(
            'id_submission' => $id_submission,
            'user_id' => $id,
            'submission_status_id' => 2
        );
        $this->db->insert('submission', $field);

        for ($i = 1; $i <= 50; $i++) {
            $data = $this->db->query("INSERT INTO submission_per_indicator VALUES ('$id_submission', '$i', 0, '')");
        }

        $countAllQuestion = count($this->db->query("select * from question")->result());

        for ($i = 1; $i <= $countAllQuestion; $i++) {
            $data = $this->db->query("INSERT INTO answer VALUES ('','$i', '$id_submission', '', '')");
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function submissionPerIndicatorStatus($id)
    {
        $this->db->select('*');
        $this->db->from('submission_per_indicator');
        $this->db->join('submission', 'submission.id_submission = submission_per_indicator.submission_id');
        $this->db->join('indicator', 'indicator.id_indicator = submission_per_indicator.indicator_id');
        $this->db->join('answer', 'answer.question_id = indicator.id_indicator');
        $this->db->join('per_indicator_status', 'per_indicator_status.id_status_per = submission_per_indicator.status');
        $this->db->where("submission_per_indicator.submission_id = '$id' ");
        $this->db->where("answer.submission_id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function submissionToChecking($id)
    {
        $field = array(
            'submission_status_id' => 3
        );
        $this->db->where('id_submission', $id);
        $this->db->update('submission', $field);

        $data = array(
            'status' => 2
        );
        $this->db->where('submission_id', $id);
        $this->db->update('submission_per_indicator', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function showperIndicator($sub)
    {
        $id = $this->input->get('ind');
        $this->db->where('indicator_id', $id);
        $this->db->where('submission_id', $sub);
        $query = $this->db->get('submission_per_indicator');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}

/* End of file M_submission.php */
/* Location: ./application/models/M_submission.php */