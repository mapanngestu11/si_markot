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
            $nip = $this->input->post('nip');
            $jabatan = $this->input->post('jabatan');
            $user_level = $this->input->post('user_level');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));


            $data = array(

                'nama' => $nama,
                'email' => $email,
                'nip' => $nip,
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
        $nip = $this->input->post('nip');
        $jabatan = $this->input->post('jabatan');
        $user_level = $this->input->post('user_level');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $id_user = $this->input->post('id_user');

        $data = array(

            'nama' => $nama,
            'email' => $email,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'user_level' => $user_level,
            'username' => $username,
            'password' => $password,
            'ttd' => $gambar

        );

        $where = array(
            'id_user' => $id_user
        );

        $this->M_user->update_data($where, $data, 'tbl_user');
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


}else{
    $nama = $this->input->post('nama');
    $email = $this->input->post('email');
    $nip = $this->input->post('nip');
    $jabatan = $this->input->post('jabatan');
    $user_level = $this->input->post('user_level');
    $username = $this->input->post('username');
    $password = md5($this->input->post('password'));
    $id_user = $this->input->post('id_user');

    $data = array(

        'nama' => $nama,
        'email' => $email,
        'nip' => $nip,
        'jabatan' => $jabatan,
        'user_level' => $user_level,
        'username' => $username,
        'password' => $password

    );

    $where = array(
        'id_user' => $id_user
    );

    $this->M_user->update_data($where, $data, 'tbl_user');
    $this->session->set_flashdata('toast', json_encode([
        'icon' => 'success',  
        'title' => 'Data berhasil disimpan!'
    ]));
    redirect('user'); 
}
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


}
