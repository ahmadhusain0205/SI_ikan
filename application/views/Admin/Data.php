<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar Admin
                         <a class="btn btn-primary btn-sm float-right tambah" type="button"><i class="fa fa-user-plus"></i> Tambah</a>
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
                         <table id="table-admin" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>No Hp</th>
                                        <th>Alamat</th>
                                        <th width="20%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($admin as $a) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $a->username; ?></td>
                                             <td class="text-center">
                                                  <?php if ($a->on_off == 1) : ?>
                                                       <i class="fa fa-toggle-on text-success"></i> Online
                                                  <?php else : ?>
                                                       <i class="fa fa-toggle-off text-dark"></i> Offline
                                                  <?php endif; ?>
                                             </td>
                                             <td><?= $a->nama; ?></td>
                                             <td><?= $a->no_hp; ?></td>
                                             <td><?= $a->alamat; ?></td>
                                             <td class="text-center">
                                                  <button class="btn btn-sm btn-warning" type="button" onclick="ubah(<?= $a->id; ?>)"><i class="fa fa-edit"></i> Ubah</button>
                                                  <?php if ($a->on_off == 1) : ?>
                                                       <button class="btn btn-sm btn-danger" type="button" disabled><i class="fa fa-trash"></i> Hapus</button>
                                                  <?php else : ?>
                                                       <button class="btn btn-sm btn-danger" type="button" onclick="hapus(<?= $a->id; ?>)"><i class="fa fa-trash"></i> Hapus</button>
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
          $('.tambah').on("click", function() {
               $('#modal-tambah').modal('show');
               $('.modal-title').text('TAMBAH DATA');
          });
          var table = $('#table-admin').DataTable({
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

<!-- js tambah -->
<script>
     function tambah() {
          var username = document.getElementById('lupusername').value;
          var password = document.getElementById('luppassword').value;
          var nama = document.getElementById('lupnama').value;
          var nohp = document.getElementById('lupnohp').value;
          var alamat = document.getElementById('lupalamat').value;
          if (username == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'USERNAME',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (password == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'PASSWORD',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (nama == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'NAMA',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (nohp == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'NO HP',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (alamat == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'ALAMAT',
                    text: 'Tidak boleh kosong !',
               });
          }

          if (username != '' && password != '' && nama != '' && nohp != '' && alamat != '') {
               $.ajax({
                    url: "<?php echo base_url(); ?>Admin/tambah",
                    type: "POST",
                    data: ($('#form-tambah').serialize()),
                    dataType: "JSON",
                    success: function(data) {
                         let timerInterval
                         Swal.fire({
                              title: 'PROSES MENYIMPAN DATA!',
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
                                   $('#modal-tambah').modal('hide');
                                   Swal.fire({
                                        icon: 'success',
                                        title: 'TAMBAH DATA',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Admin";
                                   });
                              } else if (data.status == 2) {
                                   $('#modal-tambah').modal('hide');
                                   Swal.fire({
                                        icon: 'danger',
                                        title: 'TAMBAH ADMIN',
                                        text: 'Gagal dilakukan !',
                                   }).then((value) => {
                                        $('#modal-tambah').modal('show');
                                   });
                              } else if (data.status == 3) {
                                   $('#modal-tambah').modal('hide');
                                   Swal.fire({
                                        icon: 'danger',
                                        title: 'USERNAME',
                                        text: 'Sudah digunakan !',
                                   }).then((value) => {
                                        $('#lupusername').val('');
                                        $('#modal-tambah').modal('show');
                                   });
                              }
                         });
                    }
               });
          }
     }
</script>

<!-- js ubah -->
<script>
     function ubah(id) {
          $('#modal-ubah').modal('show');
          $('.modal-title').text('UBAH DATA');
          $.ajax({
               url: "<?php echo base_url(); ?>Admin/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#eusername').val(data.username);
                    $('#enama').val(data.nama);
                    $('#enohp').val(data.no_hp);
                    $('#ealamat').val(data.alamat);
               }
          });
     }

     function simpan() {
          var username = document.getElementById('eusername').value;
          var nama = document.getElementById('enama').value;
          var nohp = document.getElementById('enohp').value;
          var alamat = document.getElementById('ealamat').value;
          if (nama == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'NAMA',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (nohp == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'NO HP',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (alamat == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'ALAMAT',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (nama != '' && nohp != '' && alamat != '') {
               $.ajax({
                    url: "<?php echo base_url(); ?>Admin/ubah",
                    type: "POST",
                    data: ($('#form-ubah').serialize()),
                    dataType: "JSON",
                    success: function(data) {
                         if (data.status == 1) {
                              $('#modal-ubah').modal('hide');
                              Swal.fire({
                                   title: 'UBAH DATA',
                                   html: "Anda yakin ingin mengubah <br>" + username.toUpperCase().bold() + " ?",
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
                                             $('#modal-ubah').modal('hide');
                                             $.ajax({
                                                  url: "<?php echo base_url(); ?>Admin/ubah_proses",
                                                  type: "POST",
                                                  data: ($('#form-ubah').serialize()),
                                                  dataType: "JSON",
                                                  success: function(data) {
                                                       if (data.status == 1) {
                                                            $('#modal-ubah').modal('hide');
                                                            Swal.fire({
                                                                 icon: 'success',
                                                                 title: 'UBAH DATA',
                                                                 text: 'Berhasil dilakukan !',
                                                            }).then((value) => {
                                                                 location.href = "<?php echo base_url() ?>Admin";
                                                            });
                                                       } else if (data.status == 2) {
                                                            $('#modal-ubah').modal('hide');
                                                            Swal.fire({
                                                                 icon: 'danger',
                                                                 title: 'UBAH DATA',
                                                                 text: 'Gagal dilakukan !',
                                                            }).then((value) => {
                                                                 $('#modal-ubah').modal('show');
                                                            });
                                                       }
                                                  }
                                             });
                                        });
                                   }
                              });
                         } else if (data.status == 2) {
                              $('#modal-ubah').modal('hide');
                              Swal.fire({
                                   icon: 'danger',
                                   title: 'UBAH DATA',
                                   text: 'Gagal dilakukan !',
                              }).then((value) => {
                                   $('#modal-ubah').modal('show');
                              });
                         }
                    }
               });
          }
     }
</script>

<!-- js hapus -->
<script>
     function hapus(id) {
          $.ajax({
               url: "<?php echo base_url(); ?>Admin/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    var username = data.username;
                    $.ajax({
                         url: "<?php echo base_url(); ?>Admin/hapus/" + id,
                         type: "POST",
                         data: ($('#form-ubah').serialize()),
                         dataType: "JSON",
                         success: function(data) {
                              if (data.status == 1) {
                                   Swal.fire({
                                        title: 'HAPUS DATA',
                                        html: "Anda yakin ingin menghapus data <br>" + username.toUpperCase().bold() + " ?",
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
                                                  title: 'PROSES MENGHAPUS DATA!',
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
                                                       url: "<?php echo base_url(); ?>Admin/hapus_proses/" + id,
                                                       type: "POST",
                                                       data: ($('#form-ubah').serialize()),
                                                       dataType: "JSON",
                                                       success: function(data) {
                                                            // console.log(data.id);
                                                            if (data.status == 1) {
                                                                 $('#modal-ubah').modal('hide');
                                                                 Swal.fire({
                                                                      icon: 'success',
                                                                      title: 'HAPUS DATA',
                                                                      text: 'Berhasil dilakukan !',
                                                                 }).then((value) => {
                                                                      location.href = "<?php echo base_url() ?>Admin";
                                                                 });
                                                            } else if (data.status == 2) {
                                                                 Swal.fire({
                                                                      icon: 'danger',
                                                                      title: 'HAPUS DATA',
                                                                      text: 'Gagal dilakukan !',
                                                                 });
                                                            }
                                                       }
                                                  });
                                             });
                                        }
                                   });
                              } else if (data.status == 2) {
                                   Swal.fire({
                                        icon: 'danger',
                                        title: 'HAPUS DATA',
                                        text: 'Gagal dilakukan !',
                                   });
                              }
                         }
                    });
               }
          });
     }
</script>