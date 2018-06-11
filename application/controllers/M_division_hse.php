<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_division_hse extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('M_division_hse_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','m_division_hse/m_division_hse_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->M_division_hse_model->json();
    }

    public function read($id) 
    {
        $row = $this->M_division_hse_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nm_divisi' => $row->nm_divisi,
		'pic' => $row->pic,
		'created_date' => $row->created_date,
		'created_by' => $row->created_by,
		'modify_date' => $row->modify_date,
		'modify_by' => $row->modify_by,
	    );
            $this->template->load('template','m_division_hse/m_division_hse_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_division_hse'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_division_hse/create_action'),
	    'id' => set_value('id'),
	    'nm_divisi' => set_value('nm_divisi'),
	    'pic' => set_value('pic'),
	    'created_date' => set_value('created_date'),
	    'created_by' => set_value('created_by'),
	    'modify_date' => set_value('modify_date'),
	    'modify_by' => set_value('modify_by'),
	);
        $this->template->load('template','m_division_hse/m_division_hse_form', $data);
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
		'nm_divisi' => $this->input->post('nm_divisi',TRUE),
		'pic' => $this->input->post('pic',TRUE),
		'created_date' => $now,
		'created_by' => $this->session->userdata('full_name',TRUE),

	    );

            $this->M_division_hse_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('m_division_hse'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_division_hse_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_division_hse/update_action'),
		'id' => set_value('id', $row->id),
		'nm_divisi' => set_value('nm_divisi', $row->nm_divisi),
		'pic' => set_value('pic', $row->pic),
		'created_date' => set_value('created_date', $row->created_date),
		'created_by' => set_value('created_by', $row->created_by),
		'modify_date' => set_value('modify_date', $row->modify_date),
		'modify_by' => set_value('modify_by', $row->modify_by),
	    );
            $this->template->load('template','m_division_hse/m_division_hse_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_division_hse'));
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
		'nm_divisi' => $this->input->post('nm_divisi',TRUE),
		'pic' => $this->input->post('pic',TRUE),
		'modify_date' => $now,
		'modify_by' => $this->session->userdata('full_name',TRUE),
	    );

            $this->M_division_hse_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_division_hse'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_division_hse_model->get_by_id($id);

        if ($row) {
            $this->M_division_hse_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_division_hse'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_division_hse'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nm_divisi', 'nm divisi', 'trim|required');
	$this->form_validation->set_rules('pic', 'pic', 'trim|required');


	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_division_hse.xls";
        $judul = "m_division_hse";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nm Divisi");
	xlsWriteLabel($tablehead, $kolomhead++, "Pic");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify By");

	foreach ($this->M_division_hse_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nm_divisi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pic);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_by);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file M_division_hse.php */
/* Location: ./application/controllers/M_division_hse.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-31 03:40:21 */
/* http://harviacode.com */