<?php defined('BASEPATH') or exit('No direct script access allowed');

class Surat  extends CI_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('tanggal');
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

  public function create_surat_masuk()
  {
    $data['title'] = "Buat Surat Masuk | PMI Kota Tangerang";
    $data['ns'] = $this->M_nomor->tampil_data();
    $cek_no_agenda = $this->M_surat_masuk->get_no_agenda();
    $cek_data = $cek_no_agenda->result_array();

    if (!empty($cek_data) && !empty($cek_data[0]['no_agenda'])) {
      $last_nomor = (int)$cek_data[0]['no_agenda']; 
      $new_nomor = $last_nomor + 1;
    } else {
      $new_nomor = 1;
    }

    $data['pegawai'] = $this->M_pegawai->tampil_data_pimpinan();
    $data['no_agenda'] = str_pad($new_nomor, 1, '0', STR_PAD_LEFT); 
    $this->load->view('create.surat.masuk.php',$data);
  }

  public function masuk()
  {

    $data['title'] = "Data Surat Masuk | PMI Kota Tangerang";
    $data['masuk'] = $this->M_surat_masuk->tampil_data();

    // echo "<pre>";
    // print_r($data['masuk']->result_array());
    // echo "</pre>";
    // die();
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
    $data['pegawai'] = $this->M_pegawai->tampil_data_pimpinan();
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
    $this->M_surat_disposisi->delete_data($id_surat_masuk);
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
  public function update_surat_disposisi($id_surat_masuk)
  {

    $data['title'] = "Data Surat Disposisi | PMI Kota Tangerang";
    $data['masuk'] = $this->M_surat_masuk->tampil_data();
    $data['pegawai'] = $this->M_pegawai->tampil_data_divisi();
    $data['dp'] = $this->M_surat_masuk->cek_surat($id_surat_masuk);
    $data['dpid'] = $this->M_surat_disposisi->get_byId($id_surat_masuk);

    $this->load->view('update.surat.disposisi.php',$data); 

  }

  public function view_surat_disposisi ($id_surat_masuk)
  {
    $data['title'] = "Data Surat Disposisi | PMI Kota Tangerang";
    $data['masuk'] = $this->M_surat_masuk->tampil_data();
    $data['pegawai'] = $this->M_pegawai->tampil_data_divisi();
    $data['dp'] = $this->M_surat_masuk->cek_surat($id_surat_masuk);
    $data['dpid'] = $this->M_surat_disposisi->get_byId($id_surat_masuk);

    $this->load->view('view.surat.disposisi.php',$data); 
  }

  public function proses_delete_disposisi()
  {
    $id_disposisi = $this->input->post('id_disposisi');
    $this->M_surat_disposisi->delete_data_disposisi($id_disposisi);
    $this->session->set_flashdata('toast', json_encode([
      'icon' => 'success',  
      'title' => 'Data berhasil dihapus!'
    ]));
    redirect('Surat/disposisi');
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

    $data['pegawai'] = $this->M_pegawai->tampil_data_pimpinan();
    $data['kode_surat'] = $this->M_nomor->tampil_data();

    $this->load->view('create.surat.keluar.php',$data); 
  }
  public function proses_add_surat_keluar()
  {

    $config['upload_path'] = './assets/upload/'; 
    $config['allowed_types'] = 'pdf|PDF';
    $config['encrypt_name'] = TRUE; 
    $config['max_size']  = 10000;

    $this->upload->initialize($config);
    if (!empty($_FILES['lampiran']['name'])) {
      if ($this->upload->do_upload('lampiran')) {
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
        $tgl_surat_keluar      = $this->input->post('tgl_surat_keluar');
        $no_surat       = $this->input->post('no_surat');
        $id_kode        = $this->input->post('id_kode');
        $bulan          = $this->input->post('bulan');
        $tahun         = $this->input->post('tahun');
        $perihal  = $this->input->post('perihal');
        $kepada   = $this->input->post('kepada');
        $isi_surat       = $this->input->post('isi_surat');
        $nip_pegawai      = $this->input->post('nip_pegawai'); 
        $status           = 'Pending';

        if (!empty($nip_pegawai)) {
          foreach ($nip_pegawai as $nip) {
            $data = [
              'tgl_surat_keluar'      => $tgl_surat_keluar,
              'id_kode'       => $id_kode,
              'bulan'        => $bulan,
              'tahun'          => $tahun,
              'lampiran'         => $file,
              'perihal'  => $perihal,
              'kepada'  => $kepada,
              'isi_surat'       => $isi_surat,
              'status' => $status,
              'nip_pegawai'      => $nip
            ];

            $this->M_surat_keluar->input_data($data, 'tbl_surat_keluar');
          }

          $data = array(

            'no_surat' => $no_surat,

          );

          $where = array(
            'id_kode' => $id_kode
          );

          $this->M_nomor->update_data($where,$data,'tbl_kode_surat');
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
    redirect('Surat/keluar');

  }

  public function update_surat_keluar($id_surat_keluar)
  {
    $data['title'] = "Data Surat Keluar | PMI Kota Tangerang";
    $data['pegawai'] = $this->M_pegawai->tampil_data_pimpinan();
    $data['sk'] = $this->M_surat_keluar->get_byId($id_surat_keluar);
    $id_kode = $data['sk']->result_array()[0]['id_kode'];
    $data['skid'] = $this->M_nomor->tampil_databyId($id_kode);
    $data['kode_surat'] = $this->M_nomor->tampil_data();
    $this->load->view('update.surat.keluar.php',$data); 

  }
  public function proses_update_surat_keluar()
  {
    $this->load->library('upload');

    $config = [
      'upload_path'   => './assets/upload/',
      'allowed_types' => 'pdf|PDF',
      'encrypt_name'  => TRUE,
      'max_size'      => 10000
    ];
    $this->upload->initialize($config);

    $file = null;
    if (!empty($_FILES['lampiran']['name'])) {
      if ($this->upload->do_upload('lampiran')) {
        $upload_data = $this->upload->data();
        $file = $upload_data['file_name'];
      } else {
        $this->session->set_flashdata('toast', json_encode([
          'icon'  => 'warning',
          'title' => 'Ukuran atau format file tidak sesuai!'
        ]));
        return redirect('Surat/keluar');
      }
    }

    $tgl_surat_keluar = $this->input->post('tgl_surat_keluar');
    $no_surat         = $this->input->post('no_surat');
    $id_kode          = $this->input->post('id_kode');
    $bulan            = $this->input->post('bulan');
    $tahun            = $this->input->post('tahun');
    $perihal          = $this->input->post('perihal');
    $kepada           = $this->input->post('kepada');
    $isi_surat        = $this->input->post('isi_surat');
    $nip_pegawai      = $this->input->post('nip_pegawai');
    $hak_akses        = $this->session->userdata('user_level');

    $status = ($hak_akses == '1') ? $this->input->post('status') : 'Pending';

    if (!empty($nip_pegawai)) {
      if (!is_array($nip_pegawai)) {
        $nip_pegawai = [$nip_pegawai];
      }

      $nip_lama = $this->M_surat_keluar->get_nip_by_no_surat($tgl_surat_keluar, $id_kode, $nip_pegawai);
      if (!is_array($nip_lama)) {
        $nip_lama = [];
      }

      $hapus  = array_diff($nip_lama, $nip_pegawai);
      $tambah = array_diff($nip_pegawai, $nip_lama);
      $tetap  = array_intersect($nip_pegawai, $nip_lama);

      foreach ($hapus as $nip) {
        $this->M_surat_keluar->hapus_nip_by_no_surat($tgl_surat_keluar, $nip);
      }

      foreach ($tambah as $nip) {
        $data = [
          'tgl_surat_keluar' => $tgl_surat_keluar,
          'id_kode'          => $id_kode,
          'bulan'            => $bulan,
          'tahun'            => $tahun,
          'perihal'          => $perihal,
          'kepada'           => $kepada,
          'isi_surat'        => $isi_surat,
          'status'           => $status,
          'nip_pegawai'      => $nip
        ];

        if ($file !== null) {
          $data['lampiran'] = $file;
        }

        $this->M_surat_keluar->input_data($data, 'tbl_surat_keluar');
      }

      foreach ($tetap as $nip) {
        $data = [
          'tgl_surat_keluar' => $tgl_surat_keluar,
          'id_kode'          => $id_kode,
          'bulan'            => $bulan,
          'tahun'            => $tahun,
          'perihal'          => $perihal,
          'kepada'           => $kepada,
          'isi_surat'        => $isi_surat,
          'status'           => $status
        ];

        if ($file !== null) {
          $data['lampiran'] = $file;
        }

        $this->M_surat_keluar->update_data_by_nip($tgl_surat_keluar, $nip, $data);
      }

      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'success',
        'title' => 'Data berhasil disimpan!'
      ]));
    } else {
      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'error',
        'title' => 'NIP pegawai tidak boleh kosong!'
      ]));
    }

    redirect('Surat/keluar');
  }

  public function proses_delete_surat_keluar()
  {
    $id_kode = $this->input->post('id_kode');
    $tgl_surat_keluar = $this->input->post('tgl_surat_keluar');
    $this->M_surat_keluar->delete_data($tgl_surat_keluar,$id_kode);
    $this->session->set_flashdata('toast', json_encode([
      'icon' => 'success',  
      'title' => 'Data berhasil dihapus!'
    ]));
    redirect('Surat/keluar');
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
    $kode = $this->input->post('id_kode');

    $this->db->select_max('no_surat'); 
    $this->db->where('id_kode', $kode);
    $query = $this->db->get('tbl_kode_surat');

    $row = $query->row_array();

    $next = isset($row['no_surat']) && $row['no_surat'] != null ? $row['no_surat'] + 1 : 1;

    $formatted = str_pad($next, 1, '0', STR_PAD_LEFT);

    echo json_encode([
      'nomor_surat' => $formatted
    ]);
  }
  public function view_disposisi($id_surat_masuk)
  {
    $data['title'] = "Buat Surat Disposisi | PMI Kota Tangerang";
    $data['dp'] = $this->M_surat_masuk->cek_surat($id_surat_masuk);
    $data['pegawai'] = $this->M_pegawai->tampil_data_divisi();
    $this->load->view('create.surat.disposisi.php',$data);
  }
  public function proses_add_disposisi()
  {

    $id_surat_masuk      = $this->input->post('id_surat_masuk');
    $tgl_agenda       = $this->input->post('tgl_agenda');
    $informasi        = $this->input->post('informasi');
    $nip_pegawai          = $this->input->post('nip_pegawai');
    $diteruskan      = $this->input->post('diteruskan'); 
    $status         = 'Pending';

    if (!empty($diteruskan)) {
      foreach ($diteruskan as $nip) {
        $data = [
          'id_surat_masuk'      => $id_surat_masuk,
          'tgl_agenda'       => $tgl_agenda,
          'informasi'      => $informasi,
          'status' => $status,
          'nip_pegawai'      => $nip_pegawai,
          'diteruskan'      => $nip
        ];
        
        $this->M_surat_disposisi->input_data($data, 'tbl_disposisi');
      }

      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'success',
        'title' => 'Data berhasil disimpan untuk semua pegawai!'
      ]));
    }
    redirect('Surat/disposisi'); 
  }
  public function proses_update_surat_disposisi()
  {
    $id_surat_masuk = $this->input->post('id_surat_masuk');
    $tgl_agenda     = $this->input->post('tgl_agenda');
    $informasi      = $this->input->post('informasi');
    $nip_pegawai    = $this->input->post('nip_pegawai');
    $diteruskan     = $this->input->post('diteruskan');

    $hak_akses = $this->session->userdata('user_level');
    $status = ($hak_akses == '1') ? $this->input->post('status') : 'Pending';

    if (!empty($diteruskan)) {
      foreach ($diteruskan as $nip) {
        $data = [
          'tgl_agenda'    => $tgl_agenda,
          'informasi'     => $informasi,
          'status'        => $status,
          'nip_pegawai'   => $nip_pegawai,
          'diteruskan'    => $nip
        ];

        $where = [
          'id_surat_masuk' => $id_surat_masuk,
          'diteruskan'     => $nip
        ];

        $this->M_surat_disposisi->update_data($where, $data, 'tbl_disposisi');
      }

      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'success',
        'title' => 'Data berhasil diperbarui untuk semua pegawai!'
      ]));
    } else {
      $this->session->set_flashdata('toast', json_encode([
        'icon'  => 'warning',
        'title' => 'Tidak ada data diteruskan!'
      ]));
    }

    redirect('Surat/disposisi');

  }

  public function proses_cetak_disposisi($id_disposisi)
  {

    $cek = $this->M_surat_disposisi->get_byId_disposisi($id_disposisi);

    $id_surat_masuk = $cek->result_array()[0]['id_surat_masuk'];
    $nama = $cek->result_array()[0]['nama'];
    
    $data['cetak'] = $this->M_surat_disposisi->get_byId_cetak($id_surat_masuk,$nama);
  // echo "<pre>";
  // print_r($data['cetak']->result_array());
  // echo "</pre>";
  // die();
    $this->load->view('cetak.disposisi.php',$data);

  }
  public function proses_cetak_surat_keluar($id_surat_keluar)
  {
    $data['pegawai'] = $this->M_pegawai->tampil_data_pimpinan();
    $data['sk'] = $this->M_surat_keluar->get_byId($id_surat_keluar);
    $id_kode = $data['sk']->result_array()[0]['id_kode'];
    $data['skid'] = $this->M_nomor->tampil_databyId($id_kode);
    $data['kode_surat'] = $this->M_nomor->tampil_data();
    $data['keluar'] = $this->M_surat_keluar->tampil_data();

  // echo "<pre>";
  // print_r($data['pegawai']->result_array());
  // echo "</pre>";
  // die();
    $this->load->view('cetak.surat.keluar.php',$data);
  }

}
