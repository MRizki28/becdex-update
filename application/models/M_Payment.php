<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_payment extends CI_Model
{
    public function showAllReadyPayment()
    {

        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('submission', 'submission.id_submission = payment.submission_id');
        $this->db->join('user', 'user.id = submission.user_id');
        $this->db->join('payment_status', 'payment.status = payment_status.id_payment_status');
        $this->db->where("payment.status = '1' ");
        $this->db->order_by('payment.upload_date', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $query->result();
        }
    }

    public function showAllPaymentById($id)
    {
        $this->db->select('*');
        $this->db->from('payment');
        $this->db->join('submission', 'submission.id_submission = payment.submission_id');
        $this->db->join('payment_status', 'payment.status = payment_status.id_payment_status', 'left');
        $this->db->where("payment.submission_id = '$id' ");
        $this->db->order_by('payment.upload_date', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function addPayment($document)
    {
        $field = array(
            'submission_id' => $this->input->post('submission_id'),
            'file' => $document,
            'status' => 1

        );
        $this->db->insert('payment', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function viewPayment()
    {
        $id = $this->input->get('id');
        $this->db->where('id_payment', $id);
        $query = $this->db->get('payment');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function acceptPayment()
    {
        $id = $this->input->get('id');
        $field = array(
            'status' => 2
        );
        $this->db->where('id_payment', $id);
        $this->db->update('payment', $field);

        $thisPayment = $this->db->get_where('payment', ['id_payment' => $id])->row_array();

        $field = array(
            'submission_status_id' => 3
        );
        $this->db->where('id_submission', $thisPayment['submission_id']);
        $this->db->update('submission', $field);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}

/* End of file M_payment.php */
/* Location: ./application/models/M_payment.php */