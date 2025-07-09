<?php
class M_surat_keluar extends CI_Model
{

  private $_table = "tbl_surat_keluar";

  function tampil_data()
  {
    $kode_unor =  $this->session->userdata('kode_unor');
    if ($kode_unor == 'admin' || $kode_unor == 'pimpinan') {
     
      $this->db->select('
        a.*,
        b.nama,
        b.jabatan,
        c.kode_unor,
        c.nama_divisi,
        d.no_surat,
        d.kode_surat
        ');
      $this->db->join('tbl_pegawai as b', 'a.nip_pegawai = b.nip_pegawai','left');
      $this->db->join('tbl_divisi as c', 'b.kode_unor = c.kode_unor','left');
      $this->db->join('tbl_kode_surat as d','a.id_kode = d.id_kode','left');
      return $this->db->get('tbl_surat_keluar as a');
    }else{
     $this->db->select('
      a.*,
      b.nama,
      b.jabatan,
      c.kode_unor,
      c.nama_divisi,
      d.no_surat,
      d.kode_surat
      ');
     $this->db->join('tbl_pegawai as b', 'a.nip_pegawai = b.nip_pegawai','left');
     $this->db->join('tbl_divisi as c', 'b.kode_unor = c.kode_unor','left');
     $this->db->join('tbl_kode_surat as d','a.id_kode = d.id_kode','left');
     // $this->db->where('c.kode_unor',$kode_unor);
     return $this->db->get('tbl_surat_keluar as a');
   }
 }

 function input_data($data, $table)
 {
  $this->db->insert($table, $data);
}

function delete_data($tgl_surat_keluar,$id_kode)
{

  $hsl = $this->db->query("DELETE FROM tbl_surat_keluar WHERE tgl_surat_keluar='$tgl_surat_keluar' AND id_kode = '$id_kode'");
  return $hsl;
}

function update_data($where, $data, $table)
{
  $this->db->where($where);
  $this->db->update($table, $data);
}

function jumlah_data()
{
  $this->db->select('count(tbl_surat_keluar.id_surat_keluar) as jumlah');
  $hsl = $this->db->get('tbl_surat_keluar');
  return $hsl;
}
function cek_kode_unor($kode_unor)
{
  $this->db->select('*');
  $this->db->where('kode_unor',$kode_unor);
  $hsl = $this->db->get('tbl_surat_keluar');
  return $hsl;
}
function tampil_data_nama()
{
  $this->db->select('kode_unor,nama_divisi');
  $hsl = $this->db->get('tbl_surat_keluar');
  return $hsl;
}
function get_no_agenda()
{
  $this->db->select('no_agenda');
  $this->db->order_by('no_agenda', 'DESC');
  $this->db->limit(1);
  $hsl = $this->db->get('tbl_surat_keluar');
  return $hsl;
}
function get_byId($id_surat_keluar)
{
 $this->db->select('*');
 $this->db->where('id_surat_keluar',$id_surat_keluar);
 $hsl = $this->db->get('tbl_surat_keluar');
 return $hsl;
}
public function get_nip_by_no_surat($tgl_surat_keluar,$id_kode)
{
  $this->db->select('nip_pegawai');
  $this->db->where('tgl_surat_keluar', $tgl_surat_keluar);
  $this->db->where('id_kode', $id_kode);
  $query = $this->db->get('tbl_surat_keluar');
  $result = $query->result_array();
  return array_column($result, 'nip_pegawai');
}
public function update_data_by_nip($tgl_surat_keluar,$nip, $data)
{
  $this->db->where('nip_pegawai', $nip);
  $this->db->where('tgl_surat_keluar', $tgl_surat_keluar);
  $this->db->update('tbl_surat_keluar', $data);
}
public function hapus_nip_by_no_surat($tgl_surat_keluar,$nip,$data)
{
  $this->db->where('nip_pegawai', $nip);
  $this->db->where('tgl_surat_keluar', $tgl_surat_keluar);
  $this->db->delete('tbl_surat_keluar');
}

}
