<div class="modal fade" id="modal-role" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <form method="POST" id="form-role">
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="username">Perusahaan</label>
                                        <input type="hidden" class="form-control" name="eusername" id="eusername">
                                        <input type="text" class="form-control" name="enama" id="enama" placeholder="Perusahaan..." readonly>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="form-group">
                                        <label for="username">Role</label>
                                        <select class="form-control select2_role2" name="erole" id="erole">
                                             <option value="1">Admin</option>
                                             <option value="2">Pemasok</option>
                                             <option value="3">Pelanggan</option>
                                        </select>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 49%;"><i class="fa fa-times"></i> Batal</button>
                                   <button class="btn btn-success btn-sm" style="width: 49%;" type="button" onclick="roling()"><i class="fa fa-user-cog"></i> Ubah Role</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<!-- <script>
     $(document).ready(function() {
          $(".select2_role2").select2();
     });
</script> -->