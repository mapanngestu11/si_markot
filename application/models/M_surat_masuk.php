<?php
class M_surat_masuk extends CI_Model
{

    private $_table = "tbl_surat_masuk";

    function tampil_data()
    {
        return $this->db->get('tbl_surat_masuk');
    }
    function detail_kegiatan($id_surat_masuk)
    {
        $this->db->where('id_surat_masuk',$id_surat_masuk);
        return $this->db->get('tbl_surat_masuk');
    }


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function delete_data($id_surat_masuk)
    {
        $hsl = $this->db->query("DELETE FROM tbl_surat_masuk WHERE id_surat_masuk='$id_surat_masuk'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function jumlah_data()
    {
        $this->db->select('count(tbl_surat_masuk.kode_pegawai) as jumlah');
        $hsl = $this->db->get('tbl_surat_masuk');
        return $hsl;
    }
    function cek_kode_unor($kode_unor)
    {
        $this->db->select('*');
        $this->db->where('kode_unor',$kode_unor);
        $hsl = $this->db->get('tbl_surat_masuk');
        return $hsl;
    }
    function tampil_data_nama()
    {
        $this->db->select('kode_unor,nama_divisi');
        $hsl = $this->db->get('tbl_surat_masuk');
        return $hsl;
    }
    function get_no_agenda()
    {
        $this->db->select('no_agenda');
        $this->db->order_by('no_agenda', 'DESC');
        $this->db->limit(1);
        $hsl = $this->db->get('tbl_surat_masuk');
        return $hsl;

    }
}
