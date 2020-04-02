<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $_table = "items";

    public $item_id;
    public $nama_barang;
    public $harga_barang;
    public $stok_barang;

    public function rules(){
        return[
            ['field'=>'name',
            'label'=>'Name',
            'rules'=>'required'],
            
            ['field'=>'harga',
            'label'=>'Harga',
            'rules'=>'required'],

            ['field'=>'stok',
            'label'=>'Stok',
            'rules'=>'required']
        ];
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function getById($id){
        return $this->db->get_where($this->_table, ["item_id" => $id])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->item_id = uniqid();
        $this->nama_barang = $post["name"];
        $this->harga_barang = $post["harga"];
        $this->stok_barang = $post["stok"];
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->item_id = $post["id"];
        $this->nama_barang = $post["name"];
        $this->harga_barang = $post["harga"];
        $this->stok_barang = $post["stok"];
        return $this->db->update($this->_table, $this, array('item_id' => $post['id']));
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("item_id" => $id)); 
    }

    public function dibeli($id)
    {
        $query = $this->db->select('stok_barang')->from('items')->where('item_id',$id)->get()->result_array();
        $query_nama = $this->db->select('nama_barang')->from('items')->where('item_id',$id)->get()->result_array();
        $query_harga = $this->db->select('harga_barang')->from('items')->where('item_id',$id)->get()->result_array();
        $nama = $query_nama[0]['nama_barang'];
        $biaya = $query_harga[0]['harga_barang'];
        $total = $query[0]['stok_barang'];
        if(!$total) return false;
        $stokbaru = $total - 1;
        $this->item_id = $id;
        $this->stok_barang = $stokbaru;
        $this->nama_barang = $nama;
        $this->harga_barang = $biaya;
        return $this->db->update($this->_table, $this, array('item_id' => $id));
    }
}