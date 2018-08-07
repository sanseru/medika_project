<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi_finance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Transaksi_finance_model');
        $this->load->model('Client_model');

        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','transaksi_finance/tbl_transaksi_finance_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Transaksi_finance_model->json();
    }

    public function read($id) 
    {
        $row = $this->Transaksi_finance_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'client' => $row->client,
		'id_client' => $row->id_client,
		'nama_rekening' => $row->nama_rekening,
		'rekening' => $row->rekening,
		'keterangan' => $row->keterangan,
		'no_bukti' => $row->no_bukti,
		'jumlah' => $row->jumlah,
		'created_by' => $row->created_by,
		'created_date' => $row->created_date,
		'upload' => $row->upload,
	    );
            $this->template->load('template','transaksi_finance/tbl_transaksi_finance_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_finance'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi_finance/create_action'),
	    'id' => set_value('id'),
	    'client' => set_value('client'),
	    'id_client' => set_value('id_client'),
	    'nama_rekening' => set_value('nama_rekening'),
	    'rekening' => set_value('rekening'),
	    'keterangan' => set_value('keterangan'),
	    'no_bukti' => set_value('no_bukti'),
	    'jumlah' => set_value('jumlah'),
	    'created_by' => set_value('created_by'),
        'created_date' => set_value('created_date'),
        'upload' => set_value('upload'),
	);
        $this->template->load('template','transaksi_finance/tbl_transaksi_finance_form', $data);
    }
    
    public function create_action() 
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('y-m-d H:i:s');
        $this->_rules();
        $file = $this->upload_file();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'client' => $this->input->post('client',TRUE),
		'id_client' => $this->input->post('id_client',TRUE),
		'nama_rekening' => $this->input->post('nama_rekening',TRUE),
		'rekening' => $this->input->post('rekening',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'no_bukti' => $this->input->post('no_bukti',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'created_by' => $this->session->userdata('full_name',TRUE),
        'created_date' => $now,
        'upload'=> $file['file_name']
        );
        // print_r($file);
        // print_r($file['file_name']);

            $this->Transaksi_finance_model->insert($data);
            $lastid = $this->db->insert_id();

            $c_result = $this->Client_model->get_by_id($this->input->post('id_client', TRUE));
            if(isset($c_result)){
                $c_data = array(
                    'saldo' => floatval($c_result->saldo) - floatval($this->input->post('jumlah',TRUE)),
                );

                // var_dump($d_data);
                // var_dump($lastid);

                $this->Client_model->update($this->input->post('id_client', TRUE), $c_data);
                $this->Transaksi_finance_model->update_ok($lastid, $c_data);


            }

            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('transaksi_finance'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Transaksi_finance_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi_finance/update_action'),
		'id' => set_value('id', $row->id),
		'client' => set_value('client', $row->client),
		'id_client' => set_value('id_client', $row->id_client),
		'nama_rekening' => set_value('nama_rekening', $row->nama_rekening),
		'rekening' => set_value('rekening', $row->rekening),
		'keterangan' => set_value('keterangan', $row->keterangan),
		'no_bukti' => set_value('no_bukti', $row->no_bukti),
		'jumlah' => set_value('jumlah', $row->jumlah),
		'created_by' => set_value('created_by', $row->created_by),
		'created_date' => set_value('created_date', $row->created_date),
		'upload' => set_value('upload', $row->upload),
	    );
            $this->template->load('template','transaksi_finance/tbl_transaksi_finance_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_finance'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'client' => $this->input->post('client',TRUE),
		'id_client' => $this->input->post('id_client',TRUE),
		'nama_rekening' => $this->input->post('nama_rekening',TRUE),
		'rekening' => $this->input->post('rekening',TRUE),
		'keterangan' => $this->input->post('keterangan',TRUE),
		'no_bukti' => $this->input->post('no_bukti',TRUE),
		'jumlah' => $this->input->post('jumlah',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'created_date' => $this->input->post('created_date',TRUE),
		'upload' => $this->input->post('upload',TRUE),
	    );

            $this->Transaksi_finance_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('transaksi_finance'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Transaksi_finance_model->get_by_id($id);

        if ($row) {
            $this->Transaksi_finance_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('transaksi_finance'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('transaksi_finance'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('client', 'client', 'trim|required');
	// $this->form_validation->set_rules('id_client', 'id client', 'trim|required');
	$this->form_validation->set_rules('nama_rekening', 'nama rekening', 'trim|required');
	$this->form_validation->set_rules('rekening', 'rekening', 'trim|required');
	$this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
	$this->form_validation->set_rules('no_bukti', 'no bukti', 'trim|required');
	$this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');


	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->Transaksi_finance_model->search_client($_GET['term']);
            if (count($result) > 0) {
            foreach ($result as $row)
            $arr_result[] = array(
                'label'   => $row->client_name,
                'rekening'   => $row->client_bank_account,
                'id_client' => $row->id_client,
                'bank_name' => $row->bank_name,
         );
                echo json_encode($arr_result);
        
            }
        }
    }

    function upload_file(){
        $config['upload_path']          = './assets/foto_profil';
        $config['allowed_types']        = 'gif|jpg|png|xlsx|xls';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('upload');
        $fn = $this->upload->data();
        return $fn; 
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_transaksi_finance.xls";
        $judul = "tbl_transaksi_finance";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Id Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Rekening");
	xlsWriteLabel($tablehead, $kolomhead++, "Rekening");
	xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
	xlsWriteLabel($tablehead, $kolomhead++, "No Bukti");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah");
	xlsWriteLabel($tablehead, $kolomhead++, "Created By");
	xlsWriteLabel($tablehead, $kolomhead++, "Created Date");
	xlsWriteLabel($tablehead, $kolomhead++, "Upload");

	foreach ($this->Transaksi_finance_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id_client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_rekening);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rekening);
	    xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_bukti);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jumlah);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_by);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_date);
	    xlsWriteLabel($tablebody, $kolombody++, $data->upload);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Transaksi_finance.php */
/* Location: ./application/controllers/Transaksi_finance.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-14 09:01:10 */
/* http://harviacode.com */