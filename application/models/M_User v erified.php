<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function showAllUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_detail.company_field = company_field.id_company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->where('user.is_active = 1 ');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function selectUserById($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_field.id_company_field = company_detail.company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->where('user.is_active = 1 ');
        $this->db->where("user.id = '$id' ");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function selectUserByCountry($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->where('company_detail.company_country = ', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    // Certified


    public function showAllCertifiedUser()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('certificate_user', 'certificate_user.id_user = user.id');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_detail.company_field = company_field.id_company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->join('becdex_cat', 'becdex_cat.id_becdex_cat = company_detail.becdex_category_id');
        $this->db->where('user.is_active = 1 ');
        // $this->db->where('company_detail.becdex_category_id > 1 ');
        $this->db->order_by('user.name', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function showAllCertifiedUserByFilter($country, $category)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('certificate_user', 'certificate_user.id_user = user.id');
        $this->db->join('company_detail', 'company_detail.user_id = user.id');
        $this->db->join('company_field', 'company_detail.company_field = company_field.id_company_field');
        $this->db->join('countries', 'countries.iso = company_detail.company_country');
        $this->db->join('becdex_cat', 'becdex_cat.id_becdex_cat = company_detail.becdex_category_id');
        if ($country != 'all') {
            $this->db->where('company_detail.company_country = ', $country);
        }
        if ($category != 'all') {
            $this->db->where('company_detail.becdex_category_id = ', $category);
        }
        $this->db->where('user.is_active = 1 ');
        $this->db->where('company_detail.becdex_category_id > 1 ');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
