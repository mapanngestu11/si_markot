<?php defined('BASEPATH') or exit('No direct script access allowed');

class Laporan  extends CI_Controller
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
    $this->load->model('M_nomor');
    $this->load->model('M_pegawai');
    
    if($this->session->userdata('masuk') != TRUE){
      $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Login Terlebih Dahulu .</div>');
      $url=base_url('Login');
      redirect($url);
    }


  }

  public function masuk()
  {

    $data['title'] = 'Laporan Surat Masuk | PMI Kota Tangerang';
    $data['masuk'] = $this->M_surat_masuk->tampil_data();
    $this->load->view('laporan.masuk.php',$data);
  }

  public function keluar()
  {

    $data['title'] = 'Laporan Surat Keluar | PMI Kota Tangerang';
    $data['keluar'] = $this->M_surat_keluar->tampil_data();
    $this->load->view('laporan.keluar.php',$data);
  }

  public function disposisi()
  {
    $data['title'] = 'Laporan Disposisi | PMI Kota Tangerang';
    $data['disposisi'] = $this->M_surat_disposisi->tampil_data();
    $this->load->view('laporan.disposisi.php',$data);
  }

  public function proses_laporan_surat_masuk()
  {
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');

    $data['laporan'] = $this->M_surat_masuk->cek_laporan($tgl_awal,$tgl_akhir);
    $this->load->view('cetak.laporan.surat.masuk.php',$data);
  }
  public function proses_laporan_surat_keluar()
  {
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');

    $data['laporan'] = $this->M_surat_keluar->cek_laporan($tgl_awal,$tgl_akhir);
    $this->load->view('cetak.laporan.surat.keluar.php',$data);
  }
  public function proses_laporan_surat_disposisi()
  {
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');

    $data['laporan'] = $this->M_surat_disposisi->cek_laporan($tgl_awal,$tgl_akhir);
    $this->load->view('cetak.laporan.disposisi.php',$data);
  }




}
