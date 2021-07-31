<?php

class M_admin extends CI_Model
{

  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
  }

  public function cek_jumlah($tabel, $id_barang_masuk)
  {
    return  $this->db->select('*')
      ->from($tabel)
      ->where('id_barang_masuk', $id_barang_masuk)
      ->get();
  }

  public function get_data_array($tabel, $id_barang_masuk)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_barang_masuk)
      ->get();
    return $query->result_array();
  }

  public function get_data($tabel, $id_barang_masuk)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where($id_barang_masuk)
      ->get();
    return $query->result();
  }

  public function update($tabel, $data, $where)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function delete($tabel, $where)
  {
    $this->db->where($where);
    $this->db->delete($tabel);
  }

  public function mengurangi($tabel, $id_barang_masuk, $jumlah)
  {
    $this->db->set("jumlah", "jumlah - $jumlah");
    $this->db->where('id_barang_masuk', $id_barang_masuk);
    $this->db->update($tabel);
  }

  public function update_password($tabel, $where, $data)
  {
    $this->db->where($where);
    $this->db->update($tabel, $data);
  }

  public function get_data_gambar($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('username_user', $username)
      ->get();
    return $query->result();
  }

  public function sum($tabel, $field)
  {
    $query = $this->db->select_sum($field)
      ->from($tabel)
      ->get();
    return $query->result();
  }

  public function numrows($tabel)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->get();
    return $query->num_rows();
  }

  public function kecuali($tabel, $username)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where_not_in('username', $username)
      ->get();

    return $query->result();
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

  public function getAllSupplier()
  {
    $query = $this->db->query("select * from tb_supplier");
    return $query->result_array();
  }

  public function getAllBarang()
  {
    $query = $this->db->query("select * from tb_barang");
    return $query->result_array();
  }

  public function getAllKategori()
  {
    $query = $this->db->query("select * from tb_kategori");
    return $query->result_array();
  }

  public function getAllSatuan()
  {
    $query = $this->db->query("select * from tb_satuan");
    return $query->result_array();
  }

  public function selectSupplier()
  {
    $query = $this->db->get('tb_supplier');
    return $query->result_array();
  }

  public function selectBarang()
  {
    $query = $this->db->get('tb_barang');
    return $query->result_array();
  }

  public function selectKategori()
  {
    $query = $this->db->get('tb_kategori');
    return $query->result_array();
  }

  public function selectSatuan()
  {
    $query = $this->db->get('tb_satuan');
    return $query->result_array();
  }
}
