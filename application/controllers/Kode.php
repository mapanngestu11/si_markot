<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kode  extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->model('M_divisi');

        // $this->load->model('M_tagihan');
        // $this->load->model('M_pengajuan');
        // $this->load->model('M_instansi');

        
    }

    public function index()
    {

        $data['title'] = 'Kode Divisi | PMI Kota Tangerang';
        $data['kode'] = $this->M_divisi->tampil_data();
        $this->load->view('kode.organisasi.php',$data);
    }

    public function create()
    {
       $kode_unor = $this->input->post('kode_unor');
       $nama_divisi = $this->input->post('nama_divisi');
       $keterangan = $this->input->post('keterangan');

       $cek = $this->M_divisi->cek_kode_unor($kode_unor);


       if ($cek->num_rows() > 0) {
          $this->session->set_flashdata('toast', json_encode([
            'icon' => 'warning',  
            'title' => ' Kode Divisi Tidak Boleh Sama !'
        ]));
          redirect('kode'); 
      } else {
        $data = array(
            'kode_unor' => $kode_unor,
            'nama_divisi' => $nama_divisi,
            'keterangan' => $keterangan
        );

        $this->M_divisi->input_data($data, 'tbl_divisi');


        $this->session->set_flashdata('toast', json_encode([
            'icon' => 'success',  
            'title' => 'Data berhasil disimpan!'
        ]));
        redirect('kode'); 
    }
}

public function update()
{
    $id_divisi = $this->input->post('id_divisi');

    $nama_divisi = $this->input->post('nama_divisi');
    $keterangan = $this->input->post('keterangan');
    $data = array(
        'nama_divisi' => $nama_divisi,
        'keterangan' => $keterangan
    );

    $where = array(
        'id_divisi' => $id_divisi
    );

    $this->M_divisi->update_data($where, $data, 'tbl_divisi');


    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('kode'); 

}
public function delete($id_divisi)
{
    $id_divisi = $this->input->post('id_divisi');
    $this->M_divisi->delete_data($id_divisi);
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('kode'); 
}


}
