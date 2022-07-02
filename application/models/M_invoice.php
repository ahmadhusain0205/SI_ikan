<?php
class M_invoice extends CI_Model
{
  public function invoice_no()
  {
    $sql = "SELECT inv_po AS inv_po FROM po ORDER BY inv_po DESC LIMIT 1";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $n = (substr($row->inv_po, 10)) + 1;
      $no = sprintf("%'.06d", $n);
    } else {
      $no = "000001";
    }
    $invoice = "SISMON-PO-" . $no;
    return $invoice;
  }
  public function invoice_bapb()
  {
    $sql = "SELECT inv_bapb AS inv_bapb FROM bapb ORDER BY inv_bapb DESC LIMIT 1";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $n = (substr($row->inv_bapb, 12)) + 1;
      $no = sprintf("%'.06d", $n);
    } else {
      $no = "000001";
    }
    $invoice = "SISMON-BAPB-" . $no;
    return $invoice;
  }
  public function invoice_transaksi()
  {
    $sql = "SELECT (MID(inv_penjualan, 11, 6)) AS invoice_no FROM penjualan_data WHERE MID(inv_penjualan, 4, 6) = DATE_FORMAT(CURDATE(), '%d%m%y') ORDER BY inv_penjualan DESC LIMIT 1";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $n = ((int)$row->invoice_no) + 1;
      $no = sprintf("%'.06d", $n);
    } else {
      $no = "000001";
    }
    $invoice = "ST-" . date('dmy-') . $no;
    return $invoice;
  }
  public function invoice_beli()
  {
    $sql = "SELECT (MID(inv_pembelian, 11, 6)) AS invoice_no FROM order_detail WHERE MID(inv_pembelian, 4, 6) = DATE_FORMAT(CURDATE(), '%d%m%y') ORDER BY inv_pembelian DESC LIMIT 1";
    $query = $this->db->query($sql);
    if ($query->num_rows() > 0) {
      $row = $query->row();
      $n = ((int)$row->invoice_no) + 1;
      $no = sprintf("%'.06d", $n);
    } else {
      $no = "000001";
    }
    $invoice = "SP-" . date('dmy-') . $no;
    return $invoice;
  }
}
