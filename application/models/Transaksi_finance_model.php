<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_finance_model extends CI_Model
{

    public $table = 'tbl_transaksi_finance';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,client,id_client,nama_rekening,rekening,keterangan,no_bukti,jumlah,created_by,created_date,upload');
        $this->datatables->from('tbl_transaksi_finance');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_transaksi_finance.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('transaksi_finance/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('transaksi_finance/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('transaksi_finance/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('client', $q);
	$this->db->or_like('id_client', $q);
	$this->db->or_like('nama_rekening', $q);
	$this->db->or_like('rekening', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('no_bukti', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('upload', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('client', $q);
	$this->db->or_like('id_client', $q);
	$this->db->or_like('nama_rekening', $q);
	$this->db->or_like('rekening', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('no_bukti', $q);
	$this->db->or_like('jumlah', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('upload', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

        // update data
        function update_ok($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update($this->table, $data);
        }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function search_client($client){
        $this->db->like('client_name', $client , 'both');
        $this->db->order_by('client_name', 'ASC');
        $this->db->limit(10);
        return $this->db->get('tbl_client')->result();
    }

}

/* End of file Transaksi_finance_model.php */
/* Location: ./application/models/Transaksi_finance_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-14 09:01:10 */
/* http://harviacode.com */