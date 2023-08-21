<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_document extends CI_Model
{
    public function showAllDocument($id)
    {
        $this->db->select('*');
        $this->db->from('document');
        $this->db->join('submission', 'submission.id_submission = document.submission_id');
        $this->db->where("document.submission_id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function countAllDocument($id)
    {
        $query = $this->db->query("SELECT COUNT( DISTINCT indicator_id) as submission_id FROM document WHERE submission_id = '$id'");
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function addDocument($submission_id, $document)
    {
        $field = array(
            'indicator_id' => $this->input->post('Id'),
            'file' => $document,
            'submission_id' => $submission_id

        );
        $this->db->insert('document', $field);

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

    public function viewDocument()
    {
        $id = $this->input->get('id');
        $this->db->where('id_document', $id);
        $query = $this->db->get('document');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function deleteDocument()
    {
        $id = $this->input->get('id');
        $document = $this->db->where('id_document', $id)->get('document')->row();
        $this->db->where('indicator_id', $document->indicator_id)->update('submission_per_indicator', ['status' => '0']);
        $this->db->where('id_document', $id);
        $this->db->delete('document');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
