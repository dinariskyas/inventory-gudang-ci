<?php

class M_admin extends CI_Model
{
  // barang masuk
  var $column_order = array('id_barang_masuk', 'nama_supplier', 'nama_barang', 'nama_kategori', 'nama_satuan', 'tanggal', 'jumlah'); //set column field database for datatable orderable
  var $column_search = array('nama_supplier', 'nama_barang', 'nama_kategori', 'nama_satuan', 'tanggal', 'jumlah'); //set column field database for datatable searchable
  var $order = array('id_barang_masuk' => 'asc'); // default order 

  private function _get_datatables_query()
  {
    $this->db->select('*');
    $this->db->from('tb_barang_masuk bm');
    $this->db->join('tb_supplier s', 's.id_supplier = bm.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bm.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bm.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bm.id_satuan');
    $this->db->where('bm.jumlah>', 0);

    //add custom filter here
    if ($this->input->post('tanggal')) {
      $this->db->like('tanggal', $this->input->post('tanggal'));
    }
    if ($this->input->post('nama_supplier')) {
      $this->db->like('nama_supplier', $this->input->post('nama_supplier'));
    }

    $i = 0;
    foreach ($this->column_search as $item) { // loop column 
      if (@$_POST['search']['value']) { // if datatable send POST for search
        if ($i === 0) { // first loop
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if (count($this->column_search) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) { // here order processing
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order)) {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }
  function get_datatables()
  {
    $this->_get_datatables_query();
    if (@$_POST['length'] != -1)
      $this->db->limit(@$_POST['length'], @$_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
  function count_filtered()
  {
    $this->_get_datatables_query();
    $query = $this->db->get();
    return $query->num_rows();
  }
  function count_all()
  {
    $this->db->from('tb_barang_masuk');
    return $this->db->count_all_results();
  }
  // end datatables barang masuk


  // barang keluar
  var $column_order2 = array('id_barang_masuk', 'nama_supplier', 'nama_barang', 'nama_kategori', 'nama_satuan', 'tanggal_masuk', 'tanggal_keluar', 'jumlah'); //set column field database for datatable orderable
  var $column_search2 = array('nama_supplier', 'nama_barang', 'nama_kategori', 'nama_satuan', 'tanggal_masuk', 'tanggal_keluar', 'jumlah'); //set column field database for datatable searchable
  var $order2 = array('id_barang_keluar' => 'asc'); // default order 

  private function _get_datatables_query2()
  {
    $this->db->select('*');
    $this->db->from('tb_barang_keluar bk');
    $this->db->join('tb_supplier s', 's.id_supplier = bk.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bk.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bk.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bk.id_satuan');

    //add custom filter here
    if ($this->input->post('tanggal_keluar')) {
      $this->db->like('tanggal_keluar', $this->input->post('tanggal_keluar'));
    }
    if ($this->input->post('nama_supplier')) {
      $this->db->like('nama_supplier', $this->input->post('nama_supplier'));
    }

    $i = 0;
    foreach ($this->column_search2 as $item) { // loop column 
      if (@$_POST['search']['value']) { // if datatable send POST for search
        if ($i === 0) { // first loop
          $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }
        if (count($this->column_search2) - 1 == $i) //last loop
          $this->db->group_end(); //close bracket
      }
      $i++;
    }

    if (isset($_POST['order'])) { // here order processing
      $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($this->order2)) {
      $order2 = $this->order2;
      $this->db->order_by(key($order2), $order2[key($order2)]);
    }
  }
  function get_datatables2()
  {
    $this->_get_datatables_query2();
    if (@$_POST['length'] != -1)
      $this->db->limit(@$_POST['length'], @$_POST['start']);
    $query = $this->db->get();
    return $query->result();
  }
  function count_filtered2()
  {
    $this->_get_datatables_query2();
    $query = $this->db->get();
    return $query->num_rows();
  }
  function count_all2()
  {
    $this->db->from('tb_barang_keluar');
    return $this->db->count_all_results();
  }
  // end datatables barang keluar
  //
  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function select($tabel)
  {
    $query = $this->db->get($tabel);
    return $query->result();
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

  // get All tabel
  public function getAllBarangMasuk()
  {
    $this->db->select('*');
    $this->db->from('tb_barang_masuk bm');
    $this->db->join('tb_supplier s', 's.id_supplier = bm.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bm.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bm.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bm.id_satuan');
    $this->db->where('bm.jumlah >', 0);

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

  public function getAllBarangKeluar()
  {
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

  // public function cek_jumlah($tabel, $id_barang_masuk)
  // {
  //   return  $this->db->select('*')
  //     ->from($tabel)
  //     ->where('id_barang_masuk', $id_barang_masuk)
  //     ->get();
  // }

  // public function get_data_array($tabel, $id_barang_masuk)
  // {
  //   $query = $this->db->select()
  //     ->from($tabel)
  //     ->where($id_barang_masuk)
  //     ->get();
  //   return $query->result_array();
  // }

  // public function mengurangi($tabel, $id_barang_masuk, $jumlah)
  // {
  //   $this->db->set("jumlah", "jumlah - $jumlah");
  //   $this->db->where('id_barang_masuk', $id_barang_masuk);
  //   $this->db->update($tabel);
  // }

}
