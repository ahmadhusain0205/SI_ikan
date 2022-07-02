<div class="row justify-content-center">
     <div class="col-5">
          <div class="h3 mb-5 text-center text-white font-weight-bold">PEMBENIHAN DAN BUDIDAYA IKAN AIR TAWAR NGRAJEK</div>
          <div class="card shadow mb-5">
               <div class="card-body">
                    <div class="h4 text-center">REGISTER</div>
                    <form method="POST" id="form-regist">
                         <hr>
                         <div class="form-group">
                              <input type="text" class="form-control" name="username" id="username" placeholder="Username...">
                         </div>
                         <div class="form-group">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password...">
                         </div>
                         <div class="form-group">
                              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama...">
                         </div>
                         <div class="form-group">
                              <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No Hp...">
                         </div>
                         <div class="form-group">
                              <textarea name="alamat" id="alamat" class="form-control"></textarea>
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <a href="<?= site_url('Auth'); ?>" class="btn btn-danger btn-sm" type="button" style="width: 49%;"><i class="fa fa-sign-in"></i> Sign In</a>
                                   <button onclick="regist()" type="button" class="btn btn-primary btn-sm float-right" style="width: 49%;"><i class="fa fa-user-plus"></i> Sign Up</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<script>
     function regist() {
          var username = document.getElementById('username').value;
          var password = document.getElementById('password').value;
          var nama = document.getElementById('nama').value;
          var nohp = document.getElementById('nohp').value;
          var alamat = document.getElementById('alamat').value;
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
                    url: "<?php echo base_url(); ?>Auth/cekakun",
                    type: "POST",
                    data: ($('#form-regist').serialize()),
                    dataType: "JSON",
                    success: function(data) {
                         if (data.status == 1) {
                              $.ajax({
                                   url: "<?php echo base_url(); ?>Auth/register",
                                   type: "POST",
                                   data: ($('#form-regist').serialize()),
                                   dataType: "JSON",
                                   success: function(data) {
                                        let timerInterval
                                        Swal.fire({
                                             title: 'PROSES PEMBUATAN AKUN !',
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
                                                       title: 'REGISTRASI',
                                                       text: 'Berhasil dilakukan !',
                                                  }).then((value) => {
                                                       location.href = "<?php echo base_url() ?>Auth";
                                                  });
                                             } else {
                                                  Swal.fire({
                                                       icon: 'danger',
                                                       title: 'REGISTRASI',
                                                       text: 'Gagal dilakukan !',
                                                  });
                                             }
                                        });
                                   }
                              });
                         } else if (data.status == 2) {
                              Swal.fire({
                                   icon: 'danger',
                                   title: 'REGISTRASI',
                                   html: 'Akun ' + username + ' sudah digunakan !',
                              });
                         }
                    }
               });
          }
     }
</script>