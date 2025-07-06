<?php
class M_login extends CI_Model{


	function cek_login($u,$p){

		$this->db->select('
			a.nama,
			a.nip_pegawai,
			a.jabatan,
			a.user_level,
			b.id_pegawai,
			b.kode_unor
			');
		$this->db->join('tbl_pegawai as b', 'a.nip_pegawai = b.nip_pegawai','left');
		$this->db->join('tbl_divisi as c' ,'b.kode_unor = c.kode_unor','left');
		$this->db->where('username',$u);
		$this->db->where('password',md5($p));
		$hasil = $this->db->get('tbl_user as a');
		return $hasil;

	}

	function logout($last_login,$nama_lengkap){

		$hasil=$this->db->query("UPDATE `tbl_user` SET `last_login` = '$last_login' WHERE `tbl_user`.`nama_lengkap` LIKE '%$nama_lengkap%'");	
		return $hasil;
	} 

}
