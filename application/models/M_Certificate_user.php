<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_certificate_user extends CI_Model
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

    public function showAllCertificateBySubmission($id)
    {
        $this->db->select('*');
        $this->db->from('certificate');
        $this->db->join('submission', 'submission.id_submission = certificate.submission_id');
        $this->db->where("certificate.submission_id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function countAllCertificate($id)
    {
        $query = $this->db->query("SELECT COUNT( DISTINCT indicator_id) as submission_id FROM certificate WHERE submission_id = '$id'");
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function addCertificate($submission_id, $certificate)
    {
        $field = array(
            'indicator_id' => $this->input->post('Id'),
            'file' => $certificate,
            'submission_id' => $submission_id

        );
        $this->db->insert('certificate', $field);

        $data['submission'] = $this->db->get_where('submission_per_indicator', ['indicator_id' => $this->input->post('Id'), 'submission_id' => $submission_id])->row_array();

        if ($data['submission']['status'] == 0) {
            $this->db->set('status', 1);
            $this->db->where('indicator_id', $this->input->post('Id'));
            $this->db->where('submission_id', $submission_id);
            $this->db->update('submission_per_indicator');
        }

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function viewCertificate()
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

    public function generateCertificate($id)
    {
        $field = array(
            'submission_status_id' => 5
        );
        $this->db->where('id_submission', $id);
        $this->db->update('submission', $field);
        if ($this->db->affected_rows() > 0) {
            return true;
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
