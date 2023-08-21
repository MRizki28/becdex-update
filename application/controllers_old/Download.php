<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $role_id = $this->session->userdata('role_id');
        if ($role_id == 1) {
            # code..
        }else{
            redirect('user');
        }

        $data['title'] = 'Download';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['download'] = $this->db->get('download')->result_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'icon', 'required');

        if ($this->form_validation->run() ==  false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('download/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New download added!</div>');
            redirect('download');
        }
    }

   public function addDownload()
    {
        $new_name = uniqid().'_'.time().'_'.str_replace(' ', '_', $_FILES['file']['name']);
        $config['upload_path'] = "./assets/download/";
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['file_name'] = $new_name;
        // $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload("file")) {

            $data = array('upload_data' => $this->upload->data());
            $document = $new_name;
            $insert = $this->db->insert('download', ['title' => $this->input->post('title'), 'file' => $new_name]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New download added!</div>');
            redirect('download');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add Download Failed, Required All!</div>');
            redirect('download');
        }
    }

    public function updateDownload()
    {
        $new_name = uniqid().'_'.time().'_'.str_replace(' ', '_', $_FILES['file']['name']);
        $config['upload_path'] = "./assets/download/";
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['file_name'] = $new_name;
        // $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload("file")) {

            $data = array('upload_data' => $this->upload->data());
            $document = $new_name;
            $insert = $this->db->where('id', $this->input->post('id'))->update('download', ['title' => $this->input->post('title'), 'file' => $new_name]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New download updated!</div>');
            redirect('download');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New download updated!</div>');
            redirect('download');
        }
    }

    public function deleteDownload()
    {
        $delete = $this->db->where('id', $this->input->get('id'))->delete('download');
        $msg['status'] = 'tidak';
        if ($delete) {
            $msg['status'] = 'sukses';
        }
        echo json_encode($msg);
    }
}

/* End of file Becdex.php */
/* Location: ./application/controllers/Becdex.php */