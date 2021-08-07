<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Cetak_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Cetak_model extends CI_Model
{

  // ------------------------------------------------------------------------

  public function __construct()
  {
    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function viewBarangMasuk()
  {
    $this->db->select('*');
    $this->db->from('tb_barang_masuk bm');
    $this->db->join('tb_supplier s', 's.id_supplier = bm.id_supplier');
    $this->db->join('tb_barang b', 'b.id_barang = bm.id_barang');
    $this->db->join('tb_kategori k', 'k.id_kategori = bm.id_kategori');
    $this->db->join('tb_satuan sa', 'sa.id_satuan = bm.id_satuan');

    $query = $this->db->get();
    return $query->result();
  }

  // ------------------------------------------------------------------------

}

/* End of file Cetak_model.php */
/* Location: ./application/models/Cetak_model.php */