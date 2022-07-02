<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">PAJAK</div>
               </div>
          </div>
     </div>
</div>
<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="table-pajak" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Nama Pajak</th>
                                        <th>Persentase (%)</th>
                                        <th width="20%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($pajak as $p) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $p->nama_pajak; ?></td>
                                             <td><span class="float-right"><?= $p->persentase; ?> %</span></td>
                                             <td class="text-center">
                                                  <button class="btn btn-sm btn-warning" type="button" onclick="ubahpajak(<?= $p->id; ?>)"><i class="fa fa-edit"></i> Ubah</button>
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
          var table = $('#table-pajak').DataTable({
               "columnDefs": [{
                    "targets": [-1],
                    "orderable": true,
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
               "scrollCollapse": true,
               "paging": true,
               "responsive": true,
          });
     });
</script>

<!-- js ubah -->
<script>
     function ubahpajak(id) {
          $('#modal-ubah-pajak').modal('show');
          $('.modal-title').text('UBAH PAJAK');
          $.ajax({
               url: "<?php echo base_url(); ?>Pajak/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#eid').val(data.id);
                    $('#enamapajak').val(data.nama_pajak);
                    $('#epersentase').val(data.persentase);
               }
          });
     }

     function simpanpajak() {
          var namapajak = document.getElementById('enamapajak').value;
          var persentase = document.getElementById('epersentase').value;
          if (namapajak == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'NAMA PAJAK',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (persentase == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'PERSENTASE',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (Number(persentase) > 100) {
               Swal.fire({
                    icon: 'warning',
                    title: 'PERSENTASE',
                    text: 'Maksimal 100 !',
               });
          }
          if (namapajak != '' && persentase != '' && persentase < 101) {
               $.ajax({
                    url: "<?php echo base_url(); ?>Pajak/ubah",
                    type: "POST",
                    data: ($('#form-ubah-pajak').serialize()),
                    dataType: "JSON",
                    success: function(data) {
                         if (data.status == 1) {
                              $('#modal-ubah-pajak').modal('hide');
                              Swal.fire({
                                   title: 'UBAH DATA',
                                   html: "Anda yakin ingin mengubah <br>" + namapajak.toUpperCase().bold() + " ?",
                                   icon: 'warning',
                                   showCancelButton: true,
                                   confirmButtonColor: '#3085d6',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: '<i class="fa fa-check-circle"></i> Ya',
                                   cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                              }).then((result) => {
                                   if (result.isConfirmed) {
                                        let timerInterval
                                        Swal.fire({
                                             title: 'PROSES MENGUBAH DATA!',
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
                                             $('#modal-ubah-pajak').modal('hide');
                                             $.ajax({
                                                  url: "<?php echo base_url(); ?>Pajak/ubah_proses",
                                                  type: "POST",
                                                  data: ($('#form-ubah-pajak').serialize()),
                                                  dataType: "JSON",
                                                  success: function(data) {
                                                       if (data.status == 1) {
                                                            $('#modal-ubah-pajak').modal('hide');
                                                            Swal.fire({
                                                                 icon: 'success',
                                                                 title: 'UBAH DATA',
                                                                 text: 'Berhasil dilakukan !',
                                                            }).then((value) => {
                                                                 location.href = "<?php echo base_url() ?>Pajak";
                                                            });
                                                       } else if (data.status == 2) {
                                                            $('#modal-ubah-pajak').modal('hide');
                                                            Swal.fire({
                                                                 icon: 'danger',
                                                                 title: 'UBAH DATA',
                                                                 text: 'Gagal dilakukan !',
                                                            }).then((value) => {
                                                                 $('#modal-ubah-pajak').modal('show');
                                                            });
                                                       }
                                                  }
                                             });
                                        });
                                   }
                              });
                         } else if (data.status == 2) {
                              $('#modal-ubah-pajak').modal('hide');
                              Swal.fire({
                                   icon: 'danger',
                                   title: 'UBAH DATA',
                                   text: 'Gagal dilakukan !',
                              }).then((value) => {
                                   $('#modal-ubah-pajak').modal('show');
                              });
                         }
                    }
               });
          }
     }
</script>