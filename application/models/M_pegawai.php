<?php
class M_pegawai extends CI_Model
{

  private $_table = "tbl_pegawai";
  public function __construct()
  {
    parent::__construct();
    $this->load->database(); 
  }

  function tampil_data()
  {
   $this->db->select('
     a.*,
     b.nama_divisi');
   $this->db->from('tbl_pegawai as a');
   $this->db->join('tbl_divisi as b', 'b.kode_unor = a.kode_unor','left');
   $query = $this->db->get();
   return $query;
 }
 function detail_kegiatan($id_pegawai)
 {
  $this->db->where('id_pegawai',$id_pegawai);
  return $this->db->get('tbl_pegawai');
}


function input_data($data, $table)
{
  $this->db->insert($table, $data);
}

function delete_data($id_pegawai)
{
  $hsl = $this->db->query("DELETE FROM tbl_pegawai WHERE id_pegawai='$id_pegawai'");
  return $hsl;
}

function update_data($where, $data, $table)
{
  $this->db->where($where);
  $this->db->update($table, $data);
}
function cek_kode_nip($nip)
{
  $this->db->select('*');
  $this->db->where('nip',$nip);
  $hsl = $this->db->get('tbl_pegawai');
  return $hsl;
}
}
