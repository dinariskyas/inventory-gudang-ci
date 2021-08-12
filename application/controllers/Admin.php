<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_admin');
    $this->load->library('upload');
  }

  public function index()
  {
    if ($this->session->userdata('status') == 'login' && $this->session->userdata('role') == 1) {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $data['stokBarangMasuk'] = $this->M_admin->sum('tb_barang_masuk', 'jumlah');
      $data['stokBarangKeluar'] = $this->M_admin->sum('tb_barang_keluar', 'jumlah');
      $data['dataUser'] = $this->M_admin->numrows('tb_user');
      $this->load->view('admin/index', $data);
    } else {
      $this->load->view('login/login');
    }
  }

  public function sigout()
  {
    session_destroy();
    redirect('login');
  }

  ####################################
  // Profile
  ####################################

  public function profile()
  {
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->session->set_userdata($data);
    $this->load->view('admin/profile', $data);
  }

  public function token_generate()
  {
    return md5(uniqid(rand(), true));
  }

  private function hash_password($password)
  {
    return password_hash($password, PASSWORD_DEFAULT);
  }

  public function proses_new_password()
  {
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('new_password', 'New Password', 'required');
    $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $new_password = $this->input->post('new_password');

        $data = array(
          'email'    => $email,
          'password' => $this->hash_password($new_password)
        );

        $where = array(
          'id_user' => $this->session->userdata('id_user')
        );

        $this->M_admin->update_password('tb_user', $where, $data);

        $this->session->set_flashdata('msg_berhasil', 'Password Telah Diganti');
        redirect(base_url('admin/profile'));
      }
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/profile', $data);
    }
  }

  public function proses_gambar_upload()
  {
    $config =  array(
      'upload_path'     => "./assets/upload/user/img/",
      'allowed_types'   => "gif|jpg|png|jpeg",
      'encrypt_name'    => False, //
      'max_size'        => "50000",  // ukuran file gambar
      'max_height'      => "9680",
      'max_width'       => "9024"
    );
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('userpicture')) {
      $this->session->set_flashdata('msg_error_gambar', $this->upload->display_errors());
      $this->load->view('admin/profile', $config);
    } else {
      $upload_data = $this->upload->data();
      $nama_file = $upload_data['file_name'];
      $ukuran_file = $upload_data['file_size'];

      //resize img + thumb Img -- Optional
      $config['image_library']     = 'gd2';
      $config['source_image']      = $upload_data['full_path'];
      $config['create_thumb']      = FALSE;
      $config['maintain_ratio']    = TRUE;
      $config['width']             = 150;
      $config['height']            = 150;

      $this->load->library('image_lib', $config);
      $this->image_lib->initialize($config);
      if (!$this->image_lib->resize()) {
        $data['pesan_error'] = $this->image_lib->display_errors();
        $this->load->view('admin/profile', $data);
      }

      $where = array(
        'id_user' => $this->session->userdata('id_user')
      );

      $data = array(
        'nama_file' => $nama_file,
        'ukuran_file' => $ukuran_file
      );
      $this->M_admin->update('tb_upload_gambar_user', $data, $where);
      $this->session->set_flashdata('msg_berhasil_gambar', 'Gambar Berhasil Di Upload');
      redirect(base_url('admin/profile'));
    }
  }

  ####################################
  // End Profile
  ####################################


  ####################################
  // Users
  ####################################
  public function users()
  {
    $data['list_users'] = $this->M_admin->kecuali('tb_user', $this->session->userdata('id_user'));
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->session->set_userdata($data);
    $this->load->view('admin/users', $data);
  }

  public function form_user()
  {
    $data['list_users'] = $this->M_admin->select('tb_user');
    $data['token_generate'] = $this->token_generate();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_insert', $data);
  }

  public function update_user()
  {
    $id_user = $this->uri->segment(3);
    $where = array('id_user' => $id_user);
    $data['token_generate'] = $this->token_generate();
    $data['list_data'] = $this->M_admin->get_data('tb_user', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->session->set_userdata($data);
    $this->load->view('admin/form_users/form_update', $data);
  }

  public function proses_delete_user()
  {
    $id_user = $this->uri->segment(3);
    $where = array('id_user' => $id_user);
    $this->M_admin->delete('tb_user', $where);
    $this->session->set_flashdata('msg_berhasil', 'User Behasil Di Delete');
    redirect(base_url('admin/users'));
  }

  public function proses_tambah_user()
  {
    $this->form_validation->set_rules('username', 'Username', 'required|callback_validation_username');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_validation_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');

    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {

        $username     = $this->input->post('username', TRUE);
        $email        = $this->input->post('email', TRUE);
        $password     = $this->input->post('password', TRUE);
        $role         = $this->input->post('role', TRUE);

        $data = array(
          'username'     => $username,
          'email'        => $email,
          'password'     => $this->hash_password($password),
          'role'         => $role,
        );

        $this->M_admin->insert('tb_user', $data);

        $data_user = $this->M_admin->cek_id_user();
        $id_user = $data_user->id_user;

        $dataUpload = array(
          'id_upload_gambar_user'     => '',
          'id_user' => $id_user,
          'nama_file' => 'nopic.png',
          'ukuran_file' => '6.33'
        );

        $this->M_admin->insert('tb_upload_gambar_user', $dataUpload);
        $this->session->set_flashdata('msg_berhasil', 'User Berhasil Ditambahkan');
        redirect(base_url('admin/form_user'));
      }
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_users/form_insert', $data);
    }
  }

  public function validation_username($str)
  {
    if (empty($this->M_admin->getUserByUsername($str))) {
      return TRUE;
    } else {
      $this->form_validation->set_message('validation_username', 'The {field} "' . "$str" . '" is already submitted');
      return FALSE;
    }
  }

  //callback function to check submitted email, and return validation message when its already submitted
  public function validation_email($str)
  {
    if (empty($this->M_admin->getUserByEmail($str))) {
      return TRUE;
    } else {
      $this->form_validation->set_message('validation_email', 'The {field} "' . "$str" . '" is already submitted');
      return FALSE;
    }
  }

  public function proses_update_user()
  {
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');


    if ($this->form_validation->run() == TRUE) {
      if ($this->session->userdata('token_generate') === $this->input->post('token')) {
        $id_user           = $this->input->post('id_user', TRUE);
        $username     = $this->input->post('username', TRUE);
        $email        = $this->input->post('email', TRUE);
        $role         = $this->input->post('role', TRUE);

        $where = array('id_user' => $id_user);
        $data = array(
          'username'     => $username,
          'email'        => $email,
          'role'         => $role,
        );
        $this->M_admin->update('tb_user', $data, $where);
        $this->session->set_flashdata('msg_berhasil', 'Data User Berhasil Diupdate');
        redirect(base_url('admin/users'));
      }
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_users/form_update', $data);
    }
  }
  ####################################
  // End Users
  ####################################


  ####################################
  // KATEGORI
  ####################################

  public function form_kategori()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_kategori/form_insert', $data);
  }

  public function tabel_kategori()
  {
    $data['list_data'] = $this->M_admin->select('tb_kategori');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/tabel/tabel_kategori', $data);
  }

  public function update_kategori()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_kategori' => $uri);
    $data['list_kategori'] = $this->M_admin->get_data('tb_kategori', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_kategori/form_update', $data);
  }

  public function delete_kategori()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_kategori' => $uri);
    $this->M_admin->delete('tb_kategori', $where);
    redirect(base_url('admin/tabel_kategori'));
  }

  public function proses_kategori_insert()
  {
    $this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $nama_kategori = $this->input->post('nama_kategori', TRUE);

      $data = array(
        'nama_kategori' => $nama_kategori
      );
      $this->M_admin->insert('tb_kategori', $data);

      $this->session->set_flashdata('msg_berhasil', 'Data kategori Berhasil Ditambahkan');
      redirect(base_url('admin/form_kategori'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_kategori/form_insert', $data);
    }
  }

  public function proses_kategori_update()
  {
    $this->form_validation->set_rules('nama_kategori', 'Nama kategori', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $id_kategori   = $this->input->post('id_kategori', TRUE);
      $nama_kategori = $this->input->post('nama_kategori', TRUE);

      $where = array(
        'id_kategori' => $id_kategori
      );

      $data = array(
        'nama_kategori' => $nama_kategori
      );
      $this->M_admin->update('tb_kategori', $data, $where);

      $this->session->set_flashdata('msg_berhasil', 'Data kategori Berhasil Di Update');
      redirect(base_url('admin/tabel_kategori'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_kategori/form_update', $data);
    }
  }

  ####################################
  // END Kategori 
  ####################################

  ####################################
  // SATUAN
  ####################################

  public function form_satuan()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_satuan/form_insert', $data);
  }

  public function tabel_satuan()
  {
    $data['list_data'] = $this->M_admin->select('tb_satuan');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/tabel/tabel_satuan', $data);
  }

  public function update_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $data['list_satuan'] = $this->M_admin->get_data('tb_satuan', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_satuan/form_update', $data);
  }

  public function delete_satuan()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_satuan' => $uri);
    $this->M_admin->delete('tb_satuan', $where);
    redirect(base_url('admin/tabel_satuan'));
  }

  public function proses_satuan_insert()
  {
    $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $nama_satuan = $this->input->post('nama_satuan', TRUE);

      $data = array(
        'nama_satuan' => $nama_satuan
      );
      $this->M_admin->insert('tb_satuan', $data);

      $this->session->set_flashdata('msg_berhasil', 'Data satuan Berhasil Ditambahkan');
      redirect(base_url('admin/form_satuan'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_satuan/form_insert', $data);
    }
  }

  public function proses_satuan_update()
  {
    $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $id_satuan   = $this->input->post('id_satuan', TRUE);
      $nama_satuan = $this->input->post('nama_satuan', TRUE);

      $where = array(
        'id_satuan' => $id_satuan
      );

      $data = array(
        'nama_satuan' => $nama_satuan
      );
      $this->M_admin->update('tb_satuan', $data, $where);

      $this->session->set_flashdata('msg_berhasil', 'Data satuan Berhasil Di Update');
      redirect(base_url('admin/tabel_satuan'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_satuan/form_update', $data);
    }
  }

  ####################################
  // END Satuan
  ####################################

  ####################################
  // SUPPLIER
  ####################################

  public function form_supplier()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_supplier/form_insert', $data);
  }

  public function tabel_supplier()
  {
    $data['list_data'] = $this->M_admin->select('tb_supplier');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/tabel/tabel_supplier', $data);
  }

  public function update_supplier()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_supplier' => $uri);
    $data['list_supplier'] = $this->M_admin->get_data('tb_supplier', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_supplier/form_update', $data);
  }

  public function delete_supplier()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_supplier' => $uri);
    $this->M_admin->delete('tb_supplier', $where);
    redirect(base_url('admin/tabel_supplier'));
  }

  public function proses_supplier_insert()
  {
    $this->form_validation->set_rules('nama_supplier', 'Nama Supplier', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $nama_supplier = $this->input->post('nama_supplier', TRUE);
      $no_telp = $this->input->post('no_telp', TRUE);
      $alamat = $this->input->post('alamat', TRUE);

      $data = array(
        'nama_supplier' => $nama_supplier,
        'no_telp' => $no_telp,
        'alamat' => $alamat
      );
      $this->M_admin->insert('tb_supplier', $data);

      $this->session->set_flashdata('msg_berhasil', 'Data supplier Berhasil Ditambahkan');
      redirect(base_url('admin/form_supplier'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_supplier/form_insert', $data);
    }
  }

  public function proses_supplier_update()
  {
    $this->form_validation->set_rules('nama_supplier', 'Nama supplier', 'trim|required|max_length[100]');

    if ($this->form_validation->run() ==  TRUE) {
      $id_supplier   = $this->input->post('id_supplier', TRUE);
      $nama_supplier = $this->input->post('nama_supplier', TRUE);
      $no_telp = $this->input->post('no_telp', TRUE);
      $alamat = $this->input->post('alamat', TRUE);

      $where = array(
        'id_supplier' => $id_supplier
      );

      $data = array(
        'nama_supplier' => $nama_supplier,
        'no_telp' => $no_telp,
        'alamat' => $alamat
      );
      $this->M_admin->update('tb_supplier', $data, $where);

      $this->session->set_flashdata('msg_berhasil', 'Data supplier Berhasil Di Update');
      redirect(base_url('admin/tabel_supplier'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_supplier/form_update', $data);
    }
  }

  ####################################
  // END supplier
  ####################################

  ####################################
  // BARANG
  ####################################

  public function form_barang()
  {
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_barang/form_insert', $data);
  }

  public function tabel_barang()
  {
    $data['list_data'] = $this->M_admin->select('tb_barang');
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/tabel/tabel_barang', $data);
  }

  public function update_barang()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_barang' => $uri);
    $data['list_barang'] = $this->M_admin->get_data('tb_barang', $where);
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_barang/form_update', $data);
  }

  public function delete_barang()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_barang' => $uri);
    $this->M_admin->delete('tb_barang', $where);
    redirect(base_url('admin/tabel_barang'));
  }

  public function proses_barang_insert()
  {
    $this->form_validation->set_rules('kd_barang', 'Kode Barang', 'trim|required|max_length[100]');
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required|max_length[100]');

    if ($this->form_validation->run() == TRUE) {
      $kd_barang = $this->input->post('kd_barang', TRUE);
      $nama_barang       = $this->input->post('nama_barang', TRUE);

      $data = array(
        'kd_barang' => $kd_barang,
        'nama_barang' => $nama_barang
      );
      $this->M_admin->insert('tb_barang', $data);

      $this->session->set_flashdata('msg_berhasil', 'Data Barang Berhasil Ditambahkan');
      redirect(base_url('admin/form_barang'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_barang/form_insert', $data);
    }
  }

  public function proses_data_barang_update()
  {
    $this->form_validation->set_rules('kd_barang', 'Kode Barang', 'required');
    $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');

    if ($this->form_validation->run() == TRUE) {
      $id_barang = $this->input->post('id_barang', TRUE);
      $kd_barang = $this->input->post('kd_barang', TRUE);
      $nama_barang  = $this->input->post('nama_barang', TRUE);

      $where = array('id_barang' => $id_barang);
      $data = array(
        'id_barang' => $id_barang,
        'kd_barang'       => $kd_barang,
        'nama_barang'      => $nama_barang
      );
      $this->M_admin->update('tb_barang', $data, $where);
      $this->session->set_flashdata('msg_berhasil', 'Data Barang Berhasil Diupdate');
      redirect(base_url('admin/tabel_barang'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_barang/form_update', $data);
    }
  }

  ####################################
  // END DATA BARANG 
  ####################################

  ####################################
  // DATA BARANG MASUK
  ####################################

  public function form_barang_masuk()
  {
    $data['list_data'] = $this->M_admin->getAllBarangMasuk();
    $data['list_supplier'] = $this->M_admin->getAllSupplier();
    $data['list_barang'] = $this->M_admin->getAllBarang();
    $data['list_kategori'] = $this->M_admin->getAllKategori();
    $data['list_satuan'] = $this->M_admin->getAllSatuan();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_barang_masuk/form_insert', $data);
  }

  public function tabel_barang_masuk()
  {
    $data = array(
      'list_data' => $this->M_admin->getAllBarangMasuk(),
      'supplier'  => $this->M_admin->getAllSupplier(),
      'barang'  => $this->M_admin->getAllBarang(),
      'kategori'  => $this->M_admin->getAllKategori(),
      'satuan'  => $this->M_admin->getAllSatuan(),
      'avatar'    => $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'))
    );
    $this->load->view('admin/tabel/tabel_barang_masuk', $data);
  }

  function get_ajax()
  {
    $list = $this->M_admin->get_datatables();
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $barang_masuk) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $barang_masuk->id_barang_masuk;
      $row[] = $barang_masuk->tanggal;
      $row[] = $barang_masuk->nama_supplier;
      $row[] = $barang_masuk->nama_barang;
      $row[] = $barang_masuk->nama_kategori;
      $row[] = $barang_masuk->nama_satuan;
      $row[] = $barang_masuk->jumlah;
      // add html for action
      $row[] = '<a href="' . site_url('admin/update_barang_masuk/' . $barang_masuk->id_barang_masuk) . '" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                <a href="' . site_url('admin/delete_barang_masuk/' . $barang_masuk->id_barang_masuk) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Delete</a>
                <a href="' . site_url('admin/barang_keluar/' . $barang_masuk->id_barang_masuk) . '"  class="btn btn-warning btn-barangkeluar"><i class="fa fa-sign-out"></i> Keluarkan</a>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->M_admin->count_all(),
      "recordsFiltered" => $this->M_admin->count_filtered(),
      "data" => $data,
    );
    // output to json format
    echo json_encode($output);
  }

  public function cetakLaporan()
  {
    $this->form_validation->set_rules('transaksi', 'Transaksi', 'required|in_list[tb_barang_masuk,tb_barang_keluar]');
    $this->form_validation->set_rules('tanggal', 'Periode Tanggal', 'required');

    if ($this->form_validation->run() == false) {
      $data['title'] = "Laporan Transaksi";
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/laporan/form', $data);
    } else {
      $input = $this->input->post(null, true);
      $table = $input['transaksi'];
      $tanggal = $input['tanggal'];
      $pecah = explode(' - ', $tanggal);
      $mulai = date('Y-m-d', strtotime($pecah[0]));
      $akhir = date('Y-m-d', strtotime(end($pecah)));

      $query = '';
      if ($table == 'tb_barang_masuk') {
        $query = $this->M_admin->getBarangMasuk(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
      } else {
        $query = $this->M_admin->getBarangKeluar(null, null, ['mulai' => $mulai, 'akhir' => $akhir]);
      }

      $this->_cetak($query, $table, $tanggal);
    }
  }

  private function _cetak($data, $table_, $tanggal)
  {
    $this->load->library('CustomPDF');
    $table = $table_ == 'tb_barang_masuk' ? 'Barang Masuk' : 'Barang Keluar';

    $pdf = new FPDF();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
    $pdf->SetFont('Times', '', 10);
    $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Times', 'B', 11);

    if ($table_ == 'tb_barang_masuk') :
      $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
      $pdf->Cell(36, 7, 'ID Transaksi', 1, 0, 'C');
      $pdf->Cell(25, 7, 'Tgl Masuk', 1, 0, 'C');
      $pdf->Cell(38, 7, 'Supplier', 1, 0, 'C');
      $pdf->Cell(38, 7, 'Nama Barang', 1, 0, 'C');
      $pdf->Cell(24, 7, 'Kategori', 1, 0, 'C');
      $pdf->Cell(27, 7, 'Jumlah Masuk', 1, 0, 'C');
      $pdf->Ln();

      $no = 1;
      foreach ($data as $d) {
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
        $pdf->Cell(36, 7, $d['id_barang_masuk'], 1, 0, 'C');
        $pdf->Cell(25, 7, $d['tanggal'], 1, 0, 'C');
        $pdf->Cell(38, 7, $d['nama_supplier'], 1, 0, 'L');
        $pdf->Cell(38, 7, $d['nama_barang'], 1, 0, 'L');
        $pdf->Cell(24, 7, $d['nama_kategori'], 1, 0, 'L');
        $pdf->Cell(27, 7, $d['jumlah'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
        $pdf->Ln();
      }
    else :
      $pdf->Cell(10, 7, 'No.', 1, 0, 'C');
      $pdf->Cell(36, 7, 'ID Transaksi', 1, 0, 'C');
      $pdf->Cell(25, 7, 'Tgl Keluar', 1, 0, 'C');
      $pdf->Cell(38, 7, 'Supplier', 1, 0, 'C');
      $pdf->Cell(38, 7, 'Nama Barang', 1, 0, 'C');
      $pdf->Cell(24, 7, 'Kategori', 1, 0, 'C');
      $pdf->Cell(27, 7, 'Jumlah Masuk', 1, 0, 'C');
      $pdf->Ln();

      $no = 1;
      foreach ($data as $d) {
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(10, 7, $no++ . '.', 1, 0, 'C');
        $pdf->Cell(36, 7, $d['id_barang_masuk'], 1, 0, 'C');
        $pdf->Cell(25, 7, $d['tanggal_keluar'], 1, 0, 'C');
        $pdf->Cell(38, 7, $d['nama_supplier'], 1, 0, 'L');
        $pdf->Cell(38, 7, $d['nama_barang'], 1, 0, 'L');
        $pdf->Cell(24, 7, $d['nama_kategori'], 1, 0, 'L');
        $pdf->Cell(27, 7, $d['jumlah'] . ' ' . $d['nama_satuan'], 1, 0, 'C');
        $pdf->Ln();
      }
    endif;

    $file_name = $table . ' ' . $tanggal;
    $pdf->Output('I', $file_name);
  }

  public function update_barang_masuk($id_barang_masuk)
  {
    $data['list_barang_masuk'] = $this->M_admin->getBarangMasukByID($id_barang_masuk);
    $data['list_satuan'] = $this->M_admin->getAllSatuan();
    $data['list_kategori'] = $this->M_admin->getAllKategori();
    $data['list_barang'] = $this->M_admin->getAllBarang();
    $data['list_supplier'] = $this->M_admin->getAllSupplier();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/form_barang_masuk/form_update', $data);
  }

  public function delete_barang_masuk($id_barang_masuk)
  {
    $where = array('id_barang_masuk' => $id_barang_masuk);
    $this->M_admin->delete('tb_barang_masuk', $where);
    redirect(base_url('admin/tabel_barang_masuk'));
  }

  public function proses_data_barang_masuk_insert()
  {
    $this->form_validation->set_rules('id_barang_masuk', 'Id_barang_masuk', 'trim|required');
    $this->form_validation->set_rules('id_supplier', 'Id_supplier', 'trim|required');
    $this->form_validation->set_rules('id_kategori', 'Id_kategori', 'trim|required');
    $this->form_validation->set_rules('id_barang', 'Id_barang', 'trim|required');
    $this->form_validation->set_rules('id_satuan', 'Id_satuan', 'trim|required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'trim|required');
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');

    if ($this->form_validation->run() == TRUE) {
      $id_barang_masuk = $this->input->post('id_barang_masuk', TRUE);
      $tanggal      = $this->input->post('tanggal', TRUE);
      $id_supplier       = $this->input->post('id_supplier', TRUE);
      $id_barang  = $this->input->post('id_barang', TRUE);
      $id_kategori  = $this->input->post('id_kategori', TRUE);
      $id_satuan       = $this->input->post('id_satuan', TRUE);
      $jumlah       = $this->input->post('jumlah', TRUE);

      $data = array(
        'id_barang_masuk' => $id_barang_masuk,
        'tanggal'      => $tanggal,
        'id_supplier'       => $id_supplier,
        'id_barang'  => $id_barang,
        'id_kategori'  => $id_kategori,
        'id_satuan'       => $id_satuan,
        'jumlah'       => $jumlah
      );
      $this->M_admin->insert('tb_barang_masuk', $data);

      $this->session->set_flashdata('msg_berhasil', 'Data Barang Berhasil Ditambahkan');
      redirect(base_url('admin/form_barang_masuk'));
    } else {
      $data['list_satuan'] = $this->M_admin->getAllSatuan();
      $data['list_kategori'] = $this->M_admin->getAllKategori();
      $data['list_barang'] = $this->M_admin->getAllBarang();
      $data['list_supplier'] = $this->M_admin->getAllSupplier();
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_barang_masuk/form_insert', $data);
    }
  }

  public function proses_data_barang_masuk_update()
  {
    $this->form_validation->set_rules('jumlah', 'Jumlah', 'trim|required');

    if ($this->form_validation->run() == TRUE) {
      $id_barang_masuk = $this->input->post('id_barang_masuk', TRUE);
      $tanggal      = $this->input->post('tanggal', TRUE);
      $id_supplier       = $this->input->post('id_supplier', TRUE);
      $id_barang  = $this->input->post('id_barang', TRUE);
      $id_kategori  = $this->input->post('id_kategori', TRUE);
      $id_satuan       = $this->input->post('id_satuan', TRUE);
      $jumlah       = $this->input->post('jumlah', TRUE);

      $where = array('id_barang_masuk' => $id_barang_masuk);
      $data = array(
        'id_barang_masuk' => $id_barang_masuk,
        'tanggal'      => $tanggal,
        'id_supplier'       => $id_supplier,
        'id_barang'  => $id_barang,
        'id_kategori'  => $id_kategori,
        'id_satuan'       => $id_satuan,
        'jumlah'       => $jumlah
      );
      $this->M_admin->update('tb_barang_masuk', $data, $where);
      $this->session->set_flashdata('msg_berhasil', 'Data Barang Berhasil Diupdate');
      redirect(base_url('admin/tabel_barang_masuk'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('admin/form_barang_masuk/form_update', $data);
    }
  }


  ####################################
  // END DATA BARANG MASUK
  ####################################

  ####################################
  // DATA MASUK KE DATA KELUAR
  ####################################

  public function barang_keluar()
  {
    $uri = $this->uri->segment(3);
    $where = array('id_barang_masuk' => $uri);
    $data['list_data'] = $this->M_admin->get_data('tb_barang_masuk', $where);
    $data['list_satuan'] = $this->M_admin->getAllSatuan();
    $data['list_kategori'] = $this->M_admin->getAllKategori();
    $data['list_barang'] = $this->M_admin->getAllBarang();
    $data['list_supplier'] = $this->M_admin->getAllSupplier();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    $this->load->view('admin/perpindahan_barang/form_update', $data);
  }

  public function delete_barang_keluar($id_barang_keluar)
  {
    $where = array('id_barang_keluar' => $id_barang_keluar);
    $this->M_admin->delete('tb_barang_keluar', $where);
    redirect(base_url('admin/tabel_barang_keluar'));
  }

  public function proses_data_keluar()
  {
    $this->form_validation->set_rules('tanggal_keluar', 'Tanggal Keluar', 'trim|required');
    if ($this->form_validation->run() === TRUE) {
      $id_barang_masuk   = $this->input->post('id_barang_masuk', TRUE);
      $tanggal_masuk  = $this->input->post('tanggal', TRUE);
      $tanggal_keluar = $this->input->post('tanggal_keluar', TRUE);
      $id_supplier       = $this->input->post('id_supplier', TRUE);
      $id_barang         = $this->input->post('id_barang', TRUE);
      $id_kategori       = $this->input->post('id_kategori', TRUE);
      $id_satuan         = $this->input->post('id_satuan', TRUE);
      $jumlah         = $this->input->post('jumlah', TRUE);

      $where = array('id_barang_masuk' => $id_barang_masuk);
      $data = array(
        'id_barang_masuk' => $id_barang_masuk,
        'tanggal_masuk' => $tanggal_masuk,
        'tanggal_keluar' => $tanggal_keluar,
        'id_supplier' => $id_supplier,
        'id_barang' => $id_barang,
        'id_kategori' => $id_kategori,
        'id_satuan' => $id_satuan,
        'jumlah' => $jumlah
      );
      $this->M_admin->insert('tb_barang_keluar', $data, $where);
      $this->session->set_flashdata('msg_berhasil_keluar', 'Data Berhasil Keluar');
      redirect(base_url('admin/tabel_barang_masuk'));
    } else {
      $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
      $this->load->view('perpindahan_barang/form_update/', $data);
    }
  }
  ####################################
  // END DATA MASUK KE DATA KELUAR
  ####################################

  ####################################
  // DATA BARANG KELUAR
  ####################################

  public function tabel_barang_keluar()
  {
    $data['list_data'] = $this->M_admin->getAllBarangKeluar();
    $data['avatar'] = $this->M_admin->get_data_gambar('tb_upload_gambar_user', $this->session->userdata('id_user'));
    // var_dump($data['list_data']);
    $this->load->view('admin/tabel/tabel_barang_keluar', $data);
  }

  function get_ajax_keluar()
  {
    $list = $this->M_admin->get_datatables2();
    $data = array();
    $no = @$_POST['start'];
    foreach ($list as $barang_keluar) {
      $no++;
      $row = array();
      $row[] = $no . ".";
      $row[] = $barang_keluar->id_barang_masuk;
      $row[] = $barang_keluar->tanggal_masuk;
      $row[] = $barang_keluar->tanggal_keluar;
      $row[] = $barang_keluar->nama_supplier;
      $row[] = $barang_keluar->nama_barang;
      $row[] = $barang_keluar->nama_kategori;
      $row[] = $barang_keluar->nama_satuan;
      $row[] = $barang_keluar->jumlah;
      // add html for action
      $row[] = '<a href="' . site_url('admin/delete_barang_keluar/' . $barang_keluar->id_barang_keluar) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Delete</a>';
      $data[] = $row;
    }
    $output = array(
      "draw" => @$_POST['draw'],
      "recordsTotal" => $this->M_admin->count_all2(),
      "recordsFiltered" => $this->M_admin->count_filtered2(),
      "data" => $data,
    );
    // output to json format
    echo json_encode($output);
  }
}
