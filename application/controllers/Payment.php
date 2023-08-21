<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Payment');
    }

    public function showAllPaymentById($id)
    {
        $result = $this->M_Payment->showAllPaymentById($id);
        echo json_encode($result);
    }

    public function konfirmPayment()
    {
        if($this->input->is_ajax_request()){
            $updatePaymentUser = $this->db->where('id', $this->input->post('id'))->update('payment_users', ['transaction_status' => 'done', 'transaction_time_done' => date('Y-m-d H:i:s')]);
            $updateSubmission = $this->db->where('id_submission', $this->input->post('id_submission'))->update('submission', ['submission_status_id' => '6']);

            if($this->db->affected_rows() > 0){
                $json = [
                    'sukses' => 'Konfirmasi pembayaran berhasil!'
                ];
            } else {
                $json = [
                    'gagal' => 'Konfirmasi pembayaran gagal!, silahkan menghubungi admin!'
                ];
            }
            echo json_encode($json);
        } else {
            exit('No direct script access allowed');
        }
    }

    public function addPayment()
    {
        $config['upload_path'] = "./document/payment/";
        $config['allowed_types'] = 'pdf';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload("document")) {
            $data = array('upload_data' => $this->upload->data());

            $document = $data['upload_data']['file_name'];

            $result = $this->M_Payment->addPayment($document);
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

    public function viewPayment()
    {
        $result = $this->M_Payment->viewPayment();
        echo json_encode($result);
    }

    public function showAllReadyPayment()
    {
        $result = $this->M_Payment->showAllReadyPayment();
        echo json_encode($result);
    }

    public function acceptPayment()
    {
        $result = $this->M_Payment->acceptPayment();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
        }
        // var_dump($result);
        echo json_encode($msg);
    }
}

/* End of file Payment.php */
/* Location: ./application/controllers/Payment.php */