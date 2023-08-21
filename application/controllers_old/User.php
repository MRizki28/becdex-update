<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Submission');
        $this->load->model('M_Country');
        $this->load->model('M_User');
        $this->load->model('M_Company_Field');
        $this->load->model('M_Location_Survey');
        $this->load->library('Pdf');
 }

    public function index()
    {

        $role_id = $this->session->userdata('role_id');
        if ($role_id != 2) {
            redirect('admin');
        }
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function submissionDetail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;

        $submission = $this->db->get_where('submission', ['id_submission' => $id])->row_array();

        if (!$submission) {
            redirect('error');
        }

        $data['title'] = 'Submission Detail';
        $data['submission_detail'] = $this->M_Submission->showChosenSubmission($id);
        $data['client_key'] = $this->db->get('setting')->row()->client_key;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/submission_detail', $data);
        $this->load->view('templates/footer');
    }

    public function paymentDetail($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;

        $submission = $this->db->get_where('submission', ['id_submission' => $id])->row_array();
        if (!$submission) {
            redirect('error');
        }

        $data['title'] = 'Payment Detail';
        $data['submission_detail'] = $this->M_Submission->showChosenSubmission($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/payment_detail', $data);
        $this->load->view('templates/footer');
    }


    public function edit_admin($id)
    {
        $this->db->where('id', $this->session->userdata('id'))->update('user', [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email')
        ]);
        echo "<script>alert('Profil updated'); window.location.href = '".base_url('user/edit/'.$id)."'</script>";
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['user_detail'] = $this->M_User->selectUserById($data['user']['id']);
        $data['country'] = $this->M_Country->showAllCountry();
        $data['company_field'] = $this->M_Company_Field->showAllCompanyField();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('pic_name', 'pic_name', 'required|trim');
        $this->form_validation->set_rules('pic_position', 'pic_position', 'required|trim');
        $this->form_validation->set_rules('pic_email', 'pic_email', 'required|trim');
        $this->form_validation->set_rules('pic_phone', 'pic_phone', 'required|trim');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $pic_name = $this->input->post('pic_name');
            $pic_position = $this->input->post('pic_position');
            $pic_email = $this->input->post('pic_email');
            $pic_phone = $this->input->post('pic_phone');
            $address = $this->input->post('address');
            $country = $this->input->post('country');
            $field = $this->input->post('field');
            $brand = $this->input->post('brand');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config, 'image'); 
                $this->image->initialize($config);

                if ($this->image->do_upload('image')) {
                    // $old_image = $data['user']['image'];
                    // if ($old_image != 'default.jpg') {
                    //     unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    // }
                    $new_image = $this->image->data('file_name');
                    $this->db->set('image', $new_image);
                }
            }


            // cek jika ada gambar yang akan diupload
            $legal_documents = $_FILES['legal_documents']['name'];
            if ($legal_documents) {
                $config['allowed_types'] = 'zip|rar|pdf';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/legal_documents/';
                $config['file_name'] = uniqid().'_'.time().'_'.str_replace(' ', '_', $_FILES['legal_documents']['name']);
                $this->load->library('upload', $config, 'legal_documents');
                $this->legal_documents->initialize($config);
                if ($this->legal_documents->do_upload('legal_documents')) {
                    // $old_image = $data['user']['legal_documents'];
                    // if ($old_image != 'default.jpg') {
                    //     unlink(FCPATH . 'assets/img/legal_documents/' . $old_image);
                    // }
                    $new_image = $this->legal_documents->data('file_name');
                    $this->db->set('legal_documents', $new_image);
                } 
            }

            // cek jika ada gambar yang akan diupload
            $chart = $_FILES['organizational_chart']['name'];
            if ($chart) {
                $config['allowed_types'] = 'jpg|png|pdf';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/organizational_chart/';
                $config['file_name'] = uniqid().'_'.time().'_'.str_replace(' ', '_', $_FILES['organizational_chart']['name']);

                $this->load->library('upload', $config, 'organizational_chart');
                $this->organizational_chart->initialize($config);

                if ($this->organizational_chart->do_upload('organizational_chart')) {
                    // $old_image = $data['user']['organizational_chart'];
                    // if ($old_image != 'default.jpg') {
                    //     unlink(FCPATH . 'assets/img/organizational_chart/' . $old_image);
                    // }
                    $new_image = $this->organizational_chart->data('file_name');
                    $this->db->set('organizational_chart', $new_image);
                } 
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->set('company_phone', $phone);
            $this->db->set('company_country', $country);
            $this->db->set('company_field', $field);
            $this->db->set('company_brand', $brand);
            $this->db->set('pic_name', $pic_name);
            $this->db->set('pic_position', $pic_position);
            $this->db->set('pic_name', $pic_name);
            $this->db->set('pic_email', $pic_email);
            $this->db->set('pic_phone', $pic_phone);
            $this->db->set('address', $address);
            $this->db->where('user_id', $id);
            $this->db->update('company_detail');

            echo "<script>alert('Profil updated'); window.location.href = '".base_url('user/edit')."'</script>";
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function survey($id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['id'] = $id;

        $submission = $this->db->get_where('submission', ['id_submission' => $id])->row_array();
        if (!$submission) {
            redirect('error');
        }

        $data['title'] = 'Survey';
        $data['submission_detail'] = $this->M_Submission->showChosenSubmission($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/survey_detail', $data);
        $this->load->view('templates/footer');
    }

    public function showAllLocationSurveyBySubmission($id)
    {
        $result = $this->M_Location_Survey->showAllLocationSurveyBySubmission($id);
        foreach($result as $key => $val){
            $data[$key]['date'] = date('d-m-Y', strtotime($val->datetime));
            $data[$key]['time'] = date('H:i', strtotime($val->datetime));
            $data[$key]['link'] = $val->link;
            $data[$key]['keterangan'] = $val->keterangan;
        }
        echo json_encode($data);
    }

    public function cetak_certificate($id)
    {
        $cek = $this->db->where('id_submission', $id)->where('id_user', $this->session->userdata('id'))->get('certificate_user');
        if($cek->num_rows() > 0){
            $data['certificate'] = $this->db->where('id_certificate', $cek->row()->id_certificate)->get('certificate')->row();
            $data['published_date'] = $cek->row()->tanggal_publish;
            $data['valid_until'] = $cek->row()->valid_until;
            $data['direktur'] = $cek->row()->direktur;
            $data['detail_submission'] = $this->db->where('id_submission', $id)->get('submission')->row();
            $data['user_detail'] = (object) $this->M_User->selectUserById($cek->row()->id_user);
            $this->load->view('certificate', $data);
        } else {
            echo "<script>alert('Something wrong'); window.location.href = '".base_url('user')."'</script>";
        }
    }
}
