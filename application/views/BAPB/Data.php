<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar BAPB
                         <a href="<?= site_url('BAPB/bapb'); ?>" class="btn btn-primary btn-sm float-right tambah" type="button"><i class="fa fa-plus-circle"></i> Tambah</a>
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
                         <table id="table-retur" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Kode BAPB</th>
                                        <th>Kode PO</th>
                                        <th>Tgl BAPB</th>
                                        <th>Jenis Ikan</th>
                                        <th>Jumlah BAPB</th>
                                        <th>Pemasok</th>
                                        <th>Penerima</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($bapb as $b) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $b->inv_bapb; ?></td>
                                             <td><?= $b->inv_po; ?></td>
                                             <td><?= $b->tglbapb; ?></td>
                                             <td><?= $b->jenis_ikan; ?></td>
                                             <td><?= $b->jmlbapb; ?></td>
                                             <td><?= $b->pemasok; ?></td>
                                             <td><?= $b->user; ?></td>
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
          var table = $('#table-retur').DataTable({
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