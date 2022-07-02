<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ikan extends CI_Controller
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
               'judul' => 'Daftar Ikan',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'ikan' => $this->db->query('select * from ikan order by id desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'Ikan/Data', $data);
          $this->load->view('Modal/Tambah_ikan');
          $this->load->view('Modal/Ubah_ikan', $data);
     }
     public function tambah()
     {
          $jenisikan = $this->input->post('lupjenisikan');
          $ukuranikan = $this->input->post('lupukuranikan');
          $hargablikan = $this->input->post('luphargablikan');
          $hargajlikan = $this->input->post('luphargajlikan');
          if ($jenisikan != '' && $ukuranikan != '' && $hargablikan != '' && $hargajlikan != '') {
               $data = [
                    'jenis_ikan' => $jenisikan,
                    'ukuran_ikan' => $ukuranikan,
                    'hargabl_ikan' => $hargablikan,
                    'hargajl_ikan' => $hargajlikan,
                    'stok_ikan' => 0,
               ];
               $this->db->insert('ikan', $data);
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     public function data()
     {
          $id = $this->input->get('id');
          $data = $this->db->get_where('ikan', ['id' => $id])->row_array();
          echo json_encode($data);
     }
     public function ubah()
     {
          $jenisikan = $this->input->post('lupjenisikanubah');
          $ukuranikan = $this->input->post('lupukuranikanubah');
          $hargablikan = $this->input->post('luphargablikanubah');
          $hargajlikan = $this->input->post('luphargajlikanubah');
          if (
               $jenisikan != null
               && $ukuranikan != null && $hargablikan != null && $hargajlikan != null
          ) {
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     public function ubah_proses()
     {
          $id = $this->input->post('lupidikan');
          $jenisikan = $this->input->post('lupjenisikanubah');
          $ukuranikan = $this->input->post('lupukuranikanubah');
          $hargablikan = $this->input->post('luphargablikanubah');
          $hargajlikan = $this->input->post('luphargajlikanubah');
          if (
               $jenisikan != null
               && $ukuranikan != null && $hargablikan != null && $hargajlikan != null
          ) {
               $this->db->set('jenis_ikan', $jenisikan);
               $this->db->set('ukuran_ikan', $ukuranikan);
               $this->db->set('hargabl_ikan', $hargablikan);
               $this->db->set('hargajl_ikan', $hargajlikan);
               $this->db->where('id', $id);
               $this->db->update('ikan');
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
               $this->db->delete('ikan');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
