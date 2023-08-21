<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Submission');
    }

    public function showAllSubmission()
    {
        $result = $this->M_Submission->showAllSubmission();
        echo json_encode($result);
    }

    public function showAllSubmissionById()
    {
        $result = $this->M_Submission->showAllSubmissionById();
        echo json_encode($result);
    }

    public function showAllSubmissionByIdSub($id)
    {
        $result = $this->M_Submission->showAllSubmissionByIdSub($id);
        echo json_encode($result);
    }

    public function showChosenSubmission($id)
    {
        $result = $this->M_Submission->showChosenSubmission($id);
        echo json_encode($result);
    }

    public function showAllReadySubmission()
    {
        $result = $this->M_Submission->showAllReadySubmission();
        echo json_encode($result);
    }

    public function showAllCertifiedSubmission()
    {
        $result = $this->M_Submission->showAllCertifiedSubmission();
        echo json_encode($result);
    }

    public function showperIndicator($sub)
    {
        $result = $this->M_Submission->showperIndicator($sub);
        echo json_encode($result);
    }

    public function addSubmission()
    {
        $result = $this->M_Submission->addSubmission();
        $msg['type'] = 'add';
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        } else {
            $msg['success'] = false;
        }

        echo json_encode($msg);
    }

    public function submitAllSubmission($id)
    {
        $tombol = $this->input->post('submit');
        if(isset($tombol)){
            $this->db->where('id_submission', $id)->update('submission', ['submission_status_id' => '2']);
            echo "<script>alert('Submission successfully submitted'); window.location.href = '".base_url('user/submissionDetail/'.$id)."'</script>";
        } else {
            echo "<script>alert('Something wrong, contact admin!'); location.reload()</script>";
        }
    }

    public function repostSubmission($id)
    {
        $tombol = $this->input->post('submit');
        if(isset($tombol)){
            $this->db->where('id_submission', $id)->update('submission', ['submission_status_id' => '4', 'reason' => $this->input->post('reason')]);
            echo "<script>alert('Submission must be re-uploaded'); window.location.href = '".base_url('management/submissionManagement/3')."'</script>";
        } else {
            echo "<script>alert('Something wrong, contact admin!'); location.reload()</script>";
        }
    }

    public function submissionPerIndicatorStatus($id)
    {
        $result = $this->M_Submission->submissionPerIndicatorStatus($id);
        echo json_encode($result);
    }

    public function submissionToChecking($id)
    {
        $result = $this->M_Submission->submissionToChecking($id);
        $msg['success'] = false;
        $msg['type'] = 'edit';
        if ($result) {
            $msg['success'] = true;
        }

        echo json_encode($msg);
    }
}

/* End of file Submission.php */
/* Location: ./application/controllers/Submission.php */