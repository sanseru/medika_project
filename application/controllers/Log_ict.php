<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Log_ict extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Log_ict_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','log_ict/tbl_log_it_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Log_ict_model->json();
    }

    public function read($id) 
    {
        $row = $this->Log_ict_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'user' => $row->user,
		'id_user' => $row->id_user,
		'client' => $row->client,
		'nik_user' => $row->nik_user,
		'permasalahan' => $row->permasalahan,
		'resolusi' => $row->resolusi,
		'waktu' => $row->waktu,
		'created_date' => $row->created_date,
		'status' => $row->status,
		'created_by' => $row->created_by,
		'modify_date' => $row->modify_date,
		'modify_by' => $row->modify_by,
	    );
            $this->template->load('template','log_ict/tbl_log_it_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_ict'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'kodekasus'=>$this->Log_ict_model->getkodeInfo(),
            'action' => site_url('log_ict/create_action'),
        'id' => set_value('id'),
	    'user' => set_value('user'),
	    'client' => set_value('client'),
	    'nik_user' => set_value('nik_user'),
	    'permasalahan' => set_value('permasalahan'),
	    'resolusi' => set_value('resolusi'),
	    'waktu' => set_value('waktu'),
	    'status' => set_value('status'),

    );
        $this->template->load('template','log_ict/tbl_log_it_form', $data);
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
        'kodekasus' => $this->input->post('kodekasus',TRUE),
		'user' => $this->input->post('user',TRUE),
		'id_user' => $this->session->userdata('id_users',TRUE),
		'client' => $this->input->post('client',TRUE),
		'nik_user' => $this->input->post('nik_user',TRUE),
		'permasalahan' => $this->input->post('permasalahan',TRUE),
		'resolusi' => $this->input->post('resolusi',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
		'created_date' => $now,
		'status' => $this->input->post('status',TRUE),
		'created_by' => $this->session->userdata('full_name',TRUE),
        );
        // var_dump($data);

            $this->Log_ict_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('log_ict'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Log_ict_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('log_ict/update_action'),
                'kodekasus'=>set_value('id', $row->kodekasus),
		'id' => set_value('id', $row->id),
		'user' => set_value('user', $row->user),
		'id_user' => set_value('id_user', $row->id_user),
		'client' => set_value('client', $row->client),
		'nik_user' => set_value('nik_user', $row->nik_user),
		'permasalahan' => set_value('permasalahan', $row->permasalahan),
		'resolusi' => set_value('resolusi', $row->resolusi),
		'waktu' => set_value('waktu', $row->waktu),
		'status' => set_value('status', $row->status),
		'modify_date' => set_value('modify_date', $row->modify_date),
		'modify_by' => set_value('modify_by', $row->modify_by),
        );
        // var_dump($data);
            $this->template->load('template','log_ict/tbl_log_it_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_ict'));
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
		'user' => $this->input->post('user',TRUE),
		'client' => $this->input->post('client',TRUE),
		'nik_user' => $this->input->post('nik_user',TRUE),
		'permasalahan' => $this->input->post('permasalahan',TRUE),
		'resolusi' => $this->input->post('resolusi',TRUE),
		'waktu' => $this->input->post('waktu',TRUE),
		'status' => $this->input->post('status',TRUE),
		'modify_date' => $now,
		'modify_by' => $this->session->userdata('full_name',TRUE),
	    );

            $this->Log_ict_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('log_ict'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Log_ict_model->get_by_id($id);

        if ($row) {
            $this->Log_ict_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('log_ict'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('log_ict'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('user', 'user', 'trim|required');
	$this->form_validation->set_rules('client', 'client', 'trim|required');
	$this->form_validation->set_rules('permasalahan', 'permasalahan', 'trim|required');
	$this->form_validation->set_rules('resolusi', 'resolusi', 'trim|required');
	$this->form_validation->set_rules('waktu', 'waktu', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');


	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_log_it.xls";
        $judul = "tbl_log_it";
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
	xlsWriteLabel($tablehead, $kolomhead++, "User");
	xlsWriteLabel($tablehead, $kolomhead++, "Id User");
	xlsWriteLabel($tablehead, $kolomhead++, "Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Nik User");
	xlsWriteLabel($tablehead, $kolomhead++, "Permasalahan");
	xlsWriteLabel($tablehead, $kolomhead++, "Resolusi");
	xlsWriteLabel($tablehead, $kolomhead++, "Waktu");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify By");

	foreach ($this->Log_ict_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->user);
	    xlsWriteNumber($tablebody, $kolombody++, $data->id_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nik_user);
	    xlsWriteLabel($tablebody, $kolombody++, $data->permasalahan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->resolusi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->waktu);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_by);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_log_it.doc");

        $data = array(
            'tbl_log_it_data' => $this->Log_ict_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('log_ict/tbl_log_it_doc',$data);
    }

}

/* End of file Log_ict.php */
/* Location: ./application/controllers/Log_ict.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-16 06:11:41 */
/* http://harviacode.com */