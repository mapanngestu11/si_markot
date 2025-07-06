<?php defined('BASEPATH') or exit('No direct script access allowed');

class Homepage  extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('upload');

        $this->load->model('M_surat_masuk');
        $this->load->model('M_surat_keluar');
        $this->load->model('M_surat_disposisi');
        $this->load->model('M_user');

        if($this->session->userdata('masuk') != TRUE){
            $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Login Terlebih Dahulu .</div>');
            $url=base_url('Login');
            redirect($url);
        }
        
    }

    public function index()
    {

        $data['sm']    = $this->M_surat_masuk->jumlah_data()->result();
        $data['sk']    = $this->M_surat_keluar->jumlah_data()->result();
        $data['dp']    = $this->M_surat_disposisi->jumlah_data()->result();
        $data['du']    = $this->M_user->jumlah_data()->result();
        $data['title'] = 'Selamat Datang di Homepage';
        $this->load->view('Homepage.php',$data);
    }
}
