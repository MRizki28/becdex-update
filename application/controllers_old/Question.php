<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Question');
    }

    //Company_Field Management Start

    public function showAllQuestion()
    {
        $result = $this->M_Question->showAllQuestion();
        echo json_encode($result);
    }

    public function showAllQuestionByIndicator($id)
    {
        $result = $this->M_Question->showAllQuestionByIndicator($id);
        echo json_encode($result);
    }

    public function addQuestion()
    {

        $result = $this->M_Question->addQuestion();
        if ($result) {
            $msg['type'] = 'add';
            $msg['success'] = false;
            if ($result) {
                $msg['success'] = true;
            }

            echo json_encode($msg);
        } else {
            $msg['success'] = false;
        }
    }

    public function editQuestion()
    {
        $result = $this->M_Question->editQuestion();
        echo json_encode($result);
    }

    public function updateQuestion()
    {
        $result = $this->M_Question->updateQuestion();
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }

    public function deleteQuestion()
    {
        $result = $this->M_Question->deleteQuestion();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

    //Company_Field Management End
}


/* End of file Question.php */
/* Location: ./application/controllers/Question.php */