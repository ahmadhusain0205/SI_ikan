<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PO extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
          $this->load->model('M_invoice');
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $user = $this->db->get_where('user', ['username' => $username])->row_array();
          $data = [
               'judul' => 'Purchase Order',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'invoice' => $this->M_invoice->invoice_no(),
          ];
          if ($user['id_role'] == 2) {
               $data['po'] = $this->db->query('select po.*, (select jenis_ikan from ikan where id = po.id_ikan) as jenis_ikan from po where tersisa != 0 and pemasok = "' . $user['nama'] . '" order by id desc')->result();
          } else {
               $data['po'] = $this->db->query('select po.*, (select jenis_ikan from ikan where id = po.id_ikan) as jenis_ikan from po where tersisa != 0 order by id desc')->result();
          }
          $this->template->load('Template/Template_home', 'PO/Data', $data);
          $this->load->view('Modal/Detail_po');
     }

     public function order()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Purchase Order',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'stok' => $this->db->query('select * from ikan order by stok_ikan desc')->result(),
               'pemasok' => $this->db->get_where('user', ['id_role' => 2])->result(),
               'ikan' => $this->db->get('ikan')->result(),
               'pajak' => $this->db->get_where('pajak', ['id' => 1])->row_array(),
               'invoice' => $this->M_invoice->invoice_no(),
          ];
          $this->template->load('Template/Template_home', 'PO/Order', $data);
     }
     public function cekharga()
     {
          $id = $this->input->get('id');
          $data = $this->db->query('select hargabl_ikan from ikan where id = "' . $id . '"')->row_array();
          echo json_encode($data);
     }

     public function order_proses()
     {
          $inv_po = $this->input->get('inv_po');
          $user = $this->input->get('user');
          $pemasok = $this->input->get('pemasok');
          $tglpo = $this->input->get('tglpo');
          $jenis_ikan = $this->input->get('jenis_ikan');
          $jmlpo = $this->input->get('jmlpo');
          $subtotal = $this->input->get('subtotal');
          $diskon = $this->input->get('diskon');
          $ppn = $this->input->get('ppn');
          $total = $this->input->get('total');
          $data = [
               'inv_po' => $inv_po,
               'id_ikan' => $jenis_ikan,
               'tglpo' => $tglpo,
               'jmlpo' => $jmlpo,
               'terkirim' => 0,
               'tersisa' => $jmlpo,
               'pemasok' => $pemasok,
               'user' => $user,
               'subtotal' => $subtotal,
               'diskon' => $diskon,
               'ppn' => $ppn,
               'total' => $total,
          ];
          // echo json_encode($data);
          if ($inv_po != '' && $user != '' && $pemasok != '' && $tglpo != '' && $jenis_ikan != '' && $jmlpo != '') {
               $this->db->insert('po', $data);
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     public function detail()
     {
          $id = $this->input->get('id');
          $data = $this->db->query('select po.*, (select jenis_ikan from ikan where id = po.id_ikan) as jenis_ikan from po where id = "' . $id . '"')->row_array();
          echo json_encode($data);
     }
}
