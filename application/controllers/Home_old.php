<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Blue Economy Company Index';
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('certificate_user', 'certificate_user.id_user = user.id');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_detail.company_field = company_field.id_company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->join('becdex_cat', 'becdex_cat.id_becdex_cat = company_detail.becdex_category_id');
        $this->db->where('user.is_active = 1 ');
        $this->db->limit('5');
        $this->db->order_by('user.name', 'ASC');
        $query = $this->db->get()->result();
        $data['company'] = $query;
        $this->load->view('header', $data);
        $this->load->view('index', $data);
        $this->load->view('footer', $data);
    }

    public function about()
    {
        $data['title'] = 'About | Blue Economy Company Index';

        $this->load->view('header', $data);
        $this->load->view('about', $data);
        $this->load->view('footer', $data);
    }

    public function catalog()
    {

        $data['title'] = 'Catalog | Blue Economy Company Index';
        $this->load->model('M_Company_Field');
        $data['company_field'] = $this->M_Company_Field->showAllCompanyField();
        $this->load->model('M_Country');
        $data['countries'] = $this->M_Country->showAllCountry();
        $this->load->model('M_Becdex_Category');
        $data['categories'] = $this->M_Becdex_Category->showAllBecdex_Category();

        $this->load->view('header', $data);
        $this->load->view('catalog', $data);
        $this->load->view('footer', $data);
    }

    public function company_verified($id)
    {
        $data['title'] = 'Company Verified';
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('certificate_user', 'certificate_user.id_user = user.id');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_detail.company_field = company_field.id_company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->join('becdex_cat', 'becdex_cat.id_becdex_cat = company_detail.becdex_category_id');
        $this->db->where('user.is_active = 1 ');
        $this->db->where('user.id', $id);
        $this->db->order_by('user.name', 'ASC');
        $query = $this->db->get()->row();
        $data['company'] = $query;
        $this->load->view('header', $data);
        $this->load->view('company_verified', $data);
        $this->load->view('footer', $data);
    }

    public function showAllCertifiedUser()
    {
        $this->load->model('M_User');
        $result = $this->M_User->showAllCertifiedUser();
        echo json_encode($result);
    }

    public function showAllCertifiedUserByFilter($country, $category)
    {
        $this->load->model('M_User');
        $result = $this->M_User->showAllCertifiedUserByFilter($country, $category);
        echo json_encode($result);
    }

    public function states()
    {
        $data['title'] = 'List of Coastal States | Blue Economy Company Index';
        $this->load->model('M_Country');
        $data['countries'] = $this->M_Country->showAllCountry();

        $this->load->view('header', $data);
        $this->load->view('states', $data);
        $this->load->view('footer', $data);
    }

    public function download()
    {
        $data['title'] = 'Download';

        $data['download'] = $this->db->get('download')->result();
        $this->load->view('header', $data);
        $this->load->view('download', $data);
        $this->load->view('footer', $data);
    }
}
