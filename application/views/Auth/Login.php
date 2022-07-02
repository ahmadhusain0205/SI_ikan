<div class="row justify-content-center">
     <div class="col-5">
          <div class="h3 mb-5 text-center text-white font-weight-bold">PEMBENIHAN DAN BUDIDAYA IKAN AIR TAWAR NGRAJEK</div>
          <div class="card shadow mb-5">
               <div class="card-body">
                    <div class="h4 text-center">LOGIN</div>
                    <form method="POST" id="form-login">
                         <hr>
                         <div class="form-group">
                              <input type="text" class="form-control" name="username" id="username" placeholder="Username...">
                         </div>
                         <div class="form-group">
                              <input type="password" class="form-control" name="password" id="password" placeholder="Password...">
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <button class="btn btn-danger btn-sm" type="button" onclick="login()" style="width: 49%;"><i class="fa fa-sign-in"></i> Sign In</button>
                                   <a href="<?= site_url('Auth/regist'); ?>" type="button" class="btn btn-primary btn-sm float-right" style="width: 49%;"><i class="fa fa-user-plus"></i> Sign Up</a>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<script>
     function login() {
          var username = document.getElementById('username').value;
          var password = document.getElementById('password').value;
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

          if (username != '' && password != '') {
               $.ajax({
                    url: "<?php echo base_url(); ?>Auth/login/?username=" + username + '&password=' + password,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                         let timerInterval
                         Swal.fire({
                              title: 'SEDANG PENGECEKAN AKUN!',
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
                                        title: 'LOGIN',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Beranda";
                                   });
                              } else if (data.status == 2) {
                                   Swal.fire({
                                        icon: 'success',
                                        title: 'LOGIN',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Supplier";
                                   });
                              } else if (data.status == 3) {
                                   Swal.fire({
                                        icon: 'success',
                                        title: 'LOGIN',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>Kostumer";
                                   });

                              } else if (data.status == 4) {
                                   Swal.fire({
                                        icon: 'info',
                                        title: 'LOGIN',
                                        text: 'Password salah !',
                                   });
                              } else {
                                   Swal.fire({
                                        icon: 'danger',
                                        title: 'LOGIN',
                                        text: 'Username belum terdaftar !',
                                   });
                              }
                         });
                    }
               });
          }
     }
</script>