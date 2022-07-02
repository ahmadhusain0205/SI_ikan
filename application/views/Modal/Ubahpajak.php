<div class="modal fade" id="modal-ubah-pajak" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <div class="modal-body">
                    <form method="POST" id="form-ubah-pajak">
                         <div class="row">
                              <div class="col">
                                   <div class="form-group">
                                        <label for="namapajak">Nama Pajak</label>
                                        <input type="hidden" class="form-control" name="eid" id="eid">
                                        <input type="text" class="form-control" name="enamapajak" id="enamapajak" placeholder="Nama Pajak...">
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="form-group">
                                        <label for="persentase">Persentase (%)</label>
                                        <input type="number" class="form-control" onchange="cekpersen()" name="epersentase" id="epersentase" placeholder="Persentase...">
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="row justify-content-center">
                              <div class="col">
                                   <button class="btn btn-danger btn-sm" data-dismiss="modal" style="width: 49%;"><i class="fa fa-times"></i> Batal</button>
                                   <button class="btn btn-warning btn-sm" style="width: 49%;" type="button" onclick="simpanpajak()"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<script>
     function cekpersen() {
          var persen = document.getElementById('epersentase').value;
          if (Number(persen) > 100) {
               $('#modal-ubah-pajak').modal('hide');
               Swal.fire({
                    icon: 'danger',
                    title: 'PERSENTASE PAJAK',
                    text: 'Maksimal 100 !',
               }).then(function(value) {
                    $('#modal-ubah-pajak').modal('show');
                    $('#epersentase').focus();
               });
          }
     }
</script>