<?php
class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{
		$this->load->view('Login');
	}

	// function auth()
	// {
	// 	$username = strip_tags(str_replace("'", "", $this->input->post('username')));
	// 	$password = strip_tags(str_replace("'", "", $this->input->post('password')));
	// 	$u = $username;
	// 	$p = $password;
	// 	$cadmin = $this->m_login->cekadmin($u, $p);
	// 	json_encode($cadmin);
	// 	if ($cadmin->num_rows() > 0) {
	// 		// echo "berhasil";
	// 		// die();
	// 		$this->session->set_userdata('masuk', true);
	// 		$this->session->set_userdata('user', $u);
	// 		$xcadmin = $cadmin->row_array();
	// 		if ($xcadmin['hak_akses'] == '1') {
	// 			$this->session->set_userdata('akses', '1');
	// 			$id = $xcadmin['id'];
	// 			$nama_lengkap = $xcadmin['nama_lengkap'];
	// 			$hak_akses = $xcadmin['hak_akses'];
	// 			$this->session->set_userdata('id', $id);
	// 			$this->session->set_userdata('nama_lengkap', $nama_lengkap);
	// 			$this->session->set_userdata('hak_akses', $hak_akses);
	// 			redirect('belakang/Home');
	// 		} else {
	// 			$this->session->set_userdata('akses', '1');
	// 			$id = $xcadmin['id'];
	// 			$nama_lengkap = $xcadmin['nama_lengkap'];
	// 			$hak_akses = $xcadmin['hak_akses'];
	// 			$this->session->set_userdata('id', $id);
	// 			$this->session->set_userdata('nama_lengkap', $nama_lengkap);
	// 			$this->session->set_userdata('hak_akses', $hak_akses);
	// 			redirect('belakang/Home');
	// 		}
	// 	} else {

	// 		$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Username Atau Password Salah</div>');
	// 		redirect('login');
	// 	}
	// }

	public function logout()
	{
		// date_default_timezone_set("ASIA/JAKARTA");
		// $last_login = date('Y-m-d H:i:s');
		// $nama_lengkap = $this->session->userdata('nama_lengkap');

		// $this->m_login->logout($last_login, $nama_lengkap, 'tbl_user');

		$this->session->sess_destroy();
		redirect('login');
	}
}
