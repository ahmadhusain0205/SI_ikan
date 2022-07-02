<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">PURCHASE ORDER DATA
                         <?php if($user['id_role']!=2) :?>
                         <a href="<?= site_url('PO/order'); ?>" class="btn btn-primary btn-sm float-right tambah" type="button"><i class="fa fa-plus"></i> Order</a>
                    <?php endif ?>
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
                         <table id="table-po" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Kode PO</th>
                                        <th>Jenis Ikan</th>
                                        <th>Tanggal PO</th>
                                        <th>Jumlah PO</th>
                                        <th>Pemasok</th>
                                        <th>Pemesan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($po as $p) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $p->inv_po; ?></td>
                                             <td><?= $p->jenis_ikan; ?></td>
                                             <td><?= $p->tglpo; ?></td>
                                             <td><span class="float-right"><?= $p->tersisa; ?></span></td>
                                             <td><?= $p->pemasok; ?></td>
                                             <td><?= $p->user; ?></td>
                                             <td>
                                                  <?php 
                                                       if($p->status==1):
                                                   ?>
                                                   <button class="btn btn-sm btn-success" disabled>Diterima</button>
                                              <?php else: ?> 
                                                  <button class="btn btn-sm btn-danger" disabled>Pending</button>
                                                   <?php endif ?>
                                             </td>
                                             <td>
                                                  <button class="btn btn-sm btn-primary" type="button" onclick="detail(<?= $p->id; ?>, '<?= $p->inv_po; ?>')"><i class="fa fa-info-circle"></i> Detail</button>
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
          var table = $('#table-po').DataTable({
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

<!-- master format number -->
<script>
     function separateComma(val) {
          // remove sign if negative
          var sign = 1;
          if (val < 0) {
               sign = -1;
               val = -val;
          }
          // trim the number decimal point if it exists
          let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
          let len = num.toString().length;
          let result = '';
          let count = 1;

          for (let i = len - 1; i >= 0; i--) {
               result = num.toString()[i] + result;
               if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = ',' + result;
               }
               count++;
          }

          // add number after decimal point
          if (val.toString().includes('.')) {
               result = result + '.' + val.toString().split('.')[1];
          }
          // return result with - sign if negative
          return sign < 0 ? '-' + result : result;
     }
</script>

<!-- detail -->
<script>
     function detail(id, inv_po) {
          var a = inv_po;
          $('#modal-detail-po').modal('show');
          $('.modal-title').text('DETAIL DARI KODE PO : ' + a.toUpperCase());
          $.ajax({
               url: "<?php echo base_url(); ?>PO/detail/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#inv_po').text(data.inv_po);
                    $('#jenis_ikan').text(data.jenis_ikan);
                    $('#tglpo').text(data.tglpo);
                    $('#subtotal').text('Rp ' + separateComma(data.subtotal));
                    $('#diskon').text('Rp ' + separateComma(data.diskon));
                    $('#ppn').text('Rp ' + separateComma(data.ppn));
                    $('#total').text('Rp ' + separateComma(data.total));
               }
          });
     }
</script>