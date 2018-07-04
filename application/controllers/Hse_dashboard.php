<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hse_dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Hse_dashboard_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
                $cek=$this->db->query("select due_date from hse_sasaran_mutu ");
                // --where id='$id'
         foreach ($cek->result() as $row)
    {
        $due_date =  $row->due_date;

        
         $data = array(
            "graf"=>$this->Hse_dashboard_model->get_data_stok(),
);
        $this->template->load('template','Hse_dashboard/hse_dashboard',$data);
    } 
    
   

}
}

/* End of file Sasaran_mutu.php */
/* Location: ./application/controllers/Sasaran_mutu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 08:33:12 */
/* http://harviacode.com */