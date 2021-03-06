<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sasaran_mutu_model extends CI_Model
{

    public $table = 'hse_sasaran_mutu';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,periode,created_date,created_by,modify_date,modify_by,keterangan,due_date');
        $this->datatables->from('hse_sasaran_mutu');
        //add this line for join
        //$this->datatables->join('table2', 'hse_sasaran_mutu.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('sasaran_mutu/detail/$1'),'<i class="fa fa-search-plus" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('sasaran_mutu/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('sasaran_mutu/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('sasaran_mutu/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

        function json_2($id) {
        $this->datatables->select('id,departmen,pic,due_date,status,goals,audit,keterangan');
        $this->datatables->from('hse_sasaran_mutu_detail');
        $this->datatables->where('id_samut', $id);
        //add this line for join
        //$this->datatables->join('table2', 'hse_sasaran_mutu_detail.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('hse_sasaran_mutu_detail/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('hse_sasaran_mutu_detail/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('hse_sasaran_mutu_detail/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }
        function get_data_stok($id){
        $query = $this->db->query("
SELECT a.departmen, a.audit AS stok, a.goals AS target, b.periode 
FROM hse_sasaran_mutu_detail a
LEFT JOIN hse_sasaran_mutu b ON b.id = a.id_samut
where id_samut = $id
 
");
         
        if($query->num_rows() > 0){
            foreach($query->result() as $data){
                $hasil[] = $data;
            }
            return $hasil;
        }
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
	$this->db->or_like('periode', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('due_date', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('periode', $q);
	$this->db->or_like('created_date', $q);
	$this->db->or_like('created_by', $q);
	$this->db->or_like('modify_date', $q);
	$this->db->or_like('modify_by', $q);
	$this->db->or_like('keterangan', $q);
	$this->db->or_like('due_date', $q);
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

/* End of file Sasaran_mutu_model.php */
/* Location: ./application/models/Sasaran_mutu_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 08:33:12 */
/* http://harviacode.com */