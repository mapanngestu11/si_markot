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
        $this->load->model('M_surat_keluar');
        $this->load->model('M_surat_disposisi');
        $this->load->model('M_nomor');
        $this->load->model('M_pegawai');
    }

    public function create_surat_masuk()
    {
        $data['title'] = "Buat Surat Masuk | PMI Kota Tangerang";
        $data['ns'] = $this->M_nomor->tampil_data();
        $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
        $hasil = $cek_no_agenda->result_array()[0]['no_agenda'];
        $data['pegawai'] = $this->M_pegawai->tampil_data();
        $new_nomor = $hasil + 1 ;
        $data['no_agenda'] = $new_nomor;
        $this->load->view('create.surat.masuk.php',$data);
    }

    public function masuk()
    {

        $data['title'] = "Data Surat Masuk | PMI Kota Tangerang";
        $data['masuk'] = $this->M_surat_masuk->tampil_data();
        $this->load->view('surat.masuk.php',$data);
    }

    public function update_surat_masuk($id_surat_masuk)
    {
     $data['title'] = "Data Surat Masuk | PMI Kota Tangerang";
     $data['masuk'] = $this->M_surat_masuk->get_byId($id_surat_masuk);
     $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
     $hasil = $cek_no_agenda->result_array()[0]['no_agenda'];
     $data['pegawai'] = $this->M_pegawai->tampil_data();
     $new_nomor = $hasil + 1 ;
     $data['no_agenda'] = $new_nomor;
     $this->load->view('update.surat.masuk.php',$data);
 }
 public function disposisi()
 {

    $data['title'] = "Data Surat Disposisi | PMI Kota Tangerang";
    $data['disposisi'] = $this->M_surat_disposisi->tampil_data();
    $this->load->view('surat.disposisi.php',$data);
}
public function create_surat_disposisi()
{
    $data['title'] = "Buat Surat Disposisi | PMI Kota Tangerang";
    $data['masuk'] = $this->M_surat_masuk->tampil_data();
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $this->load->view('create.surat.disposisi.php',$data); 
}
public function update_surat_disposisi($id_disposisi)
{
  $data['title'] = "Data Surat Disposisi | PMI Kota Tangerang";
  $data['masuk'] = $this->M_surat_masuk->tampil_data();
  $data['pegawai'] = $this->M_pegawai->tampil_data();
  $data['disposisi'] = $this->M_surat_disposisi->get_byId($id_disposisi);
  $this->load->view('update.surat.disposisi.php',$data); 

}

public function keluar()
{
  $data['title'] = "Data Surat Keluar | PMI Kota Tangerang";
  $data['keluar'] = $this->M_surat_keluar->tampil_data();
  $this->load->view('surat.keluar.php',$data);   
}
public function create_surat_keluar()
{
    $data['title'] = "Buat Surat Keluar | PMI Kota Tangerang";
    $data['keluar'] = $this->M_surat_keluar->tampil_data();
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $data['kode_surat'] = $this->M_nomor->tampil_data();
    $this->load->view('create.surat.keluar.php',$data); 
}
public function update_surat_keluar($id_surat_keluar)
{
    $data['title'] = "Data Surat Keluar | PMI Kota Tangerang";
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $data['kode_surat'] = $this->M_nomor->tampil_data();
    $data['disposisi'] = $this->M_surat_keluar->get_byId($id_surat_keluar);
    $this->load->view('update.surat.keluar.php',$data); 

}


}
