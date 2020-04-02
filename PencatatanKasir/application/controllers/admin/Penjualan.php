<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("penjualan_model");
        $this->load->model("barang_model");
        $this->load->model("user_model");
        $this->load->library('form_validation');

    }

    public function index()
    {
        $data["penjualans"] = $this->penjualan_model->getAll();
        $this->load->view("admin/penjualan/list", $data);
    }

    public function add()
    {
        $penjualan = $this->penjualan_model;
        $data["items"] = $this->penjualan_model->getItem();

        $this->load->view("admin/penjualan/new_form", $data);
    }

    public function addPenjualan($id = null)
    {
        if(!isset($id)) redirect('admin/penjualan');
        $data["items"] = $this->penjualan_model->getItem();
        $penjualan = $this->penjualan_model;
        $penjualan->save($id);
        $barang = $this->barang_model;
        $barang->dibeli($id);
        $this->load->view("admin/penjualan/new_form",$data);
    }
}
