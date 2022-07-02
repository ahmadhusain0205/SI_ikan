<div class="modal fade" id="modal-ikan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <form method="POST" id="form-tambah-ikan">
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="jenisikan">Jenis Ikan</label>
                                        <input type="text" class="form-control" name="lupjenisikan" id="lupjenisikan" placeholder="Jenis ikan...">
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="form-group">
                                        <label for="ukuranikan">Ukuran Ikan</label>
                                        <input type="number" class="form-control" name="lupukuranikan" id="lupukuranikan" placeholder="... cm">
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="hargaikan">Harga Beli</label>
                                        <input type="number" class="form-control" name="luphargablikan" id="luphargablikan" placeholder="Rp ...">
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="form-group">
                                        <label for="hargaikan">Harga Jual</label>
                                        <input type="number" class="form-control" name="luphargajlikan" id="luphargajlikan" placeholder="Rp ...">
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 49%;"><i class="fa fa-times"></i> Batal</button>
                                   <button class="btn btn-success btn-sm" id="btn" style="width: 49%;" type="button" onclick="tambahikan()"><i class="fa fa-plus"></i> Tambah</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>