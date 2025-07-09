<?php defined('BASEPATH') or exit('No direct script access allowed');

class User  extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('upload');
        $this->load->model('M_user');

        if($this->session->userdata('masuk') != TRUE){
            $this->session->set_flashdata('msg','<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Login Terlebih Dahulu .</div>');
            $url=base_url('Login');
            redirect($url);
        }
        
    }

    public function index()
    {

        $data['title'] = 'Data User | PMI Kota Tangerang';
        $data['users'] = $this->M_user->tampil_data();
        $this->load->view('user.php',$data);
    }

    public function create()
    {

     $config['upload_path'] = './assets/upload/'; 
     $config['allowed_types'] = 'jpg|png|jpeg';
     $config['encrypt_name'] = TRUE; 
     $config['max_size']  = 10000;

     $this->upload->initialize($config);
     if (!empty($_FILES['ttd']['name'])) {
        if ($this->upload->do_upload('ttd')) {
            $gbr = $this->upload->data();

            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/upload/' . $gbr['file_name'];
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = FALSE;
            $config['quality'] = '100%';
            $config['width'] = 500;
            $config['height'] = 450;
            $config['new_image'] = './assets/upload/' . $gbr['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();

            $gambar = $gbr['file_name'];
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nip_pegawai = $this->input->post('nip_pegawai');
            $jabatan = $this->input->post('jabatan');
            $user_level = $this->input->post('user_level');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));


            $data = array(

                'nama' => $nama,
                'email' => $email,
                'nip_pegawai' => $nip_pegawai,
                'jabatan' => $jabatan,
                'user_level' => $user_level,
                'username' => $username,
                'password' => $password,
                'ttd' => $gambar

            );

            $this->M_user->input_data($data, 'tbl_user');
            $this->session->set_flashdata('toast', json_encode([
                'icon' => 'success',  
                'title' => 'Data berhasil disimpan!'
            ]));
            redirect('user'); 
        } else {
         $this->session->set_flashdata('toast', json_encode([
            'icon' => 'warning',  
            'title' => 'Ukuran atau format file tidak sesuai !'
        ]));
         redirect('user'); 
     }
 } else {

     $this->session->set_flashdata('toast', json_encode([
        'icon' => 'danger',  
        'title' => 'Data Gagal Tersimpan!'
    ]));
     redirect('user'); 
 }
}


public function update()
{
    $this->load->library('upload');

    $id_user = $this->input->post('id_user');
    $nip_baru = $this->input->post('nip_pegawai');

    $user_lama = $this->db->get_where('tbl_user', ['id_user' => $id_user])->row_array();
    $nip_lama = $user_lama['nip_pegawai'];

    if ($nip_baru != $nip_lama) {
        $cek_nip = $this->db->where('nip_pegawai', $nip_baru)
        ->where('id_user !=', $id_user)
        ->get('tbl_user');

        if ($cek_nip->num_rows() > 0) {
            $this->session->set_flashdata('toast', json_encode([
                'icon' => 'warning',
                'title' => 'NIP sudah digunakan oleh pengguna lain!'
            ]));
            redirect('user');
            return;
        }
    }

    $data = [
        'nama'        => $this->input->post('nama'),
        'email'       => $this->input->post('email'),
        'nip_pegawai' => $nip_baru,
        'jabatan'     => $this->input->post('jabatan'),
        'user_level'  => $this->input->post('user_level'),
        'username'    => $this->input->post('username'),
        'password'    => md5($this->input->post('password')),
    ];

    if (!empty($_FILES['ttd']['name'])) {
        $config['upload_path']   = './assets/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name']  = TRUE;
        $config['max_size']      = 10000;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('ttd')) {
            $gbr = $this->upload->data();

            $this->load->library('image_lib');
            $config_resize['image_library']  = 'gd2';
            $config_resize['source_image']   = './assets/upload/' . $gbr['file_name'];
            $config_resize['maintain_ratio'] = FALSE;
            $config_resize['width']          = 500;
            $config_resize['height']         = 450;
            $config_resize['new_image']      = './assets/upload/' . $gbr['file_name'];

            $this->image_lib->initialize($config_resize);
            $this->image_lib->resize();

            $data['ttd'] = $gbr['file_name'];
        } else {
            $this->session->set_flashdata('toast', json_encode([
                'icon' => 'warning',
                'title' => 'Ukuran atau format file tidak sesuai!'
            ]));
            redirect('user');
            return;
        }
    }

    $this->M_user->update_data(['id_user' => $id_user], $data, 'tbl_user');

    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',
        'title' => 'Data berhasil disimpan!'
    ]));

    redirect('user');
}

public function delete($id_user)
{
    $id_user = $this->input->post('id_user');
    $this->M_user->delete_data($id_user);
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil dihapus!'
    ]));
    redirect('user');
}

public function reset_password()
{
    $nip_pegawai = $this->input->post('nip_pegawai');
    $password = md5($this->input->post('password'));

    $data = array(
        'password' => $password
    ); 

    $where = array(
        'nip_pegawai' => $nip_pegawai
    );

    $this->M_user->reset_password($where,$data,'tbl_user');
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil direset password!'
    ]));
    redirect('user');
}


}
