<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sasaran_mutu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Sasaran_mutu_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','sasaran_mutu/hse_sasaran_mutu_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Sasaran_mutu_model->json();
    }

    public function read($id) 
    {
        $row = $this->Sasaran_mutu_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'periode' => $row->periode,
		'created_date' => $row->created_date,
		'created_by' => $row->created_by,
		'modify_date' => $row->modify_date,
		'modify_by' => $row->modify_by,
		'keterangan' => $row->keterangan,
		'due_date' => $row->due_date,
	    );
            $this->template->load('template','sasaran_mutu/hse_sasaran_mutu_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sasaran_mutu'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sasaran_mutu/create_action'),
	    'id' => set_value('id'),
	    'periode' => set_value('periode'),
	    'created_date' => set_value('created_date'),
	    'created_by' => set_value('created_by'),
	    'modify_date' => set_value('modify_date'),
	    'modify_by' => set_value('modify_by'),
	    'keterangan' => set_value('keterangan'),
	    'due_date' => set_value('due_date'),
	);
        $this->template->load('template','sasaran_mutu/hse_sasaran_mutu_form', $data);
    }
    
    public function create_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('y-m-d H:i:s');
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'periode' => $this->input->post('periode',TRUE),
		'created_date' => $now,
		'created_by' => $this->session->userdata('full_name',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'due_date' => $this->input->post('due_date',TRUE),
	    );

            $this->Sasaran_mutu_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('sasaran_mutu'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sasaran_mutu_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sasaran_mutu/update_action'),
		'id' => set_value('id', $row->id),
		'periode' => set_value('periode', $row->periode),
		'created_date' => set_value('created_date', $row->created_date),
		'created_by' => set_value('created_by', $row->created_by),
		'modify_date' => set_value('modify_date', $row->modify_date),
		'modify_by' => set_value('modify_by', $row->modify_by),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'due_date' => set_value('due_date', $row->due_date),
	    );
            $this->template->load('template','sasaran_mutu/hse_sasaran_mutu_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sasaran_mutu'));
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
		'periode' => $this->input->post('periode',TRUE),
		'modify_date' => $now,
		'modify_by' => $this->session->userdata('full_name',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'due_date' => $this->input->post('due_date',TRUE),
	    );

            $this->Sasaran_mutu_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sasaran_mutu'));
        }
    }
    

    public function detail($id){

        $data = array(
            'all' =>$this->db->where('id_samut',$id)->get('hse_sasaran_mutu_detail')->result(), 
            "id"=>$id,
            "graf"=>$this->Sasaran_mutu_model->get_data_stok($id),
);

        $this->template->load('template','sasaran_mutu/sasaran_mutu_detail',$data);
    }

    

public function json_2() {
        header('Content-Type: application/json');
        echo $this->Sasaran_mutu_model->json_2();
    }




    public function delete($id) 
    {
        $row = $this->Sasaran_mutu_model->get_by_id($id);

        if ($row) {
            $this->Sasaran_mutu_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sasaran_mutu'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sasaran_mutu'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('periode', 'periode', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('due_date', 'due date', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "hse_sasaran_mutu.xls";
        $judul = "hse_sasaran_mutu";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Periode");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify By");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Due Date");

	foreach ($this->Sasaran_mutu_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->periode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->due_date);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Sasaran_mutu.php */
/* Location: ./application/controllers/Sasaran_mutu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-06-05 08:33:12 */
/* http://harviacode.com */