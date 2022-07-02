<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
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
               'judul' => 'Pesanan',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pesanan' => $this->db->get('order_detail')->result(),
          ];
          $this->template->load('Template/Template_home', 'Pesanan/Data', $data);
     }
     public function terima($id)
     {
          $order = $this->db->get_where('order_detail', ['id' => $id])->row_array();
          $qty = (int)$order['qty'];
          $jenis_ikan = $order['jenis_ikan'];
          $ikan = $this->db->get_where('ikan', ['jenis_ikan' => $jenis_ikan])->row_array();
          $stok_ikan = (int)$ikan['stok_ikan'];
          $qty_new = $stok_ikan - $qty;
          $this->db->set('stok_ikan', $qty_new);
          $this->db->where('jenis_ikan', $jenis_ikan);
          $this->db->update('ikan');

          $bapb = $this->db->query('select * from bapb where id_ikan = "' . $ikan['id'] . '" order by id desc')->row_array();
          $stok_in = $bapb['stok_in'];
          $stok_in_new = $stok_in - $qty;
          $this->db->set('stok_in', $stok_in_new);
          $this->db->where('id', $bapb['id']);
          $this->db->update('bapb');

          $this->db->set('status', 1);
          $this->db->where('id', $id);
          $this->db->update('order_detail');
          echo json_encode(['status' => 1]);
     }
}
