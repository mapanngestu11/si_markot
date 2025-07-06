<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai  extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('upload');
    $this->load->model('M_user');
    $this->load->model('M_pegawai');
    $this->load->model('M_divisi');

    if($this->session->userdata('masuk') != TRUE){
      $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Login Terlebih Dahulu .</div>');
      $url=base_url('Login');
      redirect($url);
    }

  }

  public function index()
  {
    $data['title'] = "Data Pegawai | PMI Kota Tangerang";
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $data['divisi'] = $this->M_divisi->tampil_data_nama();

    // echo "<pre>";
    // print_r($data['pegawai']->result_array());
    // echo "</pre>";
    // die();
    $this->load->view('pegawai.php',$data);
  }

  public function create()
  {
    $nip = $this->input->post('nip');
    $nik = $this->input->post('nik');
    $nama = $this->input->post('nama');
    $jk = $this->input->post('jk');
    $alamat = $this->input->post('alamat');
    $tempat_lahir = $this->input->post('tempat_lahir');
    $tgl_lahir = $this->input->post('tgl_lahir');
    $pendidikan = $this->input->post('pendidikan');
    $no_hp = $this->input->post('no_hp');
    $email = $this->input->post('email');
    $status = $this->input->post('status');
    $no_sk = $this->input->post('no_sk');
    $tmk = $this->input->post('tmk');
    $tbk = $this->input->post('tbk');
    $jabatan = $this->input->post('jabatan');
    $kode_unor = $this->input->post('kode_unor');

    $cek = $this->M_pegawai->cek_kode_nip($nip);


    if ($cek->num_rows() > 0) {
      $this->session->set_flashdata('toast', json_encode([
        'icon' => 'warning',  
        'title' => ' Nip Sudah terdaftar !'
      ]));
      redirect('pegawai'); 
    } else {
      $data = array(
        'nip'            => $nip,
        'nik'            => $nik,
        'nama'           => $nama,
        'jk'             => $jk,
        'alamat'         => $alamat,
        'tempat_lahir'   => $tempat_lahir,
        'tgl_lahir'      => $tgl_lahir,
        'pendidikan'     => $pendidikan,
        'no_hp'          => $no_hp,
        'email'          => $email,
        'status'         => $status,
        'no_sk'          => $no_sk,
        'tmk'            => $tmk,
        'tbk'            => $tbk,
        'jabatan'        => $jabatan,
        'kode_unor'        => $kode_unor
      );

      $this->M_pegawai->input_data($data, 'tbl_pegawai');


      $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
      ]));
      redirect('pegawai'); 
    }
  }
  public function delete($id_pegawai)
  {
    $id_pegawai = $this->input->post('id_pegawai');
    $this->M_pegawai->delete_data($id_pegawai);
    $this->session->set_flashdata('toast', json_encode([
      'icon' => 'success',  
      'title' => 'Data berhasil dihapus!'
    ]));
    redirect('pegawai');
  }

  public function update()
  {
   $nip = $this->input->post('nip');
   $nik = $this->input->post('nik');
   $nama = $this->input->post('nama');
   $jk = $this->input->post('jk');
   $alamat = $this->input->post('alamat');
   $tempat_lahir = $this->input->post('tempat_lahir');
   $tgl_lahir = $this->input->post('tgl_lahir');
   $pendidikan = $this->input->post('pendidikan');
   $no_hp = $this->input->post('no_hp');
   $email = $this->input->post('email');
   $status = $this->input->post('status');
   $no_sk = $this->input->post('no_sk');
   $tmk = $this->input->post('tmk');
   $tbk = $this->input->post('tbk');
   $jabatan = $this->input->post('jabatan');
   $kode_unor = $this->input->post('kode_unor');
   $id_pegawai = $this->input->post('id_pegawai');

   $data = array(
    'nip'            => $nip,
    'nik'            => $nik,
    'nama'           => $nama,
    'jk'             => $jk,
    'alamat'         => $alamat,
    'tempat_lahir'   => $tempat_lahir,
    'tgl_lahir'      => $tgl_lahir,
    'pendidikan'     => $pendidikan,
    'no_hp'          => $no_hp,
    'email'          => $email,
    'status'         => $status,
    'no_sk'          => $no_sk,
    'tmk'            => $tmk,
    'tbk'            => $tbk,
    'jabatan'        => $jabatan,
    'kode_unor'        => $kode_unor
  );

   $where = array(
    'id_pegawai' => $id_pegawai
  );

   $this->M_pegawai->update_data($where, $data, 'tbl_pegawai');
   $this->session->set_flashdata('toast', json_encode([
    'icon' => 'success',  
    'title' => 'Data berhasil disimpan!'
  ]));
   redirect('pegawai'); 

 }


}
