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

  public function get_data_gambar($tabel, $id_user)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where('id_user', $id_user)
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

  public function kecuali($tabel, $id_user)
  {
    $query = $this->db->select()
      ->from($tabel)
      ->where_not_in('id_user', $id_user)
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

  public function getBarangMasukByID($id_barang_masuk)
  {
    return $this->db->get_where('tb_barang_masuk', ['id_barang_masuk' => $id_barang_masuk])->row_array();
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

  // Barang Keluar
  public function getAllBarangKeluar()
  {
    //atau bisa juga menggunakan code berikut
    $this->db->select('*');
    $this->db->from('tb_barang_keluar bk');
    $this->db->join('tb_supplier s', 's.id_supplier = bk.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bk.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bk.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bk.id_satuan');

    $query = $this->db->get();
    return $query->result_array();
  }

  function cek_id_user()
  {
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->order_by('id_user', 'DESC');
    $this->db->from('tb_user');
    return $this->db->get()->row();
  }

  public function getUserByUsername($username)
  {
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->where('username', $username);
    return  $this->db->get()->result();
  }

  public function getUserByEmail($email)
  {
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->where('email', $email);
    return  $this->db->get()->result();
  }

  //
  public function getBarangMasuk($limit = null, $id_barang = null, $range = null)
  {
    $this->db->select('*');
    $this->db->join('tb_supplier s', 's.id_supplier = bm.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bm.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bm.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bm.id_satuan');

    if ($limit != null) {
      $this->db->limit($limit);
    }

    if ($id_barang != null) {
      $this->db->where('id_barang_masuk', $id_barang);
    }

    if ($range != null) {
      $this->db->where('tanggal' . ' >=', $range['mulai']);
      $this->db->where('tanggal' . ' <=', $range['akhir']);
    }

    $this->db->order_by('id_barang_masuk', 'DESC');
    return $this->db->get('tb_barang_masuk bm')->result_array();
  }

  public function getBarangKeluar($limit = null, $id_barang = null, $range = null)
  {
    $this->db->select('*');
    $this->db->join('tb_supplier s', 's.id_supplier = bk.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bk.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bk.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bk.id_satuan');

    if ($limit != null) {
      $this->db->limit($limit);
    }
    if ($id_barang != null) {
      $this->db->where('id_barang_keluar', $id_barang);
    }
    if ($range != null) {
      $this->db->where('tanggal_keluar' . ' >=', $range['mulai']);
      $this->db->where('tanggal_keluar' . ' <=', $range['akhir']);
    }
    $this->db->order_by('id_barang_keluar', 'DESC');
    return $this->db->get('tb_barang_keluar bk')->result_array();
  }

  public function laporan($table, $mulai, $akhir)
  {
    $tgl = $table == 'tb_barang_masuk' ? 'tanggal' : 'tanggal_keluar';
    $this->db->where($tgl . ' >=', $mulai);
    $this->db->where($tgl . ' <=', $akhir);
    return $this->db->get($table)->result_array();
  }
}
