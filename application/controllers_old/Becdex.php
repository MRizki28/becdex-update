<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Becdex extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Becdex');
    }


    public function showAllAspect()
    {
        $result = $this->M_Becdex->showAllAspect();
        echo json_encode($result);
    }

    public function showAllOutcome()
    {
        $result = $this->M_Becdex->showAllOutcome();
        echo json_encode($result);
    }

    public function showAllPrinciple()
    {
        $result = $this->M_Becdex->showAllPrinciple();
        echo json_encode($result);
    }

    public function showAllIndicator($id_submission)
    {
        $result = $this->M_Becdex->showAllIndicator($id_submission);
        echo json_encode($result);
    }

    public function detailIndicator()
    {
        $result = $this->M_Becdex->detailIndicator();
        echo json_encode($result);
    }
}

/* End of file Becdex.php */
/* Location: ./application/controllers/Becdex.php */