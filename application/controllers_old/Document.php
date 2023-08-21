<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Document');
    }

    public function showAllDocument($id)
    {
        $result = $this->M_Document->showAllDocument($id);
        echo json_encode($result);
    }

    public function countAllDocument($id)
    {
        $result = $this->M_Document->countAllDocument($id);
        echo json_encode($result);
    }

    public function addDocument($id)
    {
        $submission_id = $id;
        $new_name = uniqid().'_'.time().'_'.str_replace(' ', '_', $_FILES['document']['name']);
        $config['upload_path'] = "./document/submission/";
        $config['allowed_types'] = 'pdf|xlsx|xls|zip|rar|tar|dmg|kgb';
        $config['file_name'] = $new_name;
        // $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload("document")) {

            $data = array('upload_data' => $this->upload->data());
            $document = $new_name;
            $result = $this->M_Document->addDocument($submission_id, $document);
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

    public function viewDocument()
    {
        $result = $this->M_Document->viewDocument();
        echo json_encode($result);
    }

    public function deleteDocument()
    {
        $result = $this->M_Document->deleteDocument();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }

}

/* End of file Becdex.php */
/* Location: ./application/controllers/Becdex.php */