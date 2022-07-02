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

<body>
  <div class="mt-5 text-center h2"><u>INVOICE</u></div>
  <div class="text-center mr-3">Tanggal: <?= date('D, d-M-Y') ?></div>
  <hr>
  <div class="row p-5">
    <div class="col">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover" id="table">
          <thead>
            <tr class="text-center">
              <th width="1%">No</th>
              <th>Inv Penjualan</th>
              <th>Tgl Jual</th>
              <th>User</th>
              <th>Pelanggan</th>
              <th>Jenis Ikan</th>
              <th>Harga Ikan</th>
              <th>Diskon</th>
              <th>Qty</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            foreach ($penjualan as $l) : ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $l->inv_penjualan; ?></td>
                <td><?= $l->tgl_jual; ?></td>
                <td><?= $l->user; ?></td>
                <td><?= $l->pelanggan; ?></td>
                <td><?= $l->jenis_ikan; ?></td>
                <td>Rp.
                  <span class="float-right"><?= number_format($l->harga_ikan); ?></span>
                </td>
                <td>Rp.
                  <span class="float-right"><?= number_format($l->diskon); ?></span>
                </td>
                <td>
                  <span class="float-right"><?= number_format($l->qty); ?></span>
                </td>
                <td>Rp.
                  <span class="float-right"><?= number_format($l->sub_total); ?></span>
                </td>
              </tr>
              <?php
              $sql = $this->db->query('select sum(harga_ikan) as h_ikan, sum(diskon) as disc, sum(qty) as qty, sum(sub_total) as st from penjualan_detail where inv_penjualan = "' . $l->inv_penjualan . '" limit 1')->result();
              ?>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <?php foreach ($sql as $s) : ?>
              <tr>
                <td colspan="6" class="text-center">TOTAL</td>
                <td>
                  Rp. <span class="float-right"><?= number_format($s->h_ikan); ?></span>
                </td>
                <td>
                  Rp. <span class="float-right"><?= number_format($s->disc); ?></span>
                </td>
                <td>
                  <span class="float-right"><?= number_format($s->qty); ?></span>
                </td>
                <td>
                  Rp. <span class="float-right"><?= number_format($s->st); ?></span>
                </td>
              </tr>
            <?php endforeach ?>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script>
    window.print();
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