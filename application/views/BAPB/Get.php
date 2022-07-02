<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">BAPB (Berita Acara Penerimaan Barang)</div>
               </div>
          </div>
     </div>
</div>
<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-5">
               <div class="card-body">
                    <form method="POST" id="form-bapb">
                         <div class="row">
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="inv_bapb">Nomor BAPB</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="hidden" name="user" id="user" value="<?= $user['username'] ?>">
                                                  <input type="text" name="inv_bapb" id="inv_bapb" value="<?= $inv_bapb ?>" readonly class="form-control">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="tglbapb">Tgl Penerimaan</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="date" name="tglbapb" id="tglbapb" value="<?= date('Y-m-d') ?>" readonly class="form-control">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="po">Purchase Order</label>
                                        </div>
                                        <div class="col-8">
                                             <select onchange="data_po()" name="po" id="po" class="form-control select2_po">
                                                  <option value="">-- Pilih --</option>
                                                  <?php foreach ($po as $p) : ?>
                                                       <option value="<?= $p->inv_po; ?>"><?= '[ ' . $p->pemasok . ' ] [ ' . $p->jenis_ikan . ' ] [ ' . $p->tersisa . ' ]'; ?></option>
                                                  <?php endforeach; ?>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="jmlbapb">Jumlah BAPB</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="number" name="jmlbapb" id="jmlbapb" min="1" class="form-control" value="1" onchange="cekjmlbapb()">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                         <div class="row justify-content-center">
                              <div class="col-8">
                                   <div class="card" id="detail-po_bapb">
                                        <div class="card-body">
                                             <div class="h6">Detail PO</div>
                                             <hr>
                                             <table>
                                                  <tr>
                                                       <td width="50%">Nomor PO</td>
                                                       <td>
                                                            <input type="text" class="form-control" name="inv_po" id="inv_po" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="50%">Pemasok</td>
                                                       <td>
                                                            <input type="text" class="form-control" name="pemasok" id="pemasok" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="50%">Tgl PO</td>
                                                       <td>
                                                            <input type="date" class="form-control" name="tglpo" id="tglpo" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="50%">Jenis Ikan</td>
                                                       <td>
                                                            <input type="text" class="form-control" name="jenis_ikan" id="jenis_ikan" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="50%">Jumlah PO</td>
                                                       <td>
                                                            <input type="number" class="form-control" name="jmlpo" id="jmlpo" readonly>
                                                       </td>
                                                  </tr>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-4" style="margin-top: auto;">
                                   <a href="<?= site_url('BAPB'); ?>" type="button" class="btn btn-info float-right mr-2"><i class="fa fa-refresh"></i> Data Baru</a>
                                   <button type="button" onclick="terima()" class="btn btn-success float-right mr-2"><i class="fa fa-cart-plus"></i> Terima</button>
                              </div>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</div>

<script>
     $(document).ready(function() {
          $('.select2_po').select2({
               theme: "bootstrap"
          });
          $('#jmlbapb').attr('readonly', true);
     });
</script>

<!-- getpo -->
<script>
     function data_po() {
          var po = $('#po').val();
          $.ajax({
               url: "<?php echo base_url(); ?>Bapb/getdatapo/?po=" + po,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#jmlbapb').attr('readonly', false);
                    $('#inv_po').val(data.inv_po);
                    $('#pemasok').val(data.pemasok);
                    $('#tglpo').val(data.tglpo);
                    $('#jenis_ikan').val(data.jenis_ikan);
                    $('#jmlpo').val(data.tersisa);
               }
          });
     }
</script>

<!-- master -->
<script>
     function cekjmlbapb() {
          var jmlbapb = $('#jmlbapb').val();
          var inv_po = $('#po').val();
          if (jmlbapb < 1) {
               Swal.fire({
                    icon: 'warning',
                    title: 'JUMLAH BAPB',
                    text: 'Minimal harus 1 !',
               }).then(function(value) {
                    $('#jmlbapb').val(1);
               });
          } else {
               $.ajax({
                    url: "<?php echo base_url(); ?>Bapb/getdatapo/?po=" + inv_po,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                         var jmlpo = data.tersisa;
                         console.log(jmlpo);
                         console.log(jmlbapb);
                         if (Number(jmlbapb) > Number(jmlpo)) {
                              Swal.fire({
                                   icon: 'danger',
                                   title: 'JUMLAH BAPB BERLEBIHAN',
                                   html: 'Jumlah PO tersisa saat ini ' + jmlpo.bold(),
                              }).then(function(value) {
                                   $('#jmlbapb').val(jmlpo);
                              });
                         }
                    }
               });
          }
     }
</script>

<!-- terima -->
<script>
     function terima() {
          var user = $('#user').val();
          var inv_bapb = $('#inv_bapb').val();
          var tglbapb = $('#tglbapb').val();
          var inv_po = $('#po').val();
          var jmlbapb = $('#jmlbapb').val();
          $.ajax({
               url: "<?php echo base_url(); ?>Bapb/getdatapo/?po=" + inv_po,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    var pemasok = data.pemasok;
                    var id_ikan = data.id_ikan;
                    var jenis_ikan = data.jenis_ikan;
                    $.ajax({
                         url: "<?php echo base_url(); ?>BAPB/tambah/?user=" + user + "&pemasok=" + pemasok + "&id_ikan=" + id_ikan,
                         type: "POST",
                         data: ($('#form-bapb').serialize()),
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
                                        Swal.fire({
                                             icon: 'success',
                                             title: 'BAPB',
                                             html: 'Berhasil menerima qty ' + jmlbapb.bold() + " " + jenis_ikan + " dari : <br>" + pemasok.toUpperCase() + "<br>Pada Tanggal : " + tglbapb,
                                        }).then((value) => {
                                             location.href = "<?php echo base_url() ?>BAPB";
                                        });
                                   } else if (data.status == 2) {
                                        Swal.fire({
                                             position: 'top-end',
                                             icon: 'error',
                                             title: 'Gagal Menerima Ikan',
                                             showConfirmButton: false,
                                             timer: 1000
                                        });
                                   }
                              });
                         }
                    });
               }
          });
     }
</script>