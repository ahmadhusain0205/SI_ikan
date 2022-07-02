<div class="modal fade" id="modal-ubah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <form method="POST" id="form-ubah">
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="eusername" id="eusername" placeholder="Username..." readonly>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="namaa">Nama</label>
                                        <input type="text" class="form-control" name="enama" id="enama" placeholder="Nama...">
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="form-group">
                                        <label for="nohp">No Hp</label>
                                        <input type="text" class="form-control" name="enohp" id="enohp" placeholder="No Hp...">
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea name="ealamat" id="ealamat" class="form-control" placeholder="Alamat..."></textarea>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 49%;"><i class="fa fa-times"></i> Batal</button>
                                   <button class="btn btn-warning btn-sm" style="width: 49%;" type="button" onclick="simpan()"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>