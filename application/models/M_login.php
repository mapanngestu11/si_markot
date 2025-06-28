<?php
class M_login extends CI_Model{


	function cekadmin($u,$p){

		$hasil=$this->db->query("SELECT * FROM tbl_user WHERE username='$u' AND password =md5('$p')");
		return $hasil;
	}

	function logout($last_login,$nama_lengkap){

		$hasil=$this->db->query("UPDATE `tbl_user` SET `last_login` = '$last_login' WHERE `tbl_user`.`nama_lengkap` LIKE '%$nama_lengkap%'");	
		return $hasil;
	} 

}
