<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_ict_model extends CI_Model
{

    public $table = 'tbl_log_it';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kodekasus,id,user,id_user,client,nik_user,permasalahan,resolusi,waktu,created_date,status,created_by,modify_date,modify_by');
        $this->datatables->from('tbl_log_it');
        $this->datatables->add_column('status', '$1', 'rename_string_status(status)');
        //add this line for join
        //$this->datatables->join('table2', 'tbl_log_it.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('log_ict/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('log_ict/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('log_ict/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
	$this->db->or_like('user', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('client', $q);
	$this->db->or_like('nik_user', $q);
	$this->db->or_like('permasalahan', $q);
	$this->db->or_like('resolusi', $q);
	$this->db->or_like('waktu', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('user', $q);
	$this->db->or_like('id_user', $q);
	$this->db->or_like('client', $q);
	$this->db->or_like('nik_user', $q);
	$this->db->or_like('permasalahan', $q);
	$this->db->or_like('resolusi', $q);
	$this->db->or_like('waktu', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
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

    function getKodeInfo(){
        $q = $this->db->query("select MAX(RIGHT(id,3)) as kd_max from tbl_log_it");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }
        return "ICT-".$kd;
}

}

/* End of file Log_ict_model.php */
/* Location: ./application/models/Log_ict_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-16 06:11:41 */
/* http://harviacode.com */