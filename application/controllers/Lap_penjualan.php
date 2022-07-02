<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lap_penjualan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $username = $this->session->userdata('username');
    $data = [
      'judul' => 'Laporan Penjualan',
      'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
      'laporan' => $this->db->get('laporan')->result(),

    ];
    $this->template->load('Template/Template_home', 'Laporan/Penjualan', $data);
  }
  public function cari()
  {
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $laporan = $this->db->query('
      select inv_penjualan, user, pelanggan, "Pembelian Langsung" as keterangan, jenis_ikan, harga_ikan, qty, diskon, tgl_jual, sub_total from penjualan_detail where tgl_jual between "' . $dari . '" and "' . $sampai . '"
      union all
      select inv_pembelian as inv_penjualan, "-" as user, pembeli as pelanggan, "Pembelian Online" as keterangan, jenis_ikan, harga_ikan, qty, "0" as diskon, tgl_beli as tgl_jual, sub_total from order_detail where tgl_beli between "' . $dari . '" and "' . $sampai . '"
    ')->result();
    $kondisi = $this->db->get('laporan');
    // cek laporan
    if (empty($kondisi)) {
      foreach ($laporan as $l) {
        $data = [
          'inv_penjualan' => $l->inv_penjualan,
          'user' => $l->user,
          'pelanggan' => $l->pelanggan,
          'jenis_ikan' => $l->jenis_ikan,
          'harga_ikan' => $l->harga_ikan,
          'qty' => $l->qty,
          'diskon' => $l->diskon,
          'tgl_jual' => $l->tgl_jual,
          'sub_total' => $l->sub_total,
          'keterangan' => $l->keterangan,
        ];
        $this->db->insert('laporan', $data);
      }
    } else {
      $this->db->empty_table('laporan');
      foreach ($laporan as $l) {
        $data = [
          'inv_penjualan' => $l->inv_penjualan,
          'user' => $l->user,
          'pelanggan' => $l->pelanggan,
          'jenis_ikan' => $l->jenis_ikan,
          'harga_ikan' => $l->harga_ikan,
          'qty' => $l->qty,
          'diskon' => $l->diskon,
          'tgl_jual' => $l->tgl_jual,
          'sub_total' => $l->sub_total,
          'keterangan' => $l->keterangan,
        ];
        $this->db->insert('laporan', $data);
      }
    }
    redirect('Lap_penjualan');
  }
  public function hapus_semua()
  {
    $this->db->empty_table('laporan');
    redirect('Lap_penjualan');
  }
  public function cetak()
  {
    $data = [
      'laporan' => $this->db->get('laporan')->result(),
      'judul' => 'Cetak Laporan',
    ];
    $this->load->view('Laporan/Cetak', $data);
  }
}
