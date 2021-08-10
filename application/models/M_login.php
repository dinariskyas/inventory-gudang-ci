<?php

class M_login extends CI_Model
{

  public function insert($tabel, $data)
  {
    $this->db->insert($tabel, $data);
  }

  public function cek_username($tabel, $username)
  {
    return $this->db->select('username')
      ->from($tabel)
      ->where('username', $username)
      ->get()->result();
  }

  public function cek_user($tabel, $username)
  {
    return  $this->db->select('*')
      ->from($tabel)
      ->where('username', $username)
      ->get();
  }

  public function idgambar($username)
  {
    $query = $this->db->select()
      ->from('tb_user')
      ->where('username', $username)
      ->get()->row();
    return $query->id_user;
  }

  function edit_user($where, $data)
  {
    $this->db->where($where);
    return $this->db->update('tb_user', $data);
  }

  function cek_id_user()
  {
    $this->db->select("*");
    $this->db->limit(1);
    $this->db->order_by('id_user', 'DESC');
    $this->db->from('tb_user');
    return $this->db->get()->row();
  }

  public function getUserByEmail($email)
  {
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->where('email', $email);
    return  $this->db->get()->result();
  }
}
