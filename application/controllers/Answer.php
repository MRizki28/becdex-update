<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Answer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Answer');
    }

    public function showAllAnswer($id)
    {
        $result = $this->M_Answer->showAllAnswer($id);
        echo json_encode($result);
    }

    public function answerYes()
    {
        $result = $this->M_Answer->answerYes();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    public function validAnswerYes()
    {
        $result = $this->M_Answer->validAnswerYes();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    public function answerNo()
    {
        $result = $this->M_Answer->answerNo();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    public function validAnswerNo()
    {
        $result = $this->M_Answer->validAnswerNo();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}

/* End of file Answer.php */
/* Location: ./application/controllers/Answer.php */