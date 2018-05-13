<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Client_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/client/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/client/index/';
            $config['first_url'] = base_url() . 'index.php/client/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Client_model->total_rows($q);
        $client = $this->Client_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'client_data' => $client,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','client/tbl_client_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Client_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_client' => $row->id_client,
		'client_name' => $row->client_name,
		'bank_name' => $row->bank_name,
		'account_name' => $row->account_name,
		'client_bank_account' => $row->client_bank_account,
		'telephone' => $row->telephone,
		'email' => $row->email,
		'created_date' => $row->created_date,
		'created_by' => $row->created_by,
		'modify_date' => $row->modify_date,
		'modify_by' => $row->modify_by,
		'saldo' => $row->saldo,
	    );
            $this->template->load('template','client/tbl_client_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('client'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('client/create_action'),
	    'id_client' => set_value('id_client'),
	    'client_name' => set_value('client_name'),
	    'bank_name' => set_value('bank_name'),
	    'account_name' => set_value('account_name'),
	    'client_bank_account' => set_value('client_bank_account'),
	    'telephone' => set_value('telephone'),
	    'email' => set_value('email'),
	    'created_date' => set_value('created_date'),
	    'created_by' => set_value('created_by'),
	    'modify_date' => set_value('modify_date'),
	    'modify_by' => set_value('modify_by'),
	    'saldo' => set_value('saldo'),
	);
        $this->template->load('template','client/tbl_client_form', $data);
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
		'client_name' => $this->input->post('client_name',TRUE),
		'bank_name' => $this->input->post('bank_name',TRUE),
		'account_name' => $this->input->post('account_name',TRUE),
		'client_bank_account' => $this->input->post('client_bank_account',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'created_date' => $now,
		'created_by' => $this->session->userdata('full_name',TRUE),
		'saldo' => $this->input->post('saldo',TRUE),
	    );

            $this->Client_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('client'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Client_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('client/update_action'),
		'id_client' => set_value('id_client', $row->id_client),
		'client_name' => set_value('client_name', $row->client_name),
		'bank_name' => set_value('bank_name', $row->bank_name),
		'account_name' => set_value('account_name', $row->account_name),
		'client_bank_account' => set_value('client_bank_account', $row->client_bank_account),
		'telephone' => set_value('telephone', $row->telephone),
		'email' => set_value('email', $row->email),
		'modify_date' => set_value('modify_date', $row->modify_date),
		'modify_by' => set_value('modify_by', $row->modify_by),
		'saldo' => set_value('saldo', $row->saldo),
	    );
            $this->template->load('template','client/tbl_client_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('client'));
        }
    }
    
    public function update_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('y-m-d H:i:s');

        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_client', TRUE));
        } else {
            $data = array(
		'client_name' => $this->input->post('client_name',TRUE),
		'bank_name' => $this->input->post('bank_name',TRUE),
		'account_name' => $this->input->post('account_name',TRUE),
		'client_bank_account' => $this->input->post('client_bank_account',TRUE),
		'telephone' => $this->input->post('telephone',TRUE),
		'email' => $this->input->post('email',TRUE),
		'modify_date' => $now,
		'modify_by' => $this->session->userdata('full_name',TRUE),
		'saldo' => $this->input->post('saldo',TRUE),
	    );

            $this->Client_model->update($this->input->post('id_client', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('client'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Client_model->get_by_id($id);

        if ($row) {
            $this->Client_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('client'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('client'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('client_name', 'client name', 'trim|required');
	$this->form_validation->set_rules('bank_name', 'bank name', 'trim|required');
	$this->form_validation->set_rules('account_name', 'account name', 'trim|required');
	$this->form_validation->set_rules('client_bank_account', 'client bank account', 'trim|required');
	$this->form_validation->set_rules('telephone', 'telephone', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	// $this->form_validation->set_rules('created_date', 'created date', 'trim|required');
	// $this->form_validation->set_rules('created_by', 'created by', 'trim|required');
	// $this->form_validation->set_rules('modify_date', 'modify date', 'trim|required');
	// $this->form_validation->set_rules('modify_by', 'modify by', 'trim|required');
	$this->form_validation->set_rules('saldo', 'saldo', 'trim|required');

	$this->form_validation->set_rules('id_client', 'id_client', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_client.xls";
        $judul = "tbl_client";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Client Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Bank Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Account Name");
	xlsWriteLabel($tablehead, $kolomhead++, "Client Bank Account");
	xlsWriteLabel($tablehead, $kolomhead++, "Telephone");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Modify By");
	xlsWriteLabel($tablehead, $kolomhead++, "Saldo");

	foreach ($this->Client_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->client_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->account_name);
	    xlsWriteLabel($tablebody, $kolombody++, $data->client_bank_account);
	    xlsWriteLabel($tablebody, $kolombody++, $data->telephone);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->modify_by);
	    xlsWriteNumber($tablebody, $kolombody++, $data->saldo);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Client.php */
/* Location: ./application/controllers/Client.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-09 11:56:48 */
/* http://harviacode.com */