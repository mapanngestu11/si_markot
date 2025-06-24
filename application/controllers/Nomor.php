<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nomor  extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->model('M_nomor');

        // $this->load->model('M_tagihan');
        // $this->load->model('M_pengajuan');
        // $this->load->model('M_instansi');

        
    }

    public function index()
    {

        $data['title'] = 'Penomoran Surat | PMI Kota Tangerang';
        $data['nomor'] = $this->M_nomor->tampil_data();
        $this->load->view('nomor.surat.php',$data);
    }

    public function create()
    {
     $kode_surat = $this->input->post('kode_surat'); 
     $judul = $this->input->post('judul'); 
     $keterangan = $this->input->post('keterangan'); 
     $bulan = date('m');
     $tahun = date('Y');

     $cek_kode =  $this->M_nomor->get_kode($kode_surat);

     if ($cek_kode->num_rows() > 0 ) {
       $this->session->set_flashdata('toast', json_encode([
        'icon' => 'warning',  
        'title' => 'Kode surat sudah ada !'
    ]));
       redirect('nomor'); 

   }else{
    $new_number =  0;

    $romawi_bulan = $this->M_nomor->to_romawi($bulan);
    $no_surat = $new_number . '/' . $kode_surat . '/' . $romawi_bulan . '/' . $tahun;


    $data = [
        'no_surat' => $no_surat,
        'judul' => $this->input->post('judul'),
        'tanggal' => date('Y-m-d'),
        'kode_surat' => $kode_surat,
        'keterangan' => $keterangan
    ];


    $this->M_nomor->input_data($data, 'tbl_nomor_surat');
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('nomor');
}


}


public function update()
{
    $id_kode = $this->input->post('id_kode');
    $kode_surat = $this->input->post('kode_surat');
    $no_surat = $this->input->post('no_surat');
    $judul = $this->input->post('judul');
    $keterangan = $this->input->post('keterangan');

    $data = array(
        'kode_surat' => $kode_surat,
        'no_surat' => $no_surat,
        'judul' => $judul,
        'keterangan' => $keterangan
    );

    $where = array(
        'id_kode' => $id_kode
    );

    $this->M_nomor->update_data($where, $data, 'tbl_nomor_surat');


    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('nomor'); 

}
public function delete($id_kode)
{
    $id_kode = $this->input->post('id_kode');
    $this->M_nomor->delete_data($id_kode);
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('nomor'); 
}


}
