<?php
class M_user extends CI_Model{

  public function update_password($tabel,$where,$data)
  {
    $this->db->where($where);
    $this->db->update($tabel,$data);
  }

  public function select($tabel)
  {
    return $this->db->select()
                    ->from($tabel)
                    ->get()->result();
  }
  
  public function getAllBarangMasuk()
  {
    //atau bisa juga menggunakan code berikut
    $this->db->select('*');
    $this->db->from('tb_barang_masuk bm');
    $this->db->join('tb_supplier s', 's.id_supplier = bm.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bm.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bm.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bm.id_satuan');

    $query = $this->db->get();
    return $query->result_array();
  }
}
