<?php
class M_surat_disposisi extends CI_Model
{

  private $_table = "tbl_disposisi";

  function tampil_data()
  { 

    $kode_unor =  $this->session->userdata('kode_unor');
    if ($kode_unor == 'admin' || $kode_unor == 'pimpinan') {
     $this->db->select('
      a.*,
      b.no_surat,
      b.file_surat_masuk,
      c.nama
      ');

     $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
     $this->db->join('tbl_pegawai as c','c.nip_pegawai = a.diteruskan','left');
     return $this->db->get('tbl_disposisi as a');
   }else{
     $this->db->select('
      a.*,
      b.no_surat,
      b.file_surat_masuk,
      c.nama,
      c.kode_unor
      ');

     $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
     $this->db->join('tbl_pegawai as c','c.nip_pegawai = a.diteruskan','left');
     $this->db->where('c.kode_unor',$kode_unor);
     return $this->db->get('tbl_disposisi as a');
   }

 }
 function detail_kegiatan($id_disposisi)
 {
  $this->db->where('id_disposisi',$id_disposisi);
  return $this->db->get('tbl_disposisi');
}


function input_data($data, $table)
{
  $this->db->insert($table, $data);
}

function delete_data($id_surat_masuk)
{
  $hsl = $this->db->query("DELETE FROM tbl_disposisi WHERE id_surat_masuk='$id_surat_masuk'");
  return $hsl;
}

function delete_data_disposisi($id_disposisi)
{
  $hsl = $this->db->query("DELETE FROM tbl_disposisi WHERE id_disposisi='$id_disposisi'");
  return $hsl;
}

function update_data($where, $data, $table)
{
  $this->db->where($where);
  $this->db->update($table, $data);
}
function jumlah_data()
{
  $this->db->select('count(tbl_disposisi.id_disposisi) as jumlah');
  $hsl = $this->db->get('tbl_disposisi');
  return $hsl;
}
function cek_kode_unor($kode_unor)
{
  $this->db->select('*');
  $this->db->where('kode_unor',$kode_unor);
  $hsl = $this->db->get('tbl_disposisi');
  return $hsl;
}
function tampil_data_nama()
{
  $this->db->select('kode_unor,nama_divisi');
  $hsl = $this->db->get('tbl_disposisi');
  return $hsl;
}
function get_no_agenda()
{
  $this->db->select('no_agenda');
  $this->db->order_by('no_agenda', 'DESC');
  $this->db->limit(1);
  $hsl = $this->db->get('tbl_disposisi');
  return $hsl;

}
function get_byId($id_surat_masuk)
{
  $this->db->select('
    a.*,
    b.no_surat,
    b.tgl_terima,
    b.no_agenda,
    b.perihal,
    b.sifat_surat,
    b.tgl_surat_masuk,
    b.asal_surat,
    b.file_surat_masuk,
    c.nama,
    d.nama_divisi
    ');

  $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
  $this->db->join('tbl_pegawai as c','c.nip_pegawai = a.diteruskan','left');
  $this->db->join('tbl_divisi as d','c.kode_unor = d.kode_unor','left');
  $this->db->where('b.id_surat_masuk',$id_surat_masuk);
  $this->db->limit(1);
  return $this->db->get('tbl_disposisi as a');
}
function get_byId_disposisi($id_disposisi)
{
  $this->db->select('
    a.*,
    b.no_surat,
    b.tgl_terima,
    b.no_agenda,
    b.perihal,
    b.sifat_surat,
    b.tgl_surat_masuk,
    b.asal_surat,
    b.file_surat_masuk,
    c.nama,
    d.nama_divisi,

    ');

  $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
  $this->db->join('tbl_pegawai as c','c.nip_pegawai = a.diteruskan','left');
  $this->db->join('tbl_divisi as d','c.kode_unor = d.kode_unor','left');
  $this->db->where('a.id_disposisi',$id_disposisi);
  $this->db->limit(1);
  return $this->db->get('tbl_disposisi as a');
}
function get_byId_cetak($id_surat_masuk,$nama)
{
  $this->db->select('
    a.*,
    b.no_surat,
    b.tgl_terima,
    b.no_agenda,
    b.perihal,
    b.sifat_surat,
    b.tgl_surat_masuk,
    b.asal_surat,
    b.file_surat_masuk,
    c.nama,
    d.nama_divisi,
    e.ttd,
    c2.nama AS pimpinan,
    f.ttd AS ttd_pimpinan
    ');

  $this->db->from('tbl_disposisi as a');
  $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
  $this->db->join('tbl_pegawai as c', 'c.nip_pegawai = a.diteruskan','left'); 
  $this->db->join('tbl_divisi as d', 'c.kode_unor = d.kode_unor','left');
  $this->db->join('tbl_user as e', 'e.nip_pegawai = c.nip_pegawai','left'); 

  $this->db->join('tbl_pegawai as c2', 'c2.nip_pegawai = a.nip_pegawai','left'); 
  $this->db->join('tbl_user as f', 'f.nip_pegawai = c2.nip_pegawai','left'); 

  $this->db->where('b.id_surat_masuk', $id_surat_masuk);
  $this->db->where('c.nama', $nama);

  return $this->db->get();

}
function cek_laporan($tgl_awal,$tgl_akhir)
{
  $this->db->select('
    a.*,
    b.no_surat,
    b.tgl_terima,
    b.no_agenda,
    b.perihal,
    b.sifat_surat,
    b.tgl_surat_masuk,
    b.asal_surat,
    b.file_surat_masuk,
    c.nama,
    d.nama_divisi
    ');

  $this->db->join('tbl_surat_masuk as b', 'b.id_surat_masuk = a.id_surat_masuk','left');
  $this->db->join('tbl_pegawai as c','c.nip_pegawai = a.diteruskan','left');
  $this->db->join('tbl_divisi as d','c.kode_unor = d.kode_unor','left');
  $this->db->where('a.tgl_agenda >=', $tgl_awal);
  $this->db->where('a.tgl_agenda <=', $tgl_akhir);
  return $this->db->get('tbl_disposisi as a');
}
}
