<?php
class Help_controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_Help');
    }

    function save()
    {
        if ($this->M_Help->simpan()) {
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }
    public function hapus_data()
    {
        $result = $this->M_Help->hapus_data();
        $msg['success'] = false;
        if ($result) {
            $msg['success'] = true;
         
        }
        // var_dump($result);
        echo json_encode($msg);
    }
    
}
