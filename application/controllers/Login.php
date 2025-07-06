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
		$data['title'] = 'SI MARKOT | PMI Kota Tangerang';
		$this->load->view('Login',$data);
	}

	function auth()
	{
		$username = strip_tags(str_replace("'", "", $this->input->post('username')));
		$password = strip_tags(str_replace("'", "", $this->input->post('password')));
		$u = $username;
		$p = $password;


		$cadmin = $this->m_login->cek_login($u, $p);
		json_encode($cadmin);

		if ($cadmin->num_rows() > 0) {

			$this->session->set_userdata('masuk', true);
			$this->session->set_userdata('user', $u);
			$data_ses = $cadmin->row_array();
			if ($data_ses['user_level'] == '3') {

				$this->session->set_userdata('akses', '3');

				$nama = $data_ses['nama'];
				$nip  = $data_ses['nip_pegawai'];
				$jabatan = $data_ses['jabatan'];
				$user_level = $data_ses['user_level'];
				$id_pegawai = $data_ses['id_pegawai'];
				$kode_unor  = $data_ses['kode_unor'];

				$this->session->set_userdata('nama', $nama);
				$this->session->set_userdata('nip_pegawai', $nip);
				$this->session->set_userdata('jabatan', $jabatan);
				$this->session->set_userdata('user_level', $user_level);
				$this->session->set_userdata('id_pegawai', $id_pegawai);
				$this->session->set_userdata('kode_unor', $kode_unor);

				redirect('Homepage');
			} elseif($data_ses['user_level'] == '2') {
				$this->session->set_userdata('akses', '2');

				$nama = $data_ses['nama'];
				$nip  = $data_ses['nip_pegawai'];
				$jabatan = $data_ses['jabatan'];
				$user_level = $data_ses['user_level'];
				$id_pegawai = $data_ses['id_pegawai'];
				$kode_unor  = $data_ses['kode_unor'];

				$this->session->set_userdata('nama', $nama);
				$this->session->set_userdata('nip_pegawai', $nip);
				$this->session->set_userdata('jabatan', $jabatan);
				$this->session->set_userdata('user_level', $user_level);
				$this->session->set_userdata('id_pegawai', $id_pegawai);
				$this->session->set_userdata('kode_unor', $kode_unor);

				redirect('Homepage');
			}else{
				$this->session->set_userdata('akses', '1');

				$nama = $data_ses['nama'];
				$nip  = $data_ses['nip_pegawai'];
				$jabatan = $data_ses['jabatan'];
				$user_level = $data_ses['user_level'];
				$id_pegawai = $data_ses['id_pegawai'];
				$kode_unor  = $data_ses['kode_unor'];

				$this->session->set_userdata('nama', $nama);
				$this->session->set_userdata('nip_pegawai', $nip);
				$this->session->set_userdata('jabatan', $jabatan);
				$this->session->set_userdata('user_level', $user_level);
				$this->session->set_userdata('id_pegawai', $id_pegawai);
				$this->session->set_userdata('kode_unor', $kode_unor);

				redirect('Homepage');
			}
		} else {

			$this->session->set_flashdata('msg', '<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert"><span class="fa fa-close"></span></button>Username Atau Password Salah</div>');
			redirect('login');
		}
	}

	public function logout()
	{

		$this->session->sess_destroy();
		redirect('login');
	}
}
