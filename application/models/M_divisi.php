<?php
class M_divisi extends CI_Model
{

    private $_table = "tbl_divisi";

    function tampil_data()
    {
        return $this->db->get('tbl_divisi');
    }
    function detail_kegiatan($id_divisi)
    {
        $this->db->where('id_divisi',$id_divisi);
        return $this->db->get('tbl_divisi');
    }


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function delete_data($id_divisi)
    {
        $hsl = $this->db->query("DELETE FROM tbl_divisi WHERE id_divisi='$id_divisi'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function jumlah_data()
    {
        $this->db->select('count(tbl_divisi.kode_pegawai) as jumlah');
        $hsl = $this->db->get('tbl_divisi');
        return $hsl;
    }
    function cek_kode_unor($kode_unor)
    {
        $this->db->select('*');
        $this->db->where('kode_unor',$kode_unor);
        $hsl = $this->db->get('tbl_divisi');
        return $hsl;
    }
    function tampil_data_nama()
    {
        $this->db->select('kode_unor,nama_divisi');
        $hsl = $this->db->get('tbl_divisi');
        return $hsl;
    }
}
