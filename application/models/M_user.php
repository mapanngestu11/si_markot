<?php
class M_user extends CI_Model
{

    private $_table = "tbl_user";

    function tampil_data()
    {
        return $this->db->get('tbl_user');
    }
    function detail_kegiatan($id_user)
    {
        $this->db->where('id_user',$id_user);
        return $this->db->get('tbl_user');
    }


    function input_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function delete_data($id_user)
    {
        $hsl = $this->db->query("DELETE FROM tbl_user WHERE id_user='$id_user'");
        return $hsl;
    }

    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
