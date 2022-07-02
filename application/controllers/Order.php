<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          } else if ($this->session->userdata('id_role') == 1) {
               redirect('Beranda');
          }
          $this->load->model('M_invoice');
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Daftar Pembelian',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'pembelian' => $this->db->query('select * from order_detail where pembeli = "' . $username . '" order by status, tgl_beli desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'Order/Data', $data);
     }
     public function tambah()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Pesan Sekarang',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'invoice' => $this->M_invoice->invoice_beli(),
          ];
          $this->template->load('Template/Template_home', 'Order/Beli', $data);
     }
     public function beli()
     {
          $inv = $this->input->get('inv');
          $user = $this->session->userdata('username');
          $kode = $this->input->get('kode');
          $qty = $this->input->get('qty');
          $harga = $this->input->get('harga');
          $jumlah = $this->input->get('subtotal');
          $ikan = $this->db->get_where('ikan', ['id' => $kode])->row_array();
          $jenis_ikan = $ikan['jenis_ikan'];
          $data = [
               'inv_pembelian' => $inv,
               'pembeli' => $user,
               'jenis_ikan' => $jenis_ikan,
               'harga_ikan' => $harga,
               'qty' => $qty,
               'sub_total' => $jumlah,
               'status' => 0,
          ];
          $this->db->insert('order_detail', $data);
     }
     public function batal($id)
     {
          $this->db->where('id', $id);
          $this->db->delete('order_detail');
          echo json_encode(['status' => 1]);
     }
     public function terima($id)
     {
          $this->db->set('status', 2);
          $this->db->where('id', $id);
          $this->db->update('order_detail');
          echo json_encode(['status' => 1]);
     }
}
