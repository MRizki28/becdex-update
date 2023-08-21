<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{   
	    parent::__construct();
	    $this->load->library('Pdf');
	}
	public function index($id)
	{
	    $data['pegawai'] = $this->db->get('pegawai')->result();
	    $this->load->view('v_laporan', $data);
	}
}