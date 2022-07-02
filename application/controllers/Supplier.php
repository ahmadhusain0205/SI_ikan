<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 1) {
               redirect('Beranda');
          } else if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Supplier',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pelanggan' => $this->db->get_where('user', ['id_role' => 3])->num_rows(),
               'ikan' => $this->db->get('ikan')->num_rows(),
               'stok' => $this->db->query('select sum(stok_ikan) as stok_ikan from ikan')->result(),
               'transaksi' => $this->db->get('penjualan_data')->num_rows(),
          ];
          $this->template->load('Template/Template_home', 'Supplier/Beranda', $data);
     }
}
