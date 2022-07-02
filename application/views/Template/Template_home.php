<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <title><?= $judul; ?></title>
     <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
     <link href="<?= base_url('assets/'); ?>fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
     <link rel="stylesheet" href="<?= base_url('assets'); ?>/tables/DataTables-1.11.5/css/jquery.dataTables.min.css" type="text/css">
     <link rel="stylesheet" href="<?= base_url('assets'); ?>/tables/DataTables-1.11.5/css/dataTables.bootstrap4.min.css" type="text/css">
     <link rel="stylesheet" href="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/css/buttons.bootstrap4.min.css" type="text/css">
     <script src="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.min.js"></script>
     <link rel="stylesheet" href="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.min.css">
     <!-- jquery -->
     <script src="<?= base_url('assets'); ?>/vendor/jquery/jquery.min.js"></script>
     <!-- chart js -->
     <script type="text/javascript" src="<?= base_url('assets'); ?>/js/Chart.js"></script>
     <script src="<?= base_url('assets'); ?>/js/jquery-3.5.1.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" integrity="sha512-kq3FES+RuuGoBW3a9R2ELYKRywUEQv0wvPTItv3DSGqjpbNtGWVdvT8qwdKkqvPzT93jp8tSF4+oN4IeTEIlQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/select2/dist/css/select2.min.css">
     <script src="<?= base_url('assets'); ?>/select2/dist/js/select2.min.js" type="text/javascript"></script>
</head>

<body id="page-top">
     <div id="wrapper">
          <?php if ($this->uri->segment(1) != 'Lap_penjualan') {
               $this->db->empty_table('laporan');
          } ?>
          <?php if ($this->uri->segment(1) == 'Penjualan' || $this->uri->segment(1) == 'Order') { ?>
               <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion hold-transition sidebar-mini 1 sidebar-toggled 1 toggled" id="accordionSidebar">
               <?php } else { ?>
                    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                    <?php } ?>
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= site_url('Home'); ?>">
                         <div class="sidebar-brand-icon">
                              <i class="fa fa-tv"></i>
                         </div>
                         <div class="sidebar-brand-text mx-3">SISMON</div>
                    </a>
                    <?php
                    if ($user['id_role'] == 2) { ?>
                         <div id="produk">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Produk
                              </div>
                              <?php if ($this->uri->segment(1) == 'Supplier') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Supplier'); ?>">
                                             <i class="fas fa-fw fa-tachometer-alt"></i>
                                             <span>Beranda</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Supplier'); ?>">
                                             <i class="fas fa-fw fa-tachometer-alt"></i>
                                             <span>Beranda</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                              <?php if ($this->uri->segment(1) == 'PO') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('PO'); ?>">
                                             <i class="fa fa-caret-left"></i>
                                             <span>Purchase Order</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('PO'); ?>">
                                             <i class="fa fa-caret-left"></i>
                                             <span>Purchase Order</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>
                    <?php } else if ($user['id_role'] == 3) { ?>

                         <div id="produk">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Sistem
                              </div>
                              <?php if ($this->uri->segment(1) == 'Kostumer') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Kostumer'); ?>">
                                             <i class="fas fa-fw fa-tachometer-alt"></i>
                                             <span>Beranda</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Kostumer'); ?>">
                                             <i class="fas fa-fw fa-tachometer-alt"></i>
                                             <span>Beranda</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                              <?php if ($this->uri->segment(1) == 'Order') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Order'); ?>">
                                             <i class="fas fa-fw fa-cart-plus"></i>
                                             <span>Order</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Order'); ?>">
                                             <i class="fas fa-fw fa-cart-plus"></i>
                                             <span>Order</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>

                    <?php } else { ?>

                         <hr class="sidebar-divider my-0">
                         <?php if ($this->uri->segment(1) == 'Beranda' && $this->uri->segment(2) == '') : ?>
                              <li class="nav-item active">
                                   <a class="nav-link" href="<?= site_url('Beranda'); ?>">
                                        <i class="fas fa-fw fa-tachometer-alt"></i>
                                        <span>Beranda</span>
                                   </a>
                              </li>
                         <?php else : ?>
                              <li class="nav-item">
                                   <a class="nav-link" href="<?= site_url('Beranda'); ?>">
                                        <i class="fas fa-fw fa-tachometer-alt"></i>
                                        <span>Beranda</span>
                                   </a>
                              </li>
                         <?php endif; ?>
                         <?php $ap = $this->db->get_where('order_detail', ['status' => 0])->num_rows(); ?>
                         <?php if ($this->uri->segment(1) == 'Pesanan' && $this->uri->segment(2) == '') : ?>
                              <li class="nav-item active">
                                   <a class="nav-link" href="<?= site_url('Pesanan'); ?>">
                                        <i class="fas fa-fw fa-shopping-cart"></i>
                                        <sup><?= $ap; ?></sup>
                                        <span>Pesanan</span>
                                   </a>
                              </li>
                         <?php else : ?>
                              <li class="nav-item">
                                   <a class="nav-link" href="<?= site_url('Pesanan'); ?>">
                                        <i class="fas fa-fw fa-shopping-cart"></i>
                                        <sup><?= $ap; ?></sup>
                                        <span>Pesanan</span>
                                   </a>
                              </li>
                         <?php endif; ?>
                         <?php if ($user['id_role'] == 1) : ?>
                              <div id="master">
                                   <hr class="sidebar-divider">
                                   <div class="sidebar-heading">
                                        Master
                                   </div>
                                   <?php if ($this->uri->segment(1) == 'Admin' || $this->uri->segment(1) == 'Pemasok' || $this->uri->segment(1) == 'Pelanggan') : ?>
                                        <li class="nav-item active">
                                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                  <i class="fas fa-users"></i>
                                                  <span>Anggota</span>
                                             </a>
                                             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                                  <div class="bg-white py-2 collapse-inner rounded">
                                                       <h6 class="collapse-header">Daftar:</h6>
                                                       <a class="collapse-item" href="<?= site_url('Admin'); ?>">Admin</a>
                                                       <a class="collapse-item" href="<?= site_url('Pemasok'); ?>">Pemasok</a>
                                                       <a class="collapse-item" href="<?= site_url('Pelanggan'); ?>">Pelanggan</a>
                                                  </div>
                                             </div>
                                        </li>
                                   <?php else : ?>
                                        <li class="nav-item">
                                             <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                  <i class="fas fa-users"></i>
                                                  <span>Anggota</span>
                                             </a>
                                             <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                                  <div class="bg-white py-2 collapse-inner rounded">
                                                       <h6 class="collapse-header">Daftar:</h6>
                                                       <a class="collapse-item" href="<?= site_url('Admin'); ?>">Admin</a>
                                                       <a class="collapse-item" href="<?= site_url('Pemasok'); ?>">Pemasok</a>
                                                       <a class="collapse-item" href="<?= site_url('Pelanggan'); ?>">Pelanggan</a>
                                                  </div>
                                             </div>
                                        </li>
                                   <?php endif; ?>
                                   <?php if ($this->uri->segment(1) == 'Role') : ?>
                                        <li class="nav-item active">
                                             <a class="nav-link" href="<?= site_url('Role'); ?>">
                                                  <i class="fas fa-user-cog"></i>
                                                  <span>Role</span>
                                             </a>
                                        </li>
                                   <?php else : ?>
                                        <li class="nav-item">
                                             <a class="nav-link" href="<?= site_url('Role'); ?>">
                                                  <i class="fas fa-user-cog"></i>
                                                  <span>Role</span>
                                             </a>
                                        </li>
                                   <?php endif; ?>
                                   <?php if ($this->uri->segment(1) == 'Pajak') : ?>
                                        <li class="nav-item active">
                                             <a class="nav-link" href="<?= site_url('Pajak'); ?>">
                                                  <i class="fas fa-eye"></i>
                                                  <span>Pajak</span>
                                             </a>
                                        </li>
                                   <?php else : ?>
                                        <li class="nav-item">
                                             <a class="nav-link" href="<?= site_url('Pajak'); ?>">
                                                  <i class="fas fa-eye"></i>
                                                  <span>Pajak</span>
                                             </a>
                                        </li>
                                   <?php endif; ?>
                              </div>
                         <?php endif; ?>
                         <div id="produk">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Produk
                              </div>
                              <?php if ($this->uri->segment(1) == 'Ikan') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Ikan'); ?>">
                                             <i class="fas fa-fish"></i>
                                             <span>Ikan</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Ikan'); ?>">
                                             <i class="fas fa-fish"></i>
                                             <span>Ikan</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                              <?php if ($this->uri->segment(1) == 'Stok') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Stok'); ?>">
                                             <i class="fas fa-box"></i>
                                             <span>Stok</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Stok'); ?>">
                                             <i class="fas fa-box"></i>
                                             <span>Stok</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>
                         <div id="logistik">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Logistik
                              </div>
                              <?php if ($this->uri->segment(1) == 'PO') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('PO'); ?>">
                                             <i class="fa fa-caret-left"></i>
                                             <span>Purchase Order</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('PO'); ?>">
                                             <i class="fa fa-caret-left"></i>
                                             <span>Purchase Order</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                              <?php if ($this->uri->segment(1) == 'BAPB') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('BAPB'); ?>">
                                             <i class="fa fa-caret-right"></i>
                                             <span>BAPB</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('BAPB'); ?>">
                                             <i class="fa fa-caret-right"></i>
                                             <span>BAPB</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                              <?php if ($this->uri->segment(1) == 'Retur') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Retur'); ?>">
                                             <i class="fa fa-refresh"></i>
                                             <span>Retur</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Retur'); ?>">
                                             <i class="fa fa-refresh"></i>
                                             <span>Retur</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>
                         <div id="jual-beli">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Jual Beli
                              </div>
                              <?php if ($this->uri->segment(1) == 'Penjualan') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Penjualan'); ?>">
                                             <i class="fas fa-exchange-alt"></i>
                                             <span>Transaksi</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Penjualan'); ?>">
                                             <i class="fas fa-exchange-alt"></i>
                                             <span>Transaksi</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>
                         <div id="laporan">
                              <hr class="sidebar-divider">
                              <div class="sidebar-heading">
                                   Laporan
                              </div>
                              <?php if ($this->uri->segment(1) == 'Lap_penjualan') : ?>
                                   <li class="nav-item active">
                                        <a class="nav-link" href="<?= site_url('Lap_penjualan') ?>">
                                             <i class="fa fa-chart-bar"></i>
                                             <span>Data Penjualan</span>
                                        </a>
                                   </li>
                              <?php else : ?>
                                   <li class="nav-item">
                                        <a class="nav-link" href="<?= site_url('Lap_penjualan') ?>">
                                             <i class="fa fa-chart-bar"></i>
                                             <span>Data Penjualan</span>
                                        </a>
                                   </li>
                              <?php endif; ?>
                         </div>
                    <?php } ?>
                    <hr class="sidebar-divider d-none d-md-block">
                    <div class="text-center d-none d-md-inline">
                         <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>
                    </ul>
                    <div id="content-wrapper" class="d-flex flex-column">
                         <div id="content">
                              <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                                   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                        <i class="fa fa-bars"></i>
                                   </button>
                                   <ul class="navbar-nav ml-auto">
                                        <div class="topbar-divider d-none d-sm-block"></div>
                                        <li class="nav-item dropdown no-arrow">
                                             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                                       <b><?= strtoupper($user['username']); ?></b>
                                                  </span>
                                             </a>
                                        </li>
                                        <div class="topbar-divider d-none d-sm-block"></div>
                                        <li class="nav-item dropdown no-arrow">
                                             <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="keluar()" type="button">
                                                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-dark"></i>
                                                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                                       <b>Keluar</b>
                                                  </span>
                                             </a>
                                        </li>
                                   </ul>
                              </nav>
                              <div class="container-fluid">
                                   <?= $content; ?>
                              </div>
                         </div>
                         <footer class="sticky-footer bg-white">
                              <div class="container my-auto">
                                   <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; SKRIPSI UNIMMA 2022</span>
                                   </div>
                              </div>
                         </footer>
                    </div>
     </div>
     <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
     </a>
     <script>
          function keluar() {
               Swal.fire({
                    title: 'KELUAR',
                    text: "Anda yakin ingin keluar ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Keluar',
                    cancelButtonText: 'Tidak',
               }).then((result) => {
                    if (result.isConfirmed) {
                         location.href = "<?php echo base_url() ?>Auth/keluar";
                    }
               });
          }

          initailizeSelect2_i();

          function initailizeSelect2_i() {
               $('.select2_i').select2({
                    allowClear: true,
                    multiple: false,
                    placeholder: '--- Pilih Ikan ---',
                    //minimumInputLength: 2,
                    dropdownAutoWidth: true,
                    language: {
                         inputTooShort: function() {
                              return 'Ketikan Nomor minimal 2 huruf';
                         }
                    },
                    ajax: {
                         url: "<?php echo base_url(); ?>Globali/dataikan",
                         type: "post",
                         dataType: 'json',
                         delay: 250,
                         data: function(params) {
                              return {
                                   searchTerm: params.term // search term
                              };
                         },

                         processResults: function(response) {
                              return {
                                   results: response
                              };
                         },
                         cache: true
                    }
               });
          }


          function showikan(str, id) {
               var xhttp;
               var vid = id;
               $.ajax({
                    url: "<?php echo base_url(); ?>Globali/getinfoikan/?kode=" + str,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                         if (data.stok_ikan == 0) {
                              Swal.fire({
                                   icon: 'warning',
                                   title: 'STOK IKAN',
                                   text: 'Kosong !',
                              });
                         } else {
                              $('#harga' + vid).val(separateComma(data.hargajl_ikan));
                              totalline(vid);
                         }
                    }
               });
          }



          function qtyc(id) {
               var kode = $('#kode' + id).val();
               var qtyx = $('#qty' + id).val();
               var qty = parseInt(qtyx.replaceAll(',', ''));
               if (qty < 1) {
                    Swal.fire({
                         icon: 'warning',
                         title: 'QTY',
                         text: 'Minimal harus 1 !',
                    }).then((value) => {
                         $.ajax({
                              url: "<?php echo base_url(); ?>Globali/getinfoikan/?kode=" + kode,
                              type: "GET",
                              dataType: "JSON",
                              success: function(data) {
                                   $('#qty' + id).val(separateComma(1));
                                   var jumlah = $('#jumlah' + id).val(separateComma(data.hargajl_ikan * 1));
                                   total();
                              }
                         });
                    });
               } else {
                    $.ajax({
                         url: "<?php echo base_url(); ?>Globali/getinfoikan/?kode=" + kode,
                         type: "GET",
                         dataType: "JSON",
                         success: function(data) {
                              if (qty > data.stok_ikan) {
                                   Swal.fire({
                                        icon: 'warning',
                                        title: 'STOK IKAN',
                                        text: 'Melebihi stok yang ada !',
                                   }).then((value) => {
                                        var qty = $('#qty' + id).val(separateComma(data.stok_ikan));
                                        var jumlah = $('#jumlah' + id).val(separateComma(data.hargajl_ikan * data.stok_ikan));
                                        total();
                                   });
                              }
                         }
                    });
                    var hargax = $('#harga' + id).val();
                    var harga = parseInt(hargax.replaceAll(',', ''));
                    var jum = harga * qty;
                    var jumlah = $('#jumlah' + id).val(separateComma(jum));
               }
          }


          function hapusBarisIni(param) {
               var x = document.getElementById('datatable').deleteRow(arr.indexOf(param) + 1);
               arr.splice(arr.indexOf(param), 1);
               rowCount--;
               total();
          }
     </script>
     <script src="<?= base_url('assets'); ?>/tables/DataTables-1.11.5/js/jquery.dataTables.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/DataTables-1.11.5/js/dataTables.bootstrap4.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/js/dataTables.buttons.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/js/buttons.bootstrap4.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/JSZip-2.5.0/jszip.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/pdfmake-0.1.36/pdfmake.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/pdfmake-0.1.36/vfs_fonts.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/js/buttons.html5.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/js/buttons.print.min.js"></script>
     <script src="<?= base_url('assets'); ?>/tables/Buttons-2.2.2/js/buttons.colVis.min.js"></script>
     <script src="<?= base_url('assets'); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="<?= base_url('assets'); ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
     <script src="<?= base_url('assets'); ?>/js/sb-admin-2.min.js"></script>
     <script src="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.all.min.js"></script>

</body>

</html>