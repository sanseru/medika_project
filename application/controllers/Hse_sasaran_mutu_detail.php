<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hse_sasaran_mutu_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Hse_sasaran_mutu_detail_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','hse_sasaran_mutu_detail/hse_sasaran_mutu_detail_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Hse_sasaran_mutu_detail_model->json();
    }

    public function read($id) 
    {
        $row = $this->Hse_sasaran_mutu_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_samut' => $row->id_samut,
		'departmen' => $row->departmen,
		'pic' => $row->pic,
		'due_date' => $row->due_date,
		'status' => $row->status,
		'goals' => $row->goals,
		'audit' => $row->audit,
		'keterangan' => $row->keterangan,
	    );
            $this->template->load('template','hse_sasaran_mutu_detail/hse_sasaran_mutu_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hse_sasaran_mutu_detail'));
        }
    }

    public function create($id) 
    {
        $cek=$this->db->query("select due_date from hse_sasaran_mutu where id='$id'");
         foreach ($cek->result() as $row)
    {
        $due_date =  $row->due_date;
    }
        $data = array(
            'button' => 'Create',
            'action' => site_url('hse_sasaran_mutu_detail/create_action'),
	    'id' => set_value('id'),
	    'id_samut' => $id,
	    'departmen' => set_value('departmen'),
	    'pic' => set_value('pic'),
	    'due_date' => $due_date,
	    'status' => set_value('status'),
	    'goals' => set_value('goals'),
	    'audit' => set_value('audit'),
	    'keterangan' => set_value('keterangan'),
        'created_date' => set_value('created_date'),
        'created_by' => set_value('created_by'),
	);
        $this->template->load('template','hse_sasaran_mutu_detail/hse_sasaran_mutu_detail_form', $data);
    }
    
    public function create_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('y-m-d H:i:s');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // $id= $this->input->post('id_samut',TRUE);

            $data = array(
		'id_samut' => $this->input->post('id_samut',TRUE),
		'departmen' => $this->input->post('departmen',TRUE),
		'pic' => $this->input->post('pic',TRUE),
		'due_date' => $this->input->post('due_date',TRUE),
		'status' => $this->input->post('status',TRUE),
		'goals' => $this->input->post('goals',TRUE),
		'audit' => $this->input->post('audit',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
        'created_date' => $now,
        'created_by' => $this->session->userdata('full_name',TRUE),
    );

            $this->Hse_sasaran_mutu_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('sasaran_mutu/detail/'.$this->input->post('id_samut',TRUE)));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Hse_sasaran_mutu_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('hse_sasaran_mutu_detail/update_action'),
		'id' => set_value('id', $row->id),
		'id_samut' => set_value('id_samut', $row->id_samut),
		'departmen' => set_value('departmen', $row->departmen),
		'pic' => set_value('pic', $row->pic),
		'due_date' => set_value('due_date', $row->due_date),
		'status' => set_value('status', $row->status),
		'goals' => set_value('goals', $row->goals),
		'audit' => set_value('audit', $row->audit),
		'keterangan' => set_value('keterangan', $row->keterangan),
	    );
            $this->template->load('template','hse_sasaran_mutu_detail/hse_sasaran_mutu_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('hse_sasaran_mutu_detail'));
        }
    }
    
    public function update_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('y-m-d H:i:s');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_samut' => $this->input->post('id_samut',TRUE),
		'departmen' => $this->input->post('departmen',TRUE),
		'pic' => $this->input->post('pic',TRUE),
		'due_date' => $this->input->post('due_date',TRUE),
		'status' => $this->input->post('status',TRUE),
		'goals' => $this->input->post('goals',TRUE),
		'audit' => $this->input->post('audit',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
        'modify_date' => $now,
        'modify_by' => $this->session->userdata('full_name',TRUE),
	    );

            $this->Hse_sasaran_mutu_detail_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sasaran_mutu/detail/'.$this->input->post('id_samut',TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $sm=getsm($id);
        $row = $this->Hse_sasaran_mutu_detail_model->get_by_id($id);

        if ($row) {
            $this->Hse_sasaran_mutu_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sasaran_mutu/detail/'.$sm));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sasaran_mutu/detail/'.$sm));
        }
    }

        function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->Hse_sasaran_mutu_detail_model->search_divisi($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
            $arr_result[] = array(
                'label'   => $row->nm_divisi,
                'pic'   => $row->pic,
                // 'id_client' => $row->id_client,
                // 'bank_name' => $row->bank_name,
         );
                echo json_encode($arr_result);
        
            }
        }
    }


    public function _rules() 
    {
	$this->form_validation->set_rules('departmen', 'departmen', 'trim|required');
	$this->form_validation->set_rules('pic', 'pic', 'trim|required');
	$this->form_validation->set_rules('due_date', 'due date', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('goals', 'goals', 'trim|required');
	$this->form_validation->set_rules('audit', 'audit', 'trim|required');
	// $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "hse_sasaran_mutu_detail.xls";
        $judul = "hse_sasaran_mutu_detail";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Samut");
	xlsWriteLabel($tablehead, $kolomhead++, "Departmen");
	xlsWriteLabel($tablehead, $kolomhead++, "Pic");
	xlsWriteLabel($tablehead, $kolomhead++, "Due Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Goals");
	xlsWriteLabel($tablehead, $kolomhead++, "Audit");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

	foreach ($this->Hse_sasaran_mutu_detail_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_samut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->departmen);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pic);
	    xlsWriteLabel($tablebody, $kolombody++, $data->due_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->goals);
	    xlsWriteLabel($tablebody, $kolombody++, $data->audit);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Hse_sasaran_mutu_detail.php */
/* Location: ./application/controllers/Hse_sasaran_mutu_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-08 09:15:25 */
/* http://harviacode.com */