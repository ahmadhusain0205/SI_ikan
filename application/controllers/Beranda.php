<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends CI_Controller
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
               'judul' => 'Selamat Datang',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pelanggan' => $this->db->get_where('user', ['id_role' => 3])->num_rows(),
               'ikan' => $this->db->get('ikan')->num_rows(),
               'stok' => $this->db->query('select sum(stok_ikan) as stok_ikan from ikan')->result(),
               'transaksi' => $this->db->query('
                    select inv_penjualan, user, pelanggan, "Pembelian Langsung" as keterangan, jenis_ikan, harga_ikan, qty, diskon, tgl_jual, sub_total from penjualan_detail
                    union all
                    select inv_pembelian as inv_penjualan, "-" as user, pembeli as pelanggan, "Pembelian Online" as keterangan, jenis_ikan, harga_ikan, qty, "0" as diskon, tgl_beli as tgl_jual, sub_total from order_detail
               ')->num_rows(),
          ];
          $this->template->load('Template/Template_home', 'Beranda/admin', $data);
     }
}
