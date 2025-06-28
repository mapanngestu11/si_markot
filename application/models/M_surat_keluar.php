<?php
class M_surat_keluar extends CI_Model
{

    private $_table = "tbl_surat_keluar";

    function tampil_data()
    {
        return $this->db->get('tbl_surat_keluar');
    }
    function detail_kegiatan($id_surat_keluar)
    {
        $this->db->where('id_surat_keluar',$id_surat_keluar);
        return $this->db->get('tbl_surat_keluar');
    }


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function delete_data($id_surat_keluar)
    {
        $hsl = $this->db->query("DELETE FROM tbl_surat_keluar WHERE id_surat_keluar='$id_surat_keluar'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function jumlah_data()
    {
        $this->db->select('count(tbl_surat_keluar.kode_pegawai) as jumlah');
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
}
