<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_model
{
    private $_table = "penjualans";
    private $_tablebarang = "items";

    public $penjualan_id;
    public $nama_barang;
    public $item_id;

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getItem()
    {
        return $this->db->get($this->_tablebarang)->result();
    }

    public function save($id)
    {   
        $query = $this->db->select('nama_barang')->from('items')->where('item_id',$id)->get()->result_array();
        $this->nama_barang = $query[0]['nama_barang'];
        $this->item_id = $id;
        $this->penjualan_id = uniqid();
        $format = date('Y-m-d H:i:s');
        $this->db->set('tanggal_dibeli',$format);
        return $this->db->insert($this->_table, $this);
    }
}
