<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">Daftar Ikan
                         <a class="btn btn-primary btn-sm float-right tambah" type="button"><i class="fa fa-plus"></i> Tambah</a>
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
                         <table id="table-ikan" class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th width="1%">No</th>
                                        <th>Jenis</th>
                                        <th>Ukuran</th>
                                        <th>Harga Beli</th>
                                        <th>Harga Jual</th>
                                        <th width="20%">Aksi</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php $no = 1;
                                   foreach ($ikan as $i) : ?>
                                        <tr>
                                             <td><?= $no++; ?></td>
                                             <td><?= $i->jenis_ikan; ?></td>
                                             <td><span class="float-right"><?= $i->ukuran_ikan; ?> Cm</span></td>
                                             <td>
                                                  Rp. <span class="float-right"><?= number_format($i->hargabl_ikan); ?></span>
                                             </td>
                                             <td>
                                                  Rp. <span class="float-right"><?= number_format($i->hargajl_ikan); ?></span>
                                             </td>
                                             <td class="text-center">
                                                  <button class="btn btn-sm btn-warning" style="width: 80px;" type="button" onclick="ubahikan(<?= $i->id; ?>)"><i class="fa fa-edit"></i> Ubah</button>
                                                  <button class="btn btn-sm btn-danger" style="width: 80px;" type="button" onclick="hapusikan(<?= $i->id; ?>)"><i class="fa fa-trash"></i> Hapus</button>
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
               $('#modal-ikan').modal('show');
               $('.modal-title').text('TAMBAH DATA IKAN');
          });
          var table = $('#table-ikan').DataTable({
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

<!-- tambah -->
<script>
     function tambahikan() {
          var jenisikan = document.getElementById('lupjenisikan').value;
          var ukuranikan = document.getElementById('lupukuranikan').value;
          var hargablikan = document.getElementById('luphargablikan').value;
          var hargajlikan = document.getElementById('luphargajlikan').value;
          if (jenisikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'JENIS IKAN',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (ukuranikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'UKURAN IKAN',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (hargablikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'HARGA BELI',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (hargajlikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'HARGA JUAL',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (jenisikan != '' && ukuranikan != '' && hargablikan != '' && hargajlikan != '') {
               $.ajax({
                    url: "<?php echo base_url(); ?>Ikan/tambah",
                    type: "POST",
                    data: ($('#form-tambah-ikan').serialize()),
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
                                   $('#modal-ikan').modal('hide');
                                   Swal.fire({
                                        icon: 'success',
                                        title: 'TAMBAH DATA',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Ikan";
                                   });
                              } else if (data.status == 2) {
                                   $('#modal-ikan').modal('hide');
                                   Swal.fire({
                                        position: 'top-end',
                                        icon: 'error',
                                        title: 'Gagal Menambahkan Ikan',
                                        showConfirmButton: false,
                                        timer: 1000
                                   });
                                   $('#modal-ikan').modal('show');
                              }
                         });
                    }
               });
          }
     }
</script>

<!-- ubah -->
<script>
     function ubahikan(id) {
          $('#modal-ikan-ubah').modal('show');
          $('.modal-title').text('UBAH DATA IKAN');
          $.ajax({
               url: "<?php echo base_url(); ?>Ikan/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    console.log(data);
                    $('#lupidikan').val(data.id);
                    $('#lupjenisikanubah').val(data.jenis_ikan);
                    $('#lupukuranikanubah').val(data.ukuran_ikan);
                    $('#luphargablikanubah').val(data.hargabl_ikan);
                    $('#luphargajlikanubah').val(data.hargajl_ikan);
               }
          });
     }

     function simpanikan() {
          var lupidikan = document.getElementById('lupidikan').value;
          var jenisikan = document.getElementById('lupjenisikanubah').value;
          var ukuranikan = document.getElementById('lupukuranikanubah').value;
          var hargablikan = document.getElementById('luphargablikanubah').value;
          var hargajlikan = document.getElementById('luphargajlikanubah').value;
          if (jenisikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'JENIS IKAN',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (ukuranikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'UKURAN IKAN',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (hargablikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'HARGA BELI',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (hargajlikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'HARGA JUAL',
                    text: 'Tidak boleh kosong !',
               });
          }
          $.ajax({
               url: "<?php echo base_url(); ?>Ikan/ubah",
               type: "POST",
               data: ($('#form-ubah-ikan').serialize()),
               dataType: "JSON",
               success: function(data) {
                    if (data.status == 1) {
                         $('#modal-ikan-ubah').modal('hide');
                         Swal.fire({
                              title: 'UBAH DATA',
                              html: "Anda yakin ingin mengubah <br>" + jenisikan.toUpperCase().bold() + " ?",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: '<i class="fa fa-check-circle"></i> Ya',
                              cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                         }).then((result) => {
                              if (result.isConfirmed) {
                                   $('#modal-ikan-ubah').modal('hide');
                                   $.ajax({
                                        url: "<?php echo base_url(); ?>Ikan/ubah_proses",
                                        type: "POST",
                                        data: ($('#form-ubah-ikan').serialize()),
                                        dataType: "JSON",
                                        success: function(data) {
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
                                                  if (data.status == 1) {
                                                       $('#modal-ikan-ubah').modal('hide');
                                                       Swal.fire({
                                                            icon: 'success',
                                                            title: 'UBAH DATA',
                                                            text: 'Berhasil dilakukan !',
                                                       }).then((value) => {
                                                            location.href = "<?php echo base_url() ?>Ikan";
                                                       });
                                                  } else if (data.status == 2) {
                                                       $('#modal-ikan-ubah').modal('hide');
                                                       Swal.fire({
                                                            icon: 'danger',
                                                            title: 'UBAH DATA',
                                                            text: 'Gagal dilakukan !',
                                                       }).then((value) => {
                                                            $('#modal-ikan-ubah').modal('show');
                                                       });
                                                  }
                                             });
                                        }
                                   });
                              }
                         });
                    } else if (data.status == 2) {
                         $('#modal-ikan-ubah').modal('hide');
                         Swal.fire({
                              icon: 'danger',
                              title: 'UBAH DATA',
                              text: 'Gagal dilakukan !',
                         }).then((value) => {
                              $('#modal-ikan-ubah').modal('show');
                         });
                    }
               }
          });
     }
</script>

<!-- hapus -->
<script>
     function hapusikan(id) {
          $.ajax({
               url: "<?php echo base_url(); ?>Ikan/data/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    var jenis_ikan = data.jenis_ikan;
                    $.ajax({
                         url: "<?php echo base_url(); ?>Ikan/hapus/" + id,
                         type: "POST",
                         data: ($('#form-ubah-ikan').serialize()),
                         dataType: "JSON",
                         success: function(data) {
                              if (data.status == 1) {
                                   Swal.fire({
                                        title: 'HAPUS DATA',
                                        html: "Anda yakin ingin menghapus <br>" + jenis_ikan.toUpperCase().bold() + " ?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: '<i class="fa fa-check-circle"></i> Ya',
                                        cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                                   }).then((result) => {
                                        if (result.isConfirmed) {
                                             $.ajax({
                                                  url: "<?php echo base_url(); ?>Ikan/hapus_proses/" + id,
                                                  type: "POST",
                                                  data: ($('#form-ubah-ikan').serialize()),
                                                  dataType: "JSON",
                                                  success: function(data) {
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
                                                            if (data.status == 1) {
                                                                 Swal.fire({
                                                                      icon: 'success',
                                                                      title: 'HAPUS DATA',
                                                                      text: 'Berhasil dilakukan !',
                                                                 }).then((value) => {
                                                                      location.href = "<?php echo base_url() ?>Ikan";
                                                                 });
                                                            } else if (data.status == 2) {
                                                                 Swal.fire({
                                                                      icon: 'danger',
                                                                      title: 'HAPUS DATA',
                                                                      text: 'Gagal dilakukan !',
                                                                 });
                                                            }
                                                       });
                                                  }
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