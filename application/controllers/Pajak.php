<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak extends CI_Controller
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
               'judul' => 'Pajak',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pajak' => $this->db->query('select * from pajak')->result()
          ];
          $this->template->load('Template/Template_home', 'Pajak/Data', $data);
          $this->load->view('Modal/Ubahpajak', $data);
     }
     public function data()
     {
          $id = $this->input->get('id');
          $data = $this->db->get_where('pajak', ['id' => $id])->row_array();
          echo json_encode($data);
     }
     function ubah()
     {
          $id = $this->input->post('eid');
          $namapajak = $this->input->post('enamapajak');
          $persentase = $this->input->post('epersentase');
          if (
               $id != null
               && $namapajak != null && $persentase != null
          ) {
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     function ubah_proses()
     {
          $id = $this->input->post('eid');
          $namapajak = $this->input->post('enamapajak');
          $persentase = $this->input->post('epersentase');
          if (
               $id != null
               && $namapajak != null && $persentase != null
          ) {
               $this->db->set('nama_pajak', $namapajak);
               $this->db->set('persentase', $persentase);
               $this->db->where('id', $id);
               $this->db->update('pajak');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
