<form method="POST" id="form-po">
     <div class="row">
          <div class="col">
               <div class="card shadow mb-4">
                    <div class="card-body">
                         <div class="row">
                              <div class="col">
                                   <div class="h3">Purchase Order (PO)
                                        <span class="float-right text-primary font-weight-bold">
                                             <input type="hidden" name="user" id="user" value="<?= $user['username']; ?>">
                                             <input type="hidden" name="pajak" id="pajak" value="<?= $pajak['persentase']; ?>">
                                        </span>
                                   </div>
                              </div>
                         </div>
                         <hr>
                         <div class="row">
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">Nomor PO</div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="text" name="inv_po" id="inv_po" value="<?= $invoice; ?>" readonly class="form-control">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="pemasok">Pemasok</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <select name="pemasok" id="pemasok" class="form-control select2_pemasok col-md-12">
                                                       <option value="">-- Pilih --</option>
                                                       <?php foreach ($pemasok as $p) : ?>
                                                            <option value="<?= $p->nama; ?>"><?= '[' . $p->nama . '] [' . $p->username . ']'; ?></option>
                                                       <?php endforeach; ?>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="tglpo">Tanggal</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="date" class="form-control" name="tglpo" id="tglpo" value="<?= date('Y-m-d'); ?>" readonly>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="barang">Jenis Ikan</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <select name="jenis_ikan" id="jenis_ikan" class="form-control select2_jenisikan" onchange="cekharga()">
                                                       <option value="">-- Pilih --</option>
                                                       <?php foreach ($ikan as $i) : ?>
                                                            <option value="<?= $i->id; ?>"><?= '[' . $i->jenis_ikan . '] [' . $i->stok_ikan . ']'; ?></option>
                                                       <?php endforeach; ?>
                                                  </select>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <div class="row">
                                        <div class="col-4">
                                             <label for="jmlpo">Jumlah PO</label>
                                        </div>
                                        <div class="col-8">
                                             <div class="form-group">
                                                  <input type="number" name="jmlpo" id="jmlpo" onchange="changeqty()" class="form-control" min="1" value="1">
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="col">
                                   <div class="card float-right">
                                        <div class="card-body">
                                             <table>
                                                  <tr>
                                                       <td width="40%">Sub Total (Rp)</td>
                                                       <td>
                                                            <input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="40%">Diskon (Rp)</td>
                                                       <td>
                                                            <input type="text" name="diskon" id="diskon" class="form-control" onchange="diskonrp()">
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="40%">PPN <?= $pajak['persentase']; ?>% (Rp)</td>
                                                       <td>
                                                            <input type="text" name="ppn" id="ppn" class="form-control" readonly>
                                                       </td>
                                                  </tr>
                                                  <tr>
                                                       <td width="40%">Total (Rp)</td>
                                                       <td>
                                                            <input type="text" name="total" id="total" class="form-control" readonly>
                                                       </td>
                                                  </tr>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <br>
                         <div class="row justify-content-center">
                              <div class="col offset-6">
                                   <a href="<?= site_url('PO'); ?>" type="button" class="btn btn-primary float-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                                   <a href="<?= site_url('PO/order'); ?>" type="button" class="btn btn-info float-right mr-2"><i class="fa fa-refresh"></i> Data Baru</a>
                                   <button type="button" onclick="order()" class="btn btn-success float-right mr-2"><i class="fa fa-cart-plus"></i> Order</button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</form>

<script>
     $(document).ready(function() {
          $('.select2_pemasok').select2({
               theme: "bootstrap"
          });
          $('.select2_jenisikan').select2({
               theme: "bootstrap"
          });
     });
     $('#jmlpo').attr('readonly', true);
     $('#diskon').attr('readonly', true);
</script>

<!-- master format number -->
<script>
     function separateComma(val) {
          // remove sign if negative
          var sign = 1;
          if (val < 0) {
               sign = -1;
               val = -val;
          }
          // trim the number decimal point if it exists
          let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
          let len = num.toString().length;
          let result = '';
          let count = 1;

          for (let i = len - 1; i >= 0; i--) {
               result = num.toString()[i] + result;
               if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = ',' + result;
               }
               count++;
          }

          // add number after decimal point
          if (val.toString().includes('.')) {
               result = result + '.' + val.toString().split('.')[1];
          }
          // return result with - sign if negative
          return sign < 0 ? '-' + result : result;
     }
</script>

<!-- master algoritma -->
<script>
     function cekharga() {
          var id = $('#jenis_ikan').val();
          var pajak = $('#pajak').val();
          $.ajax({
               url: "<?php echo base_url(); ?>PO/cekharga/?id=" + id,
               type: "GET",
               dataType: "JSON",
               success: function(data) {
                    $('#jmlpo').attr('readonly', false);
                    var harga = data.hargabl_ikan;
                    var ppnx = harga * pajak / 100;
                    $('#subtotal').val(separateComma(data.hargabl_ikan));
                    $('#ppn').val(separateComma(ppnx));
                    var total = Number(harga) + Number(ppnx);
                    $('#total').val(separateComma(total));
               }
          });
     }

     function changeqty() {
          var id = $('#jenis_ikan').val();
          var qty = $('#jmlpo').val();
          var pajak = $('#pajak').val();
          if (qty < 1) {
               Swal.fire({
                    icon: 'danger',
                    title: 'JUMLAH PO',
                    text: 'Minimal harus 1 !',
               }).then(function(value) {
                    $('#jmlpo').val(1);
               });
          } else {
               $.ajax({
                    url: "<?php echo base_url(); ?>PO/cekharga/?id=" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                         $('#diskon').attr('readonly', false);
                         var harga = data.hargabl_ikan;
                         var new_subtotal = harga * qty;
                         var ppnx = new_subtotal * pajak / 100;
                         $('#subtotal').val(separateComma(new_subtotal));
                         $('#ppn').val(separateComma(ppnx));
                         var total = Number(new_subtotal) + Number(ppnx);
                         $('#total').val(separateComma(total));
                    }
               });
          }
     }

     function diskonrp() {
          var subtotalx = $('#subtotal').val();
          var diskon = $('#diskon').val();
          var ppnx = $('#ppn').val();
          var subtotal = parseInt(subtotalx.replaceAll(',', ''));
          var ppn = parseInt(ppnx.replaceAll(',', ''));
          var total = subtotal - diskon + ppn;
          $('#total').val(separateComma(total));
     }
</script>

<!-- order -->
<script>
     function order() {
          var inv_po = document.getElementById('inv_po').value;
          var user = document.getElementById('user').value;
          var pemasok = document.getElementById('pemasok').value;
          var tglpo = document.getElementById('tglpo').value;
          var jenis_ikan = document.getElementById('jenis_ikan').value;
          var jmlpo = document.getElementById('jmlpo').value;
          var diskon = document.getElementById('diskon').value;
          var subtotalx = document.getElementById('subtotal').value;
          var ppnx = document.getElementById('ppn').value;
          var totalx = document.getElementById('total').value;
          var subtotal = parseInt(subtotalx.replaceAll(',', ''));
          var ppn = parseInt(ppnx.replaceAll(',', ''));
          var total = parseInt(totalx.replaceAll(',', ''));
          if (pemasok == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'PEMASOK',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (jenis_ikan == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'JENIS IKAN',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (jmlpo == '') {
               Swal.fire({
                    icon: 'danger',
                    title: 'JUMLAH PO',
                    text: 'Tidak boleh kosong !',
               });
          }
          if (pemasok != '' && jenis_ikan != '' && jmlpo != '') {
               $.ajax({
                    url: "<?php echo base_url(); ?>PO/order_proses/?inv_po=" + inv_po + "&user=" + user + "&pemasok=" + pemasok + "&tglpo=" + tglpo + "&jenis_ikan=" + jenis_ikan + "&jmlpo=" + jmlpo + "&subtotal=" + subtotal + "&diskon=" + diskon + "&ppn=" + ppn + "&total=" + total,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                         let timerInterval
                         Swal.fire({
                              title: 'PROSES MEMINTA ORDER !',
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
                                        title: 'ORDER',
                                        text: 'Berhasil dilakukan !',
                                   }).then((value) => {
                                        location.href = "<?php echo base_url() ?>PO";
                                   });
                              } else if (data.status == 2) {
                                   Swal.fire({
                                        icon: 'danger',
                                        title: 'ORDER',
                                        text: 'Gagal dilakukan !',
                                   });
                              }
                         });
                    }
               });
          }
     }
</script>