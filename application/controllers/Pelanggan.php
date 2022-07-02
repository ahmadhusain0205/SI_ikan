<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          } else if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Daftar Pelanggan',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pelanggan' => $this->db->query('select * from user where id_role = 3 order by id desc')->result()
          ];
          $this->template->load('Template/Template_home', 'Pelanggan/Data', $data);
          $this->load->view('Modal/Tambah');
          $this->load->view('Modal/Ubah', $data);
     }
     public function cekusername()
     {
          $username = $this->input->get('username');
          $cek = $this->db->get_where('user', ['username' => $username])->row_array();
          if ($cek) {
               echo json_encode(['status' => 1]);
          }
     }
     public function tambah()
     {
          $username = $this->input->post('lupusername');
          $password = md5($this->input->post('luppassword'));
          $nama = $this->input->post('lupnama');
          $nohp = $this->input->post('lupnohp');
          $alamat = $this->input->post('lupalamat');

          $cek = $this->db->get_where('user', ['username' => $username])->row_array();
          if ($cek == false) {
               if (
                    $username != '' || $username != null
                    || $password != '' || $password != null || $nama != '' || $nama != null
                    || $nohp != '' || $nohp != null
                    || $alamat != '' || $alamat != null
               ) {
                    $data = [
                         'username' => $username,
                         'password' => $password,
                         'nama' => $nama,
                         'no_hp' => $nohp,
                         'alamat' => $alamat,
                         'id_role' => 3,
                    ];
                    $this->db->insert('user', $data);
                    echo json_encode(['status' => 1]);
               } else {
                    echo json_encode(['status' => 2]);
               }
          } else {
               echo json_encode(['status' => 3]);
          }
     }
     public function data()
     {
          $id = $this->input->get('id');
          $data = $this->db->get_where('user', ['id' => $id])->row_array();
          echo json_encode($data);
     }
     function ubah()
     {
          $username = $this->input->post('eusername');
          $nama = $this->input->post('enama');
          $nohp = $this->input->post('enohp');
          $alamat = $this->input->post('ealamat');
          if (
               $username != null
               && $nama != null && $nohp != null && $alamat != null
          ) {
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     function ubah_proses()
     {
          $username = $this->input->post('eusername');
          $nama = $this->input->post('enama');
          $nohp = $this->input->post('enohp');
          $alamat = $this->input->post('ealamat');
          if (
               $username != null
               && $nama != null && $nohp != null && $alamat != null
          ) {
               $this->db->set('nama', $nama);
               $this->db->set('alamat', $alamat);
               $this->db->set('no_hp', $nohp);
               $this->db->where('username', $username);
               $this->db->update('user');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     public function hapus($id)
     {
          if ($id == null || $id == '') {
               echo json_encode(['status' => 2]);
          } else {
               echo json_encode(['status' => 1]);
          }
     }
     public function hapus_proses($id)
     {
          if ($id != null || $id != '') {
               $this->db->where('id', $id);
               $this->db->delete('user');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
