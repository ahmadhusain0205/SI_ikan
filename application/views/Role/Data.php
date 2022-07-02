<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar Anggota</div>
               </div>
          </div>
     </div>
</div>
<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="table-responsive">
                         <table id="table-role" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Level</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th width="13%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($role as $r) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td class="text-center">
                                                  <?php if ($r->id_role == 1) : ?>
                                                       <span class="btn btn-sm btn-primary" style="width: 100%;">Admin</span>
                                                  <?php elseif ($r->id_role == 2) : ?>
                                                       <span class="btn btn-sm btn-info" style="width: 100%;">Pemasok</span>
                                                  <?php else : ?>
                                                       <span class="btn btn-sm btn-secondary" style="width: 100%;">Pelanggan</span>
                                                  <?php endif; ?>
                                             </td>
                                             <td><?= $r->username; ?></td>
                                             <td class="text-center">
                                                  <?php if ($r->on_off == 1) : ?>
                                                       <i class="fa fa-toggle-on text-success"></i> Online
                                                  <?php else : ?>
                                                       <i class="fa fa-toggle-off text-dark"></i> Offline
                                                  <?php endif; ?>
                                             </td>
                                             <td><?= $r->nama; ?></td>
                                             <td><?= $r->no_hp; ?></td>
                                             <td><?= $r->alamat; ?></td>
                                             <td class="text-center">
                                                  <?php if ($r->on_off == 1) : ?>
                                                       <button class="btn btn-sm btn-warning" type="button" disabled><i class="fa fa-edit"></i> Ubah Role</button>
                                                  <?php else : ?>
                                                       <button class="btn btn-sm btn-warning" type="button" onclick="change_role(<?= $r->id; ?>)"><i class="fa fa-edit"></i> Ubah Role</button>
                                                  <?php endif; ?>
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
          var table = $('#table-role').DataTable({
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

<!-- ubahrole -->
<script>
     $('#erole').val();

     function change_role(id) {
          $('#modal-role').modal('show');
          $('.modal-title').text('UBAH ROLE');
          $.ajax({
               url: "<?php echo base_url(); ?>Role/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#eusername').val(data.username);
                    $('#enama').val(data.nama);
                    $('#id_role').val(data.id_role);
               }
          });
     }

     function roling() {
          var username = document.getElementById('eusername').value;
          var nama = document.getElementById('enama').value;
          var role = document.getElementById('erole').value;
          $.ajax({
               url: "<?php echo base_url(); ?>Role/roling/" + username,
               type: "POST",
               data: ($('#form-role').serialize()),
               dataType: "JSON",
               success: function(data) {
                    if (data.status == 1) {
                         $('#modal-role').modal('hide');
                         Swal.fire({
                              title: 'UBAH ROLE',
                              html: "Anda yakin ingin mengubah role <br>" + username.toUpperCase().bold() + " ?",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: '<i class="fa fa-check-circle"></i> Ya',
                              cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   $.ajax({
                                        url: "<?php echo base_url(); ?>Role/ubah_role/" + username,
                                        type: "POST",
                                        data: ($('#form-role').serialize()),
                                        dataType: "JSON",
                                        success: function(data) {
                                             let timerInterval
                                             Swal.fire({
                                                  title: 'PROSES MERUBAH ROLE<br>' + nama.toUpperCase(),
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
                                                  if (data.status == 1) {
                                                       $('#modal-role').modal('hide');
                                                       Swal.fire({
                                                            icon: 'success',
                                                            title: 'UBAH ROLE',
                                                            text: 'Berhasil dilakukan !',
                                                       }).then((value) => {
                                                            location.href = "<?php echo base_url() ?>Role";
                                                       });
                                                  } else if (data.status == 2) {
                                                       $('#modal-role').modal('hide');
                                                       Swal.fire({
                                                            icon: 'danger',
                                                            title: 'UBAH ROLE',
                                                            text: 'Gagal dilakukan !',
                                                       });
                                                  }
                                             });
                                        }
                                   });
                              }
                         });
                    } else if (data.status == 2) {
                         $('#modal-role').modal('hide');
                         Swal.fire({
                              icon: 'danger',
                              title: 'UBAH ROLE',
                              text: 'Gagal dilakukan !',
                         });
                    }
               }
          });
     }
</script>