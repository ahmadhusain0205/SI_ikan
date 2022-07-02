<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
     }
     public function index()
     {
          $data = [
               'judul' => 'Login'
          ];
          $this->template->load('Template/template_auth', 'Auth/Login', $data);
     }
     public function login()
     {
          $username = $this->input->get('username');
          $password = md5($this->input->get('password'));
          $user = $this->db->get_where('user', ['username' => $username])->row_array();
          if ($user) {
               if ($password == $user['password']) {
                    $this->session->set_userdata($user);
                    $this->db->set('on_off', 1);
                    $this->db->where('username', $username);
                    $this->db->update('user');
                    if ($user['id_role'] == 1) {
                         echo json_encode(['status' => 1]);
                    } else if ($user['id_role'] == 2) {
                         echo json_encode(['status' => 2]);
                    } else {
                         echo json_encode(['status' => 3]);
                    }
               } else {
                    echo json_encode(['status' => 4]);
               }
          } else {
               echo json_encode(['status' => 5]);
          }
     }
     public function regist()
     {
          $data = [
               'judul' => 'Register'
          ];
          $this->template->load('Template/template_auth', 'Auth/Regist', $data);
     }
     public function cekakun()
     {
          $username = $this->input->post('username');
          $data = $this->db->get_where('user', ['username' => $username])->row_array();
          if ($data == false) {
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     public function register()
     {
          $username = $this->input->post('username');
          $password = md5($this->input->post('password'));
          $nama = $this->input->post('nama');
          $nohp = $this->input->post('nohp');
          $alamat = $this->input->post('alamat');

          if (
               $username != '' || $username != null
               || $password != '' || $password != null || $nama != '' || $nama != null
               || $nohp != '' || $nohp != null
               || $alamat != '' || $alamat != null
          ) {
               $data = [
                    'username' => $username,
                    'password' => $password,
                    'nama' => $nama,
                    'no_hp' => $nohp,
                    'alamat' => $alamat,
                    'id_role' => 3,
               ];
               $this->db->insert('user', $data);
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
     function keluar()
     {
          $this->db->set('on_off', 0);
          $this->db->where('username', $this->session->userdata('username'));
          $this->db->update('user');
          $this->session->sess_destroy();
          redirect('Auth');
     }
}
