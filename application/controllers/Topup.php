<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Client_model');
        $this->load->model('Topup_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/topup/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/topup/index/';
            $config['first_url'] = base_url() . 'index.php/topup/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Topup_model->total_rows($q);
        $topup = $this->Topup_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'topup_data' => $topup,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','topup/tbl_topup_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Topup_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'no_bukti' => $row->no_bukti,
		'keterangan' => $row->keterangan,
		'rekening' => $row->rekening,
		'id_client' => $row->id_client,
		'client' => $row->client,
		'jml_topup' => $row->jml_topup,
		'created_date' => $row->created_date,
		'created_by' => $row->created_by,
	    );
            $this->template->load('template','topup/tbl_topup_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topup'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('topup/create_action'),
	    'id' => set_value('id'),
	    'no_bukti' => set_value('no_bukti'),
	    'keterangan' => set_value('keterangan'),
	    'rekening' => set_value('rekening'),
	    'id_client' => set_value('id_client'),
	    'client' => set_value('client'),
	    'jml_topup' => set_value('jml_topup'),
	    'created_date' => set_value('created_date'),
	    'created_by' => set_value('created_by'),
	);
        $this->template->load('template','topup/tbl_topup_form', $data);
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
                'no_bukti' => $this->input->post('no_bukti',TRUE),
                'keterangan' => $this->input->post('keterangan',TRUE),
                'rekening' => $this->input->post('rekening',TRUE),
                'id_client' => $this->input->post('id_client',TRUE),
                'client' => $this->input->post('client',TRUE),
                'jml_topup' => $this->input->post('jml_topup',TRUE),
                'created_date' => $now,
                'created_by' => $this->session->userdata('full_name',TRUE),
            );
            $this->Topup_model->insert($data);
            // $s_result = $this->Topup_model->insert($data);
            // if($s_result){
                $c_result = $this->Client_model->get_by_id($this->input->post('id_client', TRUE));
                if(isset($c_result)){
                    var_dump($c_result);
                    var_dump($c_result->saldo);
                    $c_data = array(
                        'saldo' => intval($this->input->post('jml_topup',TRUE)) + intval($c_result->saldo)
                    );
                    var_dump($c_data);
                    $this->Client_model->update($this->input->post('id_client', TRUE), $c_data);
                }
                
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('topup'));
            // }else{
            //    $this->session->set_flashdata('message', 'Create Record unSuccess');
            // }
            
        }
    }
    
    public function update($id) 
    {
        $row = $this->Topup_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('topup/update_action'),
                'id' => set_value('id', $row->id),
                'no_bukti' => set_value('no_bukti', $row->no_bukti),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'rekening' => set_value('rekening', $row->rekening),
                'id_client' => set_value('id_client', $row->id_client),
                'client' => set_value('client', $row->client),
                'jml_topup' => set_value('jml_topup', $row->jml_topup),
                'created_date' => set_value('created_date', $row->created_date),
                'created_by' => set_value('created_by', $row->created_by),
            );
            $this->template->load('template','topup/tbl_topup_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topup'));
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
		'no_bukti' => $this->input->post('no_bukti',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'rekening' => $this->input->post('rekening',TRUE),
		'id_client' => $this->input->post('id_client',TRUE),
		'client' => $this->input->post('client',TRUE),
		'jml_topup' => $this->input->post('jml_topup',TRUE),
        'update_date' => $now,
        'update_by' => $this->session->userdata('full_name',TRUE)
	    );

            $this->Topup_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('topup'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Topup_model->get_by_id($id);

        if ($row) {
            $this->Topup_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('topup'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topup'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_bukti', 'no bukti', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('rekening', 'rekening', 'trim|required');
	$this->form_validation->set_rules('client', 'client', 'trim|required');
	$this->form_validation->set_rules('jml_topup', 'jml topup', 'trim|required');


	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->Topup_model->search_client($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
            $arr_result[] = array(
                'label'   => $row->client_name,
                'rekening'   => $row->client_bank_account,
                'id_client' => $row->id_client,
         );
                echo json_encode($arr_result);
        
            }
        }
    }
 

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_topup.xls";
        $judul = "tbl_topup";
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
	xlsWriteLabel($tablehead, $kolomhead++, "No Bukti");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Rekening");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Jml Topup");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");

	foreach ($this->Topup_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_bukti);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rekening);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jml_topup);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Topup.php */
/* Location: ./application/controllers/Topup.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-10 01:40:03 */
/* http://harviacode.com */