<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar Orderan
                         <a href="<?= site_url('Order/tambah'); ?>" class="btn btn-primary btn-sm float-right tambah" type="button"><i class="fa fa-plus-circle"></i> Tambah</a>
                    </div>
               </div>
          </div>
     </div>
</div>
<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="table-order" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Invoice</th>
                                        <th>Pembeli</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Ikan</th>
                                        <th width="5%">Qty</th>
                                        <th>Sub Total</th>
                                        <th>Status</th>
                                        <th width="10%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($pesanan as $p) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $p->inv_pembelian; ?></td>
                                             <td><?= $p->pembeli; ?></td>
                                             <td><?= $p->tgl_beli; ?></td>
                                             <td><?= $p->jenis_ikan; ?></td>
                                             <td>
                                                  <span class="float-right"><?= number_format($p->qty); ?></span>
                                             </td>
                                             <td>Rp.
                                                  <span class="float-right"><?= number_format($p->sub_total); ?></span>
                                             </td>
                                             <td class="text-center">
                                                  <?php if ($p->status == 0) { ?>
                                                       <button class="btn btn-danger btn-sm" type="button" disabled><i class="fas fa-spinner"></i> Memesan</button>
                                                  <?php } else if ($p->status == 1) { ?>
                                                       <button class="btn btn-warning btn-sm" type="button" disabled><i class="fas fa-spinner"></i> Menunggu</button>
                                                  <?php } else { ?>
                                                       <button class="btn btn-primary btn-sm" type="button" disabled><i class="fas fa-dollar-sign"></i> Selesai</button>
                                                  <?php } ?>
                                             </td>
                                             <td class="text-center">
                                                  <?php if ($p->status == 0) { ?>
                                                       <button class="btn btn-primary btn-sm" type="button" onclick="terima(<?= $p->id; ?>)"><i class="fas fa-check-circle"></i> Terima</button>
                                                  <?php } else if ($p->status == 1) { ?>
                                                       <button class="btn btn-warning btn-sm" type="button" disabled><i class="fas fa-spinner"></i> Proses</button>
                                                  <?php } else { ?>
                                                       <button class="btn btn-info btn-sm" type="button" disabled><i class="fas fa-dollar-sign"></i> Selesai</button>
                                                  <?php } ?>
                                             </td>
                                        </tr>
                                   <?php endforeach; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     $(document).ready(function() {
          var table = $('#table-order').DataTable({
               "columnDefs": [{
                    "targets": [-1],
                    "orderable": false,
               }],
               "lengthMenu": [
                    [5, 20, 50, -1],
                    [5, 20, 50, 'semua']
               ],
               "oLanguage": {
                    "sEmptyTable": "<div class='text-center'>Data Kosong</div>",
                    "sInfoEmpty": "",
                    "sInfoFiltered": " - Dipilih dari _MAX_ data",
                    "sSearch": "Pencarian Data:",
                    "sInfo": " Jumlah _TOTAL_ Data (_START_ - _END_)",
                    "sLengthMenu": "_MENU_ Baris",
                    "sZeroRecords": "<div class='text-center'>Tida ada data</div>",
                    "oPaginate": {
                         "sPrevious": "Sebelumnya",
                         "sNext": "Berikutnya"
                    }
               },
               "scrollCollapse": false,
               "paging": true,
               "responsive": true,
          });
     });
</script>

<script>
     function terima(id) {
          Swal.fire({
               title: 'TERIMA PESANAN',
               html: 'Yakin ingin menerima pesanan ini ?',
               icon: 'question',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: '<i class="fa fa-check-circle"></i> Terima',
               cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
          }).then((result) => {
               if (result.isConfirmed) {
                    $.ajax({
                         url: "<?= site_url('Pesanan/terima/') ?>" + id,
                         type: "GET",
                         dataType: "JSON",
                         success: function(data) {
                              if (data.status == 1) {
                                   Swal.fire({
                                        icon: 'success',
                                        title: 'PEMESANAN',
                                        text: 'Berhasil diterima !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Pesanan";
                                   });
                              } else {
                                   Swal.fire({
                                        icon: 'error',
                                        title: 'PEMESANAN',
                                        text: 'Gagal diterima !',
                                   });
                              }
                         }
                    });
               }
          });
     }
</script>