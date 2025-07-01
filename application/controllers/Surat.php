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

    if (!empty($cek) && isset($cek[0]['no_agenda'])) {
      $hasil = $cek[0]['no_agenda'];
      $new_nomor = $hasil + 1;
    } else {
      $new_nomor = 1; 
    }

    $data['pegawai'] = $this->M_pegawai->tampil_data_divisi();
    $data['no_agenda'] = str_pad($new_nomor, 3, '0', STR_PAD_LEFT); 
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

    $data['cek_no'] = $this->M_surat_masuk->get_byId($id_surat_masuk);
    $no_surat     = $data['cek_no']->result_array()[0]['no_surat'];

    $data['data_ms'] = $this->M_surat_masuk->get_byNosurat($no_surat);

    $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
    $hasil = $cek_no_agenda->result_array()[0]['no_agenda'];
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $new_nomor = $hasil + 1 ;
    $data['no_agenda'] = str_pad($new_nomor, 3, '0', STR_PAD_LEFT);
    $this->load->view('update.surat.masuk.php',$data);
  }

  public function view_surat_masuk($id_surat_masuk)
  {

    $data['title'] = "Data Surat Masuk | PMI Kota Tangerang";

    $data['cek_no'] = $this->M_surat_masuk->get_byId($id_surat_masuk);
    $no_surat     = $data['cek_no']->result_array()[0]['no_surat'];

    $data['data_ms'] = $this->M_surat_masuk->get_byNosurat($no_surat);

    $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
    $hasil = $cek_no_agenda->result_array()[0]['no_agenda'];
    $data['pegawai'] = $this->M_pegawai->tampil_data();
    $new_nomor = $hasil + 1 ;
    $data['no_agenda'] = str_pad($new_nomor, 3, '0', STR_PAD_LEFT);
    $this->load->view('view.surat.masuk.php',$data);
  }

  public function proses_add_surat_masuk()
  {

    $config['upload_path'] = './assets/upload/'; 
    $config['allowed_types'] = 'pdf|PDF';
    $config['encrypt_name'] = TRUE; 
    $config['max_size']  = 10000;

    $this->upload->initialize($config);
    if (!empty($_FILES['file_surat_masuk']['name'])) {
      if ($this->upload->do_upload('file_surat_masuk')) {
        $gbr = $this->upload->data();

        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/upload/' . $gbr['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '100%';
        $config['new_image'] = './assets/upload/' . $gbr['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $file = $gbr['file_name'];
        $sifat_surat      = $this->input->post('sifat_surat');
        $tgl_terima   = $this->input->post('tgl_terima');
        $no_agenda        = $this->input->post('no_agenda');
        $perihal          = $this->input->post('perihal');
        $no_surat         = $this->input->post('no_surat');
        $tgl_surat_masuk  = $this->input->post('tgl_surat_masuk');
        $asal_surat       = $this->input->post('asal_surat');
        $nip_pegawai      = $this->input->post('nip_pegawai'); 

        if (!empty($nip_pegawai)) {
          foreach ($nip_pegawai as $nip) {
            $data = [
              'sifat_surat'      => $sifat_surat,
              'tgl_terima'       => $tgl_terima,
              'no_agenda'        => $no_agenda,
              'perihal'          => $perihal,
              'no_surat'         => $no_surat,
              'tgl_surat_masuk'  => $tgl_surat_masuk,
              'asal_surat'       => $asal_surat,
              'file_surat_masuk' => $file,
              'nip_pegawai'      => $nip
            ];

            $this->M_surat_masuk->input_data($data, 'tbl_surat_masuk');
          }

          $this->session->set_flashdata('toast', json_encode([
            'icon'  => 'success',
            'title' => 'Data berhasil disimpan untuk semua pegawai!'
          ]));
        } else {
          $this->session->set_flashdata('toast', json_encode([
            'icon'  => 'error',
            'title' => 'NIP pegawai tidak boleh kosong!'
          ]));
        }

      } else {
        // Gagal upload file
        $this->session->set_flashdata('toast', json_encode([
          'icon'  => 'warning',
          'title' => 'Ukuran atau format file tidak sesuai!'
        ]));
      }
    } else {
    // Tidak ada file yang dipilih
      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'danger',
        'title' => 'Data gagal tersimpan! File tidak ditemukan.'
      ]));
    }

// Redirect setelah proses apapun
    redirect('Surat/masuk');

  }

  public function proses_update_surat_masuk()
  {
    $config['upload_path']   = './assets/upload/';
    $config['allowed_types'] = 'pdf|PDF';
    $config['encrypt_name']  = TRUE;
    $config['max_size']      = 10000;

    $this->upload->initialize($config);

    $file = null;

    if (!empty($_FILES['file_surat_masuk']['name'])) {
      if ($this->upload->do_upload('file_surat_masuk')) {
        $gbr = $this->upload->data();

    // Optional image resize (tidak wajib untuk PDF)
        $config['image_library'] = 'gd2';
        $config['source_image'] = './assets/upload/' . $gbr['file_name'];
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['quality'] = '100%';
        $config['new_image'] = './assets/upload/' . $gbr['file_name'];
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();

        $file = $gbr['file_name'];
      } else {
        $this->session->set_flashdata('toast', json_encode([
          'icon'  => 'warning',
          'title' => 'Ukuran atau format file tidak sesuai!'
        ]));
        redirect('Surat/masuk');
      }
    }

    $sifat_surat      = $this->input->post('sifat_surat');
    $tgl_terima   = $this->input->post('tgl_terima');
    $no_agenda        = $this->input->post('no_agenda');
    $perihal          = $this->input->post('perihal');
    $no_surat         = $this->input->post('no_surat');
    $tgl_surat_masuk  = $this->input->post('tgl_surat_masuk');
    $asal_surat       = $this->input->post('asal_surat');
    $nip_pegawai      = $this->input->post('nip_pegawai');

    if (!empty($nip_pegawai)) {
      $nip_lama = $this->M_surat_masuk->get_nip_by_no_surat($no_surat);
      $hapus  = array_diff($nip_lama, $nip_pegawai);
      $tambah = array_diff($nip_pegawai, $nip_lama);
      $tetap  = array_intersect($nip_pegawai, $nip_lama);

  // Hapus
      foreach ($hapus as $nip) {
        $this->M_surat_masuk->hapus_nip_by_no_surat($no_surat, $nip);
      }

  // Tambah
      foreach ($tambah as $nip) {
        $data = [
          'sifat_surat'      => $sifat_surat,
          'tgl_terima'       => $tgl_terima,
          'no_agenda'        => $no_agenda,
          'perihal'          => $perihal,
          'no_surat'         => $no_surat,
          'tgl_surat_masuk'  => $tgl_surat_masuk,
          'asal_surat'       => $asal_surat,
          'nip_pegawai'      => $nip
        ];

        if ($file !== null) {
          $data['file_surat_masuk'] = $file;
        }

        $this->M_surat_masuk->input_data($data, 'tbl_surat_masuk');
      }

  // Update yang tetap
      foreach ($tetap as $nip) {
        $data = [
          'sifat_surat'      => $sifat_surat,
          'tgl_terima'       => $tgl_terima,
          'no_agenda'        => $no_agenda,
          'perihal'          => $perihal,
          'tgl_surat_masuk'  => $tgl_surat_masuk,
          'asal_surat'       => $asal_surat
        ];

        if ($file !== null) {
          $data['file_surat_masuk'] = $file;
        }

        $this->M_surat_masuk->update_data_by_nip($no_surat, $nip, $data);
      }

      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'success',
        'title' => 'Data berhasil disimpan !'
      ]));
    } else {
      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'error',
        'title' => 'NIP pegawai tidak boleh kosong!'
      ]));
    }

    redirect('Surat/masuk');

  }
  public function proses_delete_surat_masuk()
  {
    $no_surat = $this->input->post('no_surat');
    $this->M_surat_masuk->delete_data($no_surat);
    $this->session->set_flashdata('toast', json_encode([
      'icon' => 'success',  
      'title' => 'Data berhasil dihapus!'
    ]));
    redirect('Surat/masuk');
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
  function format_tanggal_indo($tanggal) {
    $bulan = [
      1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    $pecah = explode('-', $tanggal); // [0] = tahun, [1] = bulan, [2] = hari
    return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
  }
  function cek_nomor_surat()
  {
    $kode = $this->input->post('kode_surat');
    $this->db->select_max('no_surat'); 
    $this->db->where('kode_surat', $kode);
    $query = $this->db->get('tbl_kode_surat');

    $row = $query->row_array();

    $next = isset($row['no_surat']) && $row['no_surat'] != null ? $row['no_surat'] + 1 : 1;

    $formatted = str_pad($next, 3, '0', STR_PAD_LEFT);

    echo json_encode([
      'nomor_surat' => $formatted
    ]);
  }


}
