<?php

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("user_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        // jika form register disubmit
        if($this->input->post()){
            if($this->user_model->save()) redirect(site_url('admin/barang'));
        }

        // tampilkan halaman register
        $this->load->view("admin/register.php");
    }
}