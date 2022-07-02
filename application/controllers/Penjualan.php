<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          } else if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
          $this->load->model('M_invoice');
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Transaksi Penjualan',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'invoice' => $this->M_invoice->invoice_transaksi(),
               'pelanggan' => $this->db->query('select * from user where id_role = 3')->result(),
               'keranjang2' => $this->db->get('keranjang2')->result(),
          ];
          $this->template->load('Template/Template_home', 'Transaksi/Penjualan', $data);
          // $this->load->view('Modal/Detail_po');
     }
     public function jual()
     {
          $inv = $this->input->get('inv');
          $tgl_jual = $this->input->get('tgl_jual');
          $user = $this->input->get('user');
          $pelanggan = $this->input->get('pelanggan');
          $kode = $this->input->get('kode');
          $qty = $this->input->get('qty');
          $harga = $this->input->get('harga');
          $discrp = $this->input->get('discrp');
          $jumlah = $this->input->get('jumlah');
          $ikan = $this->db->get_where('ikan', ['id' => $kode])->row_array();
          $jenis_ikan = $ikan['jenis_ikan'];
          $data = [
               'inv_penjualan' => $inv,
               'user' => $user,
               'pelanggan' => $pelanggan,
               'jenis_ikan' => $jenis_ikan,
               'harga_ikan' => $harga,
               'qty' => $qty,
               'diskon' => $discrp,
               'tgl_jual' => $tgl_jual,
               'sub_total' => $jumlah,
          ];
          $this->db->insert('penjualan_detail', $data);
          $qtyx = $this->db->get_where('penjualan_detail', ['jenis_ikan' => $jenis_ikan])->row_array();
          $bapb = $this->db->query('select * from bapb where id_ikan = "' . $kode . '" order by id desc')->row_array();
          $stok_in = $bapb['stok_in'];

          $stok_in_new = $stok_in - $qty;
          $this->db->set('stok_in', $stok_in_new);
          $this->db->where('id', $bapb['id']);
          $this->db->update('bapb');

          $qty_new = $ikan['stok_ikan'] - $qtyx['qty'];
          $this->db->set('stok_ikan', $qty_new);
          $this->db->where('jenis_ikan', $qtyx['jenis_ikan']);
          $this->db->update('ikan');
     }
     public function data_jual()
     {
          $inv = $this->input->get('inv');
          $sub_total = $this->input->get('sub_total');
          $diskon = $this->input->get('diskon');
          $pajak = $this->input->get('pajak');
          $total = $this->input->get('total');
          $pembayaran = $this->input->get('pembayaran');
          $kembalian = $this->input->get('kembalian');
          $data_penjual = [
               'inv_penjualan' => $inv,
               'sub_total' => $sub_total,
               'pajak' => $pajak,
               'sub_diskon' => $diskon,
               'total' => $total,
               'pembayaran' => $pembayaran,
               'kembalian' => $kembalian,
          ];
          $this->db->insert('penjualan_data', $data_penjual);

          echo json_encode(['status' => 1]);
     }
     public function cetak($inv)
     {
          $data = [
               'penjualan' => $this->db->get_where('penjualan_detail', ['inv_penjualan' => $inv])->result(),
               'judul' => 'Cetak Nota',
          ];
          $this->load->view('Transaksi/Cetak', $data);
     }
}
