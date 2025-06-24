<?php defined('BASEPATH') or exit('No direct script access allowed');

class Surat  extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->model('M_surat_masuk');
        $this->load->model('M_nomor');
        $this->load->model('M_pegawai');
    }

    public function create()
    {
        $data['title'] = "Buat Surat Baru | PMI Kota Tangerang";
        $data['ns'] = $this->M_nomor->tampil_data();
        $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
        $hasil = $cek_no_agenda->result_array()[0]['no_agenda'];
        $data['pegawai'] = $this->M_pegawai->tampil_data();
        $new_nomor = $hasil + 1 ;
        $data['no_agenda'] = $new_nomor;
        $this->load->view('create.surat.php',$data);
    }

    public function masuk()
    {

        $data['title'] = "Data Surat Masuk | PMI Kota Tangerang";
        $data['masuk'] = $this->M_surat_masuk->tampil_data();
        $this->load->view('surat.masuk.php',$data);
    }

    public function keluar()
    {
      $data['title'] = "Data Surat Keluar | PMI Kota Tangerang";

      $this->load->view('surat.keluar.php',$data);   
  }
}
