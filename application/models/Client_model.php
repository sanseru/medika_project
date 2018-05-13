<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_model extends CI_Model
{

    public $table = 'tbl_client';
    public $id = 'id_client';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result_array();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_client', $q);
	$this->db->or_like('client_name', $q);
	$this->db->or_like('bank_name', $q);
	$this->db->or_like('account_name', $q);
	$this->db->or_like('client_bank_account', $q);
	$this->db->or_like('telephone', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
	$this->db->or_like('saldo', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_client', $q);
	$this->db->or_like('client_name', $q);
	$this->db->or_like('bank_name', $q);
	$this->db->or_like('account_name', $q);
	$this->db->or_like('client_bank_account', $q);
	$this->db->or_like('telephone', $q);
	$this->db->or_like('email', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
	$this->db->or_like('saldo', $q);
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

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Client_model.php */
/* Location: ./application/models/Client_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-09 11:56:48 */
/* http://harviacode.com */