<?php
class M_nomor extends CI_Model
{

    private $_table = "tbl_kode_surat";

    function tampil_data()
    {
        return $this->db->get('tbl_kode_surat');
    }
    function detail_kegiatan($id_kode)
    {
        $this->db->where('id_kode',$id_kode);
        return $this->db->get('tbl_kode_surat');
    }


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function delete_data($id_kode)
    {
        $hsl = $this->db->query("DELETE FROM tbl_kode_surat WHERE id_kode='$id_kode'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    function jumlah_data()
    {
        $this->db->select('count(tbl_kode_surat.kode_pegawai) as jumlah');
        $hsl = $this->db->get('tbl_kode_surat');
        return $hsl;
    }
    function cek_kode_unor($kode_unor)
    {
        $this->db->select('*');
        $this->db->where('kode_unor',$kode_unor);
        $hsl = $this->db->get('tbl_kode_surat');
        return $hsl;
    }
    function get_kode($kode_surat)
    {
        $this->db->select('kode_surat');
        $this->db->where('kode_surat',$kode_surat);
        $hsl = $this->db->get('tbl_kode_surat');
        return $hsl;

    }
    function tampil_data_nama()
    {
        $this->db->select('kode_unor,nama_divisi');
        $hsl = $this->db->get('tbl_kode_surat');
        return $hsl;
    }
    public function get_last_number_by_month($month, $year)
    {
    // Ambil no_surat terakhir di bulan & tahun ini (apapun kodenya)
        $romawi = $this->to_romawi($month);
        $pattern = '/'.$romawi.$year;

        $this->db->like('no_surat', $pattern, 'both');
        $this->db->order_by('id_kode', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('tbl_kode_surat');
        if ($query->num_rows() > 0) {
            $parts = explode('/', $query->row()->no_surat);
            return (int)$parts[0];
        } else {
            return 0;
        }
    }

    public function to_romawi($month)
    {
        $romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        return $romawi[(int)$month - 1];
    }

}
