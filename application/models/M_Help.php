<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Help extends CI_Model
{
    public function getAllHelp() {
        $this->db->select('*');
        $this->db->from('tb_help');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
    
    public function simpan()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('no_whatsapp', 'Nomor Whatsapp', 'trim|required|numeric');
        $this->form_validation->set_rules('jenis_masalah', 'Jenis Masalah', 'trim|required');
        $this->form_validation->set_rules('detail', 'Detail', 'trim|required');

        if ($this->form_validation->run()) {
            $data = array (
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_whatsapp' => $this->input->post('no_whatsapp'),
                'jenis_masalah' => $this->input->post('jenis_masalah'),
                'detail' => $this->input->post('detail')
            );
        
            $this->db->insert('tb_help', $data);
            
            echo "<script>alert('Success wait for respon :) !');history.go(-1);</script>";
        } else { 
            echo "<script>alert('Periksa kembali data yang diinputkan:');history.go(-1);</script>";
        }
    }

    public function hapus_data()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->delete('tb_help');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    
    
    
}