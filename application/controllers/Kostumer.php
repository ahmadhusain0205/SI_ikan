<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kostumer extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 1) {
               redirect('Beranda');
          } else if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          }
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Selamat Datang',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pelanggan' => $this->db->get_where('user', ['id_role' => 3])->num_rows(),
               'ikan' => $this->db->get('ikan')->num_rows(),
               'stok' => $this->db->query('select sum(stok_ikan) as stok_ikan from ikan')->result(),
          ];
          $this->template->load('Template/Template_home', 'Kostumer/Beranda', $data);
     }
}
