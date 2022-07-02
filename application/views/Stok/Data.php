<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar Stok Ikan</div>
               </div>
          </div>
     </div>
</div>
<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="table-stok" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Jenis Ikan</th>
                                        <th>Stok</th>
                                        <th>PO</th>
                                        <th>BAPB</th>
                                        <th>Retur</th>
                                        <th>Terjual</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($stok as $s) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= strtoupper($s->jenis_ikan); ?></td>
                                             <td><span class="float-right"><?= number_format($s->stok_ikan); ?></span></td>
                                             <td><span class="float-right"><?= number_format($s->tersisa); ?></span></td>
                                             <td><span class="float-right"><?= number_format($s->bapb); ?></span></td>
                                             <td><span class="float-right"><?= number_format($s->retur); ?></span></td>
                                             <td><span class="float-right"><?= number_format($s->terjual); ?></span></td>
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
          var table = $('#table-stok').DataTable({
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