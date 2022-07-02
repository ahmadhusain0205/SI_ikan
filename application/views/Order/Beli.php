<form id="formbeli" method="POST">
     <div class="row">
          <div class="col my-auto">
               <div class="row">
                    <div class="col my-auto">
                         <div class="h1">
                              <?= $invoice; ?>
                              <input type="hidden" name="inv_pembelian" id="inv_pembelian" value="<?= $invoice; ?>">
                         </div>
                    </div>
               </div>
               <hr>
               <div class="row">
                    <div class="col-6">
                         <div class="form-group">
                              <input type="date" class="form-control" id="tgl_beli" name="tgl_beli" value="<?= date('Y-m-d'); ?>" readonly>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col">
               <div class="card shadow mb-3 h-100">
                    <div class="card-body">
                         <div class="row g-3 align-items-center mb-3">
                              <div class="col-4">
                                   <label for="sub_total" class="col-form-label">Sub total</label>
                              </div>
                              <div class="col-8">
                                   <input type="text" id="sub_total" name="sub_total" class="form-control" readonly value="0">
                              </div>
                         </div>
                         <div class="row g-3 align-items-center mb-3">
                              <div class="col-4">
                                   <label for="pajak" class="col-form-label">PPN</label>
                              </div>
                              <div class="col-8">
                                   <input type="text" id="pajak" name="pajak" class="form-control" readonly value="0">
                              </div>
                         </div>
                         <div class="row g-3 align-items-center mb-3">
                              <div class="col-4">
                                   <label for="total" class="col-form-label">Total</label>
                              </div>
                              <div class="col-8">
                                   <input type="text" id="total" name="total" class="form-control" readonly value="0">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <hr>
     <div class="row mb-3">
          <div class="col">
               <div class="card shadow mb-3 h-100">
                    <div class="card-body">
                         <div class="h4">Keranjang Pembelian
                              <button type="button" onclick="pesan()" class="btn btn-primary float-right">
                                   <i class="fas fa-cart-plus"></i> Pesan
                              </button>
                         </div>
                         <hr>
                         <div class="table-responsive">
                              <table id="datatable" class="table table-striped table-bordered table-hover">
                                   <thead>
                                        <tr class="text-center">
                                             <th>Delete</th>
                                             <th width="20%">Jenis Ikan</th>
                                             <th width="10%">QTY</th>
                                             <th>Harga Ikan</th>
                                             <th>Jumlah</th>
                                        </tr>
                                   </thead>
                                   <tbody>
                                        <tr>
                                             <td class="text-center">
                                                  <button type='button' onclick="hapusBarisIni(1)" class='btn btn-danger btm-sm' id="del1"><i class='fa fa-trash'></i>
                                             </td>
                                             <td>
                                                  <select name="kode[]" id="kode1" class="select2_i form-control" onchange="showikan(this.value, 1);"></select>
                                             </td>
                                             <td>
                                                  <input name="qty[]" onchange="totalline(1);qtyc(1)" value="1" id="qty1" type="text" class="form-control">
                                             </td>
                                             <td>
                                                  <input name="harga[]" onchange="totalline(1); cekharga(1);" value="0" id="harga1" type="text" class="form-control" readonly>
                                             </td>
                                             <td>
                                                  <input name="jumlah[]" id="jumlah1" type="text" class="form-control" size="40%" readonly value="0">
                                             </td>
                                        </tr>
                                   </tbody>
                              </table>
                         </div>
                         <div class="row">
                              <div class="col">
                                   <button type="button" onclick="tambah()" class="btn btn-success" style="margin-left: 17px;">
                                        <i class="fa fa-plus"></i>
                                   </button>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</form>

<!-- master -->
<script>
     function separateComma(val) {
          var sign = 1;
          if (val < 0) {
               sign = -1;
               val = -val;
          }
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
          if (val.toString().includes('.')) {
               result = result + '.' + val.toString().split('.')[1];
          }
          return sign < 0 ? '-' + result : result;
     }
     var arr = [1];
     var idrow = 2;
     if (idrow == 2) {
          $('#del1').attr('hidden', true);
     }
</script>

<script>
     function tambah() {
          var table = document.getElementById('datatable');
          rowCount = table.rows.length;
          arr.push(idrow);
          var x = document.getElementById('datatable').insertRow(rowCount);
          var td1 = x.insertCell(0);
          var td2 = x.insertCell(1);
          var td3 = x.insertCell(2);
          var td4 = x.insertCell(3);
          var td5 = x.insertCell(4);
          var button = "<td id='kolom" + idrow + "'><button type='button' onclick=hapusBarisIni(" + idrow + ") id=del" + idrow + " class='btn btn-danger'><i class='fa fa-trash'></td>";
          var akun = "<select name='kode[]' id='kode" + idrow + "' class='select2_i form-control' onchange='showikan(this.value, " + idrow + ");'></select>";
          var qty = "<input name='qty[]' id=qty" + idrow + " onchange='totalline(" + idrow + "); qtyc(" + idrow + ")' value=1  type='text' class='form-control rightJustified'>";
          var harga = "<input name='harga[]'  id=harga" + idrow + " onchange='totalline(" + idrow + ");cekharga(" + idrow + ");' value='0'  type='text' class='form-control rightJustified' readonly> ";
          var jum = "<input name='jumlah[]' id=jumlah" + idrow + " type='text' class='form-control rightJustified' size='40%' readonly value='0'>";
          td1.innerHTML = button;
          td2.innerHTML = akun;
          td3.innerHTML = qty;
          td4.innerHTML = harga;
          td5.innerHTML = jum;
          initailizeSelect2_i();
          idrow++;
     }

     function totalline(id) {
          var table = document.getElementById('datatable');
          var row = table.rows[arr.indexOf(id) + 1];
          var hargax = parseInt(row.cells[3].children[0].value.replaceAll(',', ''));
          var jumlah = row.cells[2].children[0].value * hargax;
          var subtot = jumlah;
          var tot = jumlah;
          row.cells[4].children[0].value = separateComma(tot);
          total();
     }

     function total() {
          var table = document.getElementById('datatable');
          var rowCount = table.rows.length;
          tjumlah = 0;
          tppn = 0;
          for (var i = 1; i < rowCount; i++) {
               var row = table.rows[i];
               qty = row.cells[2].children[0].value;
               harga = row.cells[3].children[0].value;
               jumlah = row.cells[4].children[0].value;
               var qty1 = Number(qty.replace(/[^0-9\.]+/g, ""));
               var harga1 = Number(harga.replace(/[^0-9\.]+/g, ""));
               var jumlah1 = Number(jumlah.replace(/[^0-9\.]+/g, ""));
               tjumlah = tjumlah + (qty1 * harga1);
               $.ajax({
                    url: '<?php echo base_url(); ?>Globali/cekppn',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                         cekppn = data.persentase;
                         cekppn2 = cekppn / 100;
                         tppn = eval(tjumlah * cekppn2);
                         document.getElementById("sub_total").value = separateComma(tjumlah);
                         document.getElementById("pajak").value = separateComma(tppn);
                         document.getElementById("total").value = separateComma(tjumlah + tppn);
                    }
               });
          }
     }
     $('.select2_pelanggan').select2();
</script>

<script>
     function pesan() {
          var inv = $('#inv_pembelian').val();
          var tgl = $('#tgl_beli').val();
          var table = document.getElementById('datatable');
          rowCount = table.rows.length;
          arr.push(idrow);
          for (i = 1; i < rowCount; i++) {
               var kode = $('#kode' + i).val();
               var qtyx = $('#qty' + i).val();
               var hargax = $('#harga' + i).val();
               var jumlahx = $('#jumlah' + i).val();
               var qty = parseInt(qtyx.replaceAll(',', ''));
               var harga = parseInt(hargax.replaceAll(',', ''));
               var jumlah = parseInt(jumlahx.replaceAll(',', ''));
               $.ajax({
                    url: '<?= site_url() ?>Order/beli/?kode=' + kode + '&qty=' + qty + '&harga=' + harga + '&subtotal=' + jumlah + '&inv=' + inv,
                    type: 'GET',
                    dataType: 'JSON',
               });
          }
          Swal.fire({
               icon: 'success',
               title: 'PEMESANAN',
               text: 'Berhasil dilakukan !',
          }).then((value) => {
               location.href = "<?php echo base_url() ?>Order";
          })
     }
</script>