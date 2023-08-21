<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Score extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Score');
        include APPPATH . 'third_party\midtrans\Midtrans.php';
    }

    public function initialScore($id)
    {
        $setting = $this->db->get('setting')->row();
        $result = $this->M_Score->initialScore($id);
        $document = $this->db->get_where('document', array('submission_id' => $id))->num_rows();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $setting->server_key;
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        if($result >= 70 && $document >= 35){
            $user_id = $this->session->userdata('id');
            $akunUser = $this->db->get_where('user', array('id' => $user_id))->row();

            $nominal = $setting->nominal;
            $payment = $this->db->order_by('id', 'DESC')->get_where('payment_users', array('submission_id' => $id))->row();
            
            $user = array(
                'first_name' => $akunUser->name
            );

            $items = array(
                array(
                    'id'       => '1',
                    'price'    => $nominal,
                    'quantity' => 1,
                    'name'     => $id
                )
            );

            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $nominal,
                ),
                'customer_details' => $user,
                'item_details' => $items
            );

            if($payment){
                $expired = '<span class="text-danger">Batas waktu pembayaran: '.date('d-m-Y, H:i',strtotime('+1 day',strtotime($payment->transaction_time))).'</span><br><span class="text-dark">Bank: '.strtoupper($payment->bank).', Nomor VA: '.$payment->va_number.'</span><br><button type="button" onclick="konfirmasi(`'.$payment->id.'`, `'.$id.'`)" class="btn btn-success btn-sm">Click to Confirm Payment<i class="fa fa-hand-paper ml-2" aria-hidden="true"></i></button>';
                if(date('Y-m-d H:i') <= date('Y-m-d H:i',strtotime('+1 day',strtotime($payment->transaction_time))) && $payment->transaction_status == 'pending'){
                    $arr = [
                        'initial_score' => $result,
                        'button_payment' => '<button class="btn btn-md btn-success" id="pay-button">Proceed to Payment <i class="fa fa-shopping-cart ml-2" aria-hidden="true"></i></button>',
                        'status' => 'sukses',
                        'submission_id' => $id,
                        'total_harga' => $nominal,
                        'expire_pembayaran' => $expired,
                        'snapToken' => \Midtrans\Snap::getSnapToken($params),
                        'client_key' => $setting->client_key
                    ];
                } else {
                    $arr = [
                        'initial_score' => $result,
                        'button_payment' => '<span class="text-success">Pembayaran Telah Di Konfirmasi</span> <br> <a href="'.base_url().'user/paymentDetail/'.$id.'" class="btn btn-warning btn-md">See Payment</a>',
                        'status' => 'sukses',
                        'submission_id' => $id,
                        'total_harga' => $nominal,
                        'expire_pembayaran' => '',
                        'snapToken' => \Midtrans\Snap::getSnapToken($params),
                        'client_key' => $setting->client_key
                    ];
                }
            } else {
                $arr = [
                    'initial_score' => $result,
                    'button_payment' => '<button class="btn btn-md btn-success" id="pay-button">Proceed to Payment <i class="fa fa-shopping-cart ml-2" aria-hidden="true"></i></button>',
                    'status' => 'sukses',
                    'submission_id' => $id,
                    'total_harga' => $nominal,
                    'expire_pembayaran' => '',
                    'snapToken' => \Midtrans\Snap::getSnapToken($params),
                    'client_key' => $setting->client_key
                ];
            }
            
        } else {
            $arr = [
                'initial_score' => $result,
                'status' => '',
                'button_payment' => '<button class="btn btn-md btn-success" disabled>Proceed to Payment <i class="fa fa-shopping-cart ml-2" aria-hidden="true"></i></button>',
                'client_key' => $setting->client_key
            ];
        }
        echo json_encode($arr);
    }

    public function finishMidtrans()
    {
        if($this->input->is_ajax_request()){
            $data = array(
                'submission_id' => $this->input->post('submission_id'),
                'total_harga' => $this->input->post('total_harga'),
                'payment_type' => $this->input->post('payment_type'),
                'transaction_time' => $this->input->post('transaction_time'),
                'transaction_status' => $this->input->post('transaction_status'),
                'va_number' => $this->input->post('va_number'),
                'bank' => $this->input->post('bank'),
                'user_id' =>  $this->session->userdata('id'),
                'order_id' => $this->input->post('order_id')
            );
            $this->db->insert('payment_users', $data);

            if($this->db->affected_rows() > 0){
                $json = [
                    'sukses' => 'Transaksi Midtrans berhasil tersimpan, silahkan melakukan pembayaran!'
                ];
            } else {
                $json = [
                    'gagal' => 'Transaksi Midtrans gagal tersimpan, silahkan menghubungi admin!'
                ];
            }
            echo json_encode($json);
        } else {
            exit('No direct script access allowed');
        }
    }

    public function validScore($id)
    {
        $result = $this->M_Score->validScore($id);
        echo json_encode($result);
    }
}

/* End of file Score.php */
/* Location: ./application/controllers/Score.php */