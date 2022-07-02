<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Retur Barang BAPB</div>
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
                                        <th>Tanggal BAPB</th>
                                        <th>Jenis Ikan</th>
                                        <th>Jumlah BAPB</th>
                                        <th>Pemasok</th>
                                        <th>Pemesan</th>
                                        <th width="12%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($retur as $r) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $r->tglbapb; ?></td>
                                             <td><?= $r->jenis_ikan; ?></td>
                                             <td><?= $r->jmlbapb; ?></td>
                                             <td><?= $r->pemasok; ?></td>
                                             <td><?= $r->user; ?></td>
                                             <td class="text-center">
                                                  <button class="btn btn-sm btn-danger" type="button" onclick="kembalikan(<?= $r->id; ?>)"><i class="fa fa-times-circle"></i> Batalkan</button>
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

<!-- retur -->
<script>
     function kembalikan(id) {
          $.ajax({
               url: "<?php echo base_url(); ?>Retur/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    var pemasok = data.pemasok;
                    var inv_bapb = data.inv_bapb;
                    var jmlbapb = data.jmlbapb;
                    var jenis_ikan = data.jenis_ikan;
                    var tglbapb = data.tglbapb;
                    Swal.fire({
                         title: 'BATALKAN PENERIMAAN',
                         html: 'Yakin ingin membatalkan penerimaan dari : <br>' + pemasok.bold() + "<br>Kode BAPB : <br>" + inv_bapb.bold() + "<br>Jenis Ikan : <br>" + jenis_ikan.bold().toUpperCase() + "<br>Dengan besaran qty sebesar : " + jmlbapb + "<br>Tanggal : " + tglbapb,
                         icon: 'danger',
                         showCancelButton: true,
                         confirmButtonColor: '#3085d6',
                         cancelButtonColor: '#d33',
                         confirmButtonText: '<i class="fa fa-check-circle"></i> Ya',
                         cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                    }).then((result) => {
                         if (result.isConfirmed) {
                              let timerInterval
                              Swal.fire({
                                   title: 'PROSES PEMBATALAN BAPB !',
                                   html: 'Tunggu sekitar <b></b> milidetik.',
                                   timer: 1000,
                                   timerProgressBar: true,
                                   didOpen: () => {
                                        Swal.showLoading()
                                        const b = Swal.getHtmlContainer().querySelector('b')
                                        timerInterval = setInterval(() => {
                                             b.textContent = Swal.getTimerLeft()
                                        }, 100)
                                   },
                                   willClose: () => {
                                        clearInterval(timerInterval)
                                   }
                              }).then((result) => {
                                   $.ajax({
                                        url: "<?php echo base_url(); ?>Retur/batal_proses/?id=" + id,
                                        type: "GET",
                                        dataType: "JSON",
                                        success: function(data) {
                                             // console.log(data);
                                             if (data.status == 1) {
                                                  Swal.fire({
                                                       icon: 'success',
                                                       title: 'PEMBATALAN BAPB',
                                                       text: 'Berhasil dilakukan !',
                                                  }).then((value) => {
                                                       location.href = "<?php echo base_url() ?>Retur";
                                                  });
                                             } else if (data.status == 2) {
                                                  Swal.fire({
                                                       icon: 'danger',
                                                       title: 'PEMBATALAN BAPB',
                                                       text: 'Gagal dilakukan !',
                                                  });
                                             }
                                        }
                                   });
                              });
                         }
                    });
               }
          });
     }
</script>