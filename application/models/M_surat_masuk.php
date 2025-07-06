<?php
class M_surat_masuk extends CI_Model
{

    private $_table = "tbl_surat_masuk";

    function tampil_data()
    {
        $kode_unor =  $this->session->userdata('kode_unor');
        if ($kode_unor == 'admin' || $kode_unor == 'pimpinan') {
            $this->db->select('
                a.*,
                b.nama,
                b.jabatan,
                c.kode_unor,
                c.nama_divisi
                ');
            $this->db->join('tbl_pegawai as b', 'a.nip_pegawai = b.nip_pegawai','left');
            $this->db->join('tbl_divisi as c', 'b.kode_unor = c.kode_unor','left');
            return $this->db->get('tbl_surat_masuk as a');
        }else{

            $this->db->select('
                a.*,
                b.nama,
                b.jabatan,
                c.kode_unor,
                c.nama_divisi
                ');
            $this->db->join('tbl_pegawai as b', 'a.nip_pegawai = b.nip_pegawai','left');
            $this->db->join('tbl_divisi as c', 'b.kode_unor = c.kode_unor','left');
            $this->db->join('tbl_disposisi as d', 'a.id_surat_masuk = d.id_surat_masuk','left');
            $this->db->where('c.kode_unor',$kode_unor);
            return $this->db->get('tbl_surat_masuk as a');
        }

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

    function delete_data($no_surat)
    {
        $hsl = $this->db->query("DELETE FROM tbl_surat_masuk WHERE no_surat='$no_surat'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function jumlah_data()
    {
        $this->db->select('count(tbl_surat_masuk.id_surat_masuk) as jumlah');
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
    function get_byId($id_surat_masuk)
    {

        $this->db->select('*');
        $this->db->where('id_surat_masuk',$id_surat_masuk);
        $hsl = $this->db->get('tbl_surat_masuk');
        return $hsl;
    }
    function get_byNosurat($no_surat)
    {

        $this->db->select('*');
        $this->db->where('no_surat',$no_surat);
        $this->db->limit(1);
        $hsl = $this->db->get('tbl_surat_masuk');

        return $hsl;
    }
    public function cek_nip_update($nips)
    {
        $this->db->where_in('nip_pegawai', $nips);
        $query = $this->db->get('tbl_surat_masuk');
        return $query->result();
    }
    public function get_nip_by_no_surat($no_surat)
    {
        $this->db->select('nip_pegawai');
        $this->db->where('no_surat', $no_surat);
        $query = $this->db->get('tbl_surat_masuk');
        $result = $query->result_array();
        return array_column($result, 'nip_pegawai');
    }

    public function hapus_nip_by_no_surat($no_surat, $nip)
    {
        $this->db->where('no_surat', $no_surat);
        $this->db->where('nip_pegawai', $nip);
        $this->db->delete('tbl_surat_masuk');
    }

    public function update_data_by_nip($no_surat, $nip, $data)
    {
        $this->db->where('no_surat', $no_surat);
        $this->db->where('nip_pegawai', $nip);
        $this->db->update('tbl_surat_masuk', $data);
    }
    public function cek_surat($id_surat_masuk)
    {
       $this->db->select('*');
       $this->db->where('id_surat_masuk',$id_surat_masuk);
       $hsl = $this->db->get('tbl_surat_masuk');
       return $hsl;
   }

   public function cek_laporan($tgl_awal,$tgl_akhir)
   {
       $this->db->where('tgl_terima >=', $tgl_awal);
       $this->db->where('tgl_terima <=', $tgl_akhir);
       $this->db->order_by('id_surat_masuk', 'ASC');
       $hsl = $this->db->get('tbl_surat_masuk');
       return $hsl;
   }

}
